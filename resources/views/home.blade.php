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
                                 {{-- <input type="hidden" id="quantity" value="{{ $detail->quantity }}"> --}}
                                 <td>{{ $detail->quantity }}</td>
                                 <td>$ {{ $detail->quantity * $detail->product->price }}</td>
                                <td class="td-actions">
                                    <form method="POST" action="{{ url('/cart/') }}">
                                        @csrf
                                        {{ method_field('DELETE') }}
                                        <input id="cartid" type="hidden" name="cart_detail_id" value="{{ $detail->id }}">
                                        <a href="{{ url('/products/'.$detail->product->id) }}" target="_blank" rel="tooltip" title="Ver Producto" class="btn btn-info btn-round btn-sm">
                                        <i class="material-icons">visibility</i>
                                        </a>
                                        <button type="submit"
                                        rel="tooltip"
                                        title="Eliminar"
                                        class="btn btn-danger btn-round btn-sm">
                                            <i class="material-icons">close</i>
                                        </button>
                                        <a class="btn btn-sm btn-round btn-primary" data-toggle="modal" data-target="#cart"
                                        style="color: white;"
                                        rel="tooltip"
                                        data-id="{{ $detail->id }}"
                                        data-quantity="{{ $detail->quantity }}"
                                        data-productname="{{ $detail->product->name }}"
                                        title="Agregar mas productos">
                                          <i class="material-icons">add_shopping_cart</i>
                                        <div class="ripple-container"></div></a>
{{--                                        Modal agregar detalle https://youtu.be/Q2sXw_RCbis--}}
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
                        @if($cart->status == 'Pending')
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
                        @else
                            <div class="text-center">
                                Aun no haz realizado Pedidos, comienza aqui <a href="{{ route('inicio') }}">Empezar a Pedir</a>
                            </div>
                        @endif
                    @endforeach
                </table>
        </div>
        </div>
      </div>
    </div>
  <div class="modal fade" id="cart" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{ route('cart.update', 'cart' ) }}" method="POST">
            @csrf
            @method('PUT')
            <input type="hidden" name="id" id="id">
            <input type="number" min="0" name="quantity" class="form-control" id="quantity">

          <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Save changes</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@include('includes.footer')
@endsection
@push('scripts')
<script>
    $('#cart').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget) // Button that triggered the modal
  var id = button.data('id') // Extract info from data-* attributes
  var quantity = button.data('quantity') // Extract info from data-* attributes
  var productname = button.data('productname') // Extract info from data-* attributes
  // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
  // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
  var modal = $(this)
  modal.find('.modal-body #id').val(id);
  modal.find('.modal-body #quantity').val(quantity);
  modal.find('.modal-title').text('Modificar Cantidad del Articulo ' + productname);
})
</script>
@endpush
