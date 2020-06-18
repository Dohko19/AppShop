@extends('layouts.app')
@section('title', 'App Shop | Dashboard')
@section('body-class', 'profile-page')
@section('content')

<div class="page-header header-filter" data-parallax="true" style="background-image: url('{{ asset('img/Pinata01.jpg') }}')"> </div>
  <div class="main main-raised">
    <div class="container">
        <h2 class="title text-center">Dashboard</h2>
         @if (session('notification'))
            <div class="alert alert-success" role="alert">
                {{ session('notification') }}
            </div>
         @endif

       <ul class="nav nav-pills nav-pills-icons" role="tablist">
    <!--
        color-classes: "nav-pills-primary", "nav-pills-info", "nav-pills-success", "nav-pills-warning","nav-pills-danger"
    -->
        <li class="active nav-item">
            <a class="nav-link active" href="#dashboard-1" role="tab" data-toggle="tab">
                <i class="material-icons">dashboard</i>
                Carrito de Compras
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#tasks-1" role="tab" data-toggle="tab">
                <i class="material-icons">list</i>
                Pedido Realizado
            </a>
        </li>
    </ul>
    <div class="tab-content tab-space">
        <div class="tab-pane active" id="dashboard-1">
            <hr>
            <p>Tu carrito de Compras Presenta <b>{{ auth()->user()->cart->details->count() }}</b> Producto</p>
             <table class="table">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th>Nombre</th>
                                <th>Precio</th>
                                <th>Cantidad</th>
                                <th>Sub Total</th>
                                <th>Opciones</th>
                            </tr>
                        </thead>
                        @foreach(auth()->user()->cart->details as $detail)
                        <tbody>
                            <tr>
                                <td class="text-center">
                                    <img src="{{ $detail->product->featured_image_url }}" height="100">
                                </td>
                                <td>
                                    <a href="{{ url('/products/'.$detail->product->id) }}">{{ $detail->product->name }}</a>
                                </td>
                                 <td>$ {{ $detail->product->price }}</td>
                                 <td>{{ $detail->quantity }}</td>
                                 <td>$ {{ $detail->quantity * $detail->product->price }}</td>
                                <td class="td-actions">
                                    <form method="POST" action="{{ url('/cart/') }}">
                                        @csrf
                                        {{ method_field('DELETE') }}
                                        <input type="hidden" name="cart_detail_id" value="{{ $detail->id }}">
                                        <a href="{{ url('/products/'.$detail->product->id) }}" target="_blank" rel="tooltip" title="Ver Producto" class="btn btn-info btn-round btn-sm">
                                        <i class="material-icons">visibility</i>
                                        </a>
                                        <button type="submit"
                                        rel="tooltip"
                                        title="Eliminar"
                                        class="btn btn-danger btn-round btn-sm">
                                            <i class="material-icons">close</i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        </tbody>
                        @endforeach
                    </table>
                    <p><strong>Importe a pagar:</strong>$ {{ auth()->user()->cart->total }}</p>
                        <div class="text-center">
                            <form method="POST" action="{{ url('/order') }}">
                                @csrf
                                <button class="btn btn-primary btn-round">
                                    <i class="material-icons">done</i> Realizar Pedido
                                </button>
                            </form>
                        </div>
        </div>
        <div class="tab-pane" id="tasks-1">
            <h2>Mis Pedidos Realizados</h2>

                <table class="table">
                    <thead>
                    <tr>
                        <th class="text-center">#</th>
                        <th>Ordenado el:</th>
                        <th>Status</th>
                        <th>Imagen del Producto</th>
                        <th>Nombre</th>
                        <th>Precio</th>
                        <th>Cantidad</th>
                        <th>Sub Total</th>
                    </tr>
                    </thead>
                    @foreach(auth()->user()->carts as $cart)
                        @foreach ($cart->details as $detail)
                        <tbody>
                        <tr>
                            <td class="text-center">
                                {{ $cart->id }}
                            </td>
                            <td>
                                {{ $cart->order_date }}
                            </td>
                            <td>{{ $cart->status }}</td>
                            <td class="text-center">
                                <img src="{{ $detail->product->featured_image_url }}" height="100">
                            </td>
                            <td>
                                <a href="{{ url('/products/'.$detail->product->id) }}">{{ $detail->product->name }}</a>
                            </td>
                            <td>$ {{ $detail->product->price }}</td>
                            <td>{{ $detail->quantity }}</td>
                            <td>$ {{ $detail->quantity * $detail->product->price }}</td>
                        </tr>
                        </tbody>
                    @endforeach
                    @endforeach
                </table>
        </div>
    </div>
      </div>

    </div>
  </div>
@include('includes.footer')
@endsection
{{-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Login') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> --}}

