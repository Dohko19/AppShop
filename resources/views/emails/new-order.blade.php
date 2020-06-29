@component('mail::message')
# Tienes un nuevo pedido de tu sitio {{ config('app.name') }}

A continuacion te mostramos un resumen del pedido y los datos del cliente.
@component('mail::panel')
-Nombre:  {{ $user->name }} <br>
-Email: {{ $user->email }} <br>
-Fecha del Pedido: {{ $cart->order_date }} <br>
<hr>

-Direccion: {{ $user->address }} <br>
-Telefono de contacto: {{ $user->phone }} <br>
@endcomponent

@component('mail::button', ['url' => url('/admin/orders/'.$cart->id)])
Ver detalles del pedido
@endcomponent

# Detalles del Pedido
<ul>
@foreach($cart->details as $detail)
    <li>
        {{ $detail->product->name }} x {{ $detail->quantity }} ($ {{ $detail->quantity * $detail->product->price }})
        <br>
        Comentarios Adicionales: {{ $detail->comment }}
    </li>
@endforeach
</ul>
# Importe a Pagar:
<b>
{{ $cart->total }}
</b>
<br>
<hr>
Gracias por utilizar nuestro Servicio,<br>
{{ config('app.name') }}
@endcomponent
