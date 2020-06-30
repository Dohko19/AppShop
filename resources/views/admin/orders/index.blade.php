@extends('layouts.app')
@section('title', 'App Shop | Dashboard')
@section('body-class', 'profile-page sidebar-collapse')
@section('content')
    <div class="page-header header-filter" data-parallax="true" style="background-image: url('{{ asset('img/categorias.jpg') }}');"></div>
    <div class="main main-raised">
    <div class="profile-content">
        <div class="container">
            <div class="row" >
                <h3 class="title text-center">Lista de mis pedidos</h3>
                <div class="col-md-12">
                    @if (session('notification'))
                    <div class="alert alert-success" role="alert">
                        {{ session('notification') }}
                    </div>
                    @endif
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Estado</th>
                                    <th>Cliente</th>
                                    <th>Direccion de entrega</th>
                                    <th>Telefono</th>
                                    <th>Detalles</th>
                                    <th>Opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                            @forelse($orders as $order)
                                @if($order->status == 'Pending' || $order->status == 'En Preparacion')
                                <tr>
                                    <td>{{ $order->id }}</td>
                                    <td>{{ $order->status }}</td>
                                    <td>{{ $order->user->name }} <br>
                                        {{ $order->user->email }}
                                    </td>
                                    <td>{{ $order->user->address }}</td>
                                    <td>{{ $order->user->phone }}</td>
                                @forelse($order->details as $detail)
                                    <td> Cantidad: {{ $detail->quantity }} <br>
                                         Producto: {{ $detail->product->name }} <br>
                                         Precio: {{ $detail->product->price }} <br>
                                         Total: <b>{{ $order->total }}</b>
                                    </td>
                                    @empty
                                    <td>Sin Informacion</td>
                                @endforelse
                                    <td>
                                        <a href="{{ route('orders.show', $order->id) }}" rel="tooltip" class="btn btn-info btn-round btn-sm"
                                        title="Ver mas..."> <i class="material-icons">visibility</i></a>
                                    </td>
                                    @if($order->status == 'Pending')
                                    <td>
                                        <form method="POST" action="{{ route('orders.status.complete', ['cart' => $order]) }}" style="display: inline">
                                            @csrf
                                            @method('PUT')
                                            <button class="btn btn-sm btn-round btn-success" type="submit"
                                            rel="tooltip"
                                            title="Entregado"><i class="material-icons">check_box</i></button>
                                        </form>

                                    </td>
                                    @endif
                                </tr>
                                @endif
                                @empty
                                    <tr>
                                        <td colspan="7">Aun no hay pedidos</td>
                                    </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="row justify-content-center" >
                        {{ $orders->links() }}
                    </div>
                    <div>
                        <h3 class="title">Pedidos Completados</h3>
                        <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                            <tr class="">
                                <th>#</th>
                                <th>Estado</th>
                                <th>Cliente</th>
                                <th>Direccion de entrega</th>
                                <th>Telefono</th>
                                <th>Detalles</th>
                                <th colspan="2">Opciones</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($orders as $order)
                                @if($order->status == 'Completado')
                                    <tr>
                                        <td>{{ $order->id }}</td>
                                        <td>{{ $order->status }}</td>
                                        <td>{{ $order->user->name }} <br>
                                            {{ $order->user->email }}
                                        </td>
                                        <td>{{ $order->user->address }}</td>
                                        <td>{{ $order->user->phone }}</td>
                                        @forelse($order->details as $detail)
                                            <td> Cantidad: {{ $detail->quantity }} <br>
                                                Producto: {{ $detail->product->name }} <br>
                                                Precio: {{ $detail->product->price }} <br>
                                                Total: <b>{{ $order->total }}</b>
                                            </td>
                                        @empty
                                            <td>Sin Informacion</td>
                                        @endforelse
                                        <td>
                                            <a href="{{ route('orders.show', $order->id) }}" rel="tooltip" class="btn btn-info btn-round btn-sm"
                                               title="Ver mas..."> <i class="material-icons">visibility</i></a>
                                        </td>
                                        @if($order->status == 'En Preparacion')
                                            <td>
                                                <form method="POST" action="{{ route('orders.status.complete', ['cart' => $order]) }}" style="display: inline">
                                                    @csrf
                                                    @method('PUT')
                                                    <button class="btn btn-sm btn-round btn-success" type="submit"
                                                            rel="tooltip"
                                                            title="Entregado"><i class="material-icons">check_box</i></button>
                                                </form>

                                            </td>
                                        @else
                                            <td>
                                                <span class="text-muted">Pedido Completado</span>
                                            </td>
                                        @endif
                                    </tr>
                                @endif
                            @empty
                                <tr>
                                    <td colspan="7">Aun no hay pedidos</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                        <div class="row justify-content-center" >
                            {{ $orders->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('includes.footer')
@endsection
