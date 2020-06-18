<?php

namespace App\Http\Controllers;

use App\CartDetail;
use Illuminate\Http\Request;

class CartDetailController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $encuentra = CartDetail::select('product_id')->where('product_id', $request->product_id)
            ->where('cart_id', '=', auth()->user()->cart->id)->first();

        if ($encuentra)
        {
            if ($encuentra->product_id == $request->product_id)
            {
                $notification_fail = 'Este producto ya se encuentra agergado en tu carrito de compras';
                return back()->with(compact('notification_fail'));

            }
            else
            {
                $cartDetail = new CartDetail();
                $cartDetail->cart_id = auth()->user()->cart->id;
                $cartDetail->product_id = $request->product_id;
                $cartDetail->quantity = $request->quantity;
                $cartDetail->save();
                $notification = 'El Producto se a cargado a tu carrito de compras exitosamente';
                return back()->with(compact('notification'));
            }
        }
        else
        {
            $cartDetail = new CartDetail();
            $cartDetail->cart_id = auth()->user()->cart->id;
            $cartDetail->product_id = $request->product_id;
            $cartDetail->quantity = $request->quantity;
            $cartDetail->save();
            $notification = 'El Producto se a cargado a tu carrito de compras exitosamente';
            return back()->with(compact('notification'));
        }
            return redirect('home');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $cartDetail = CartDetail::find($request->cart_detail_id);
        // dd($cartDetail)
        if ($cartDetail->cart_id == auth()->user()->cart->id)
        {
        $cartDetail->delete();
        }
        $notification = 'El producto se a eliminado del carrito correctamente';
        return back()->with(compact('notification'));
    }
}
