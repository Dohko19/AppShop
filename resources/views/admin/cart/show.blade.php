@extends('layouts.app')
@section('title', 'App Shop | Dashboard')
@section('body-class', 'profile-page sidebar-collapse')
@section('content')
    <div class="page-header header-filter" data-parallax="true" style="background-image: url('{{ asset('img/Pinata01.jpg') }}')"> </div>
    <div class="main main-raised">
        <div class="container">
            <div class="row">
                <div class="col-md-6 ml-auto mr-auto">
                    <div class="text-center">

                        @if (session('notification'))
                            <div class="alert alert-success" role="alert">
                                {{ session('notification') }}
                            </div>
                        @endif
                            @foreach($orders as $order)
                                    <div class="name">
                                        <h3 class="title">Detalles de la compra numero: {{ $id }}</h3>
                                        <h3 class="">Status: {{ $order->status }}</h3>
                                        <h6>Ordenado el:{{ $order->order_date }}</h6>
                                        <h3>Detalles del Cliente</h3>
                                        <ul>
                                            <li>Nombre: {{ $order->user->name }}</li>
                                            <li>Nombre: {{ $order->user->email }}</li>
                                            <li>Direccion: <a href="https://www.google.com.mx/maps/place/{{ $order->user->address }}" target="_blank">{{ $order->user->address }}</a> </li>
                                            <li>Telefono: {{ $order->user->phone }}</li>
                                        </ul>

                                        <h3>Detalles del Pedido</h3>
                                        @foreach($order->details as $detail)
                                            <ul>
                                                    <li>
                                                        {{ $detail->product->name }} x {{ $detail->quantity }} ($ {{ $detail->quantity * $detail->product->price }})
                                                    </li>
                                            </ul>

                                            Total: {{$order->total}}
                                        @endforeach
                                    </div>
                                    <hr>
                                @if (Auth::user()->admin == true)
                                    @if ($order->status == 'En Preparacion')
                                        <div class="description text-center">
                                           <b> Este pedido ya fue confirmado</b>
                                        </div>
                                    @else
                                    <div class="description text-center">
                                        <form action="{{ route('orders.status', $id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" value="En Preparacion" name="status">
                                            <input type="hidden" value="{{ $order->user->email }}" name="client">
                                            <button type="submit" class="btn btn-info ">Confirmar Pedido</button>
                                        </form>
                                    </div>
                                    @endif

                                @endif
                            @endforeach
                    </div>
                </div>
            </div>


        </div>
    </div>
    @include('includes.footer')
@endsection

