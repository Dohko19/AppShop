<?php

namespace App\Http\Controllers\Admin;

use App\Cart;
use App\Http\Controllers\Controller;
use App\Mail\ConfirmOrder;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class CartController extends Controller
{
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
        
        $cart = Cart::findOrFail($id);
        $cart->status = "En Preparacion";
        $cart->save();
        $notification = 'Pedido Confirmado';
        Mail::to($request->client)->send(new ConfirmOrder($cart, $id));
        return back()->with(compact('notification'));
    }
}
