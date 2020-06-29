<?php

namespace App\Http\Controllers\Admin;

use App\Cart;
use App\Http\Controllers\Controller;
use App\Mail\CompleteOrder;
use App\Mail\ConfirmOrder;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class CartController extends Controller
{
    public function index()
    {
        if (auth()->user()->admin == true) {
            $orders = Cart::has('details')->with('details')->orderBy('status', 'DESC')->paginate(10);
            return view('admin.orders.index', compact('orders'));
        }
        return redirect('/');
    }

    public function show($id)
    {
        if (auth()->user()->admin == true)
        {
            $orders = Cart::with(['details', 'user'])->where('id', $id)->get();
            return view('admin.cart.show', compact('orders', 'id'));
        }
        abort(404);
    }

    public function setStatus(Request $request, $id)
    {
        if (auth()->user()->admin == true) {
            $cart = Cart::findOrFail($id);
            $cart->status = "En Preparacion";
            $cart->save();
            $notification = 'Pedido Confirmado';
            Mail::to($request->client)->send(new ConfirmOrder($cart, $id));
            return back()->with(compact('notification'));
        }
        return redirect('/');
    }

    public function setStatusComplete(Cart $cart)
    {

//        ddd($cart);
        $cart->status = "Completado";
        $cart->save();
        $notification = 'Pedido Marcado como completado';
        Mail::to($cart->user->email)->send(new CompleteOrder($cart));
        return back()->with(compact('notification'));
    }
}
