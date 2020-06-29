@component('mail::message')
# Tu Pedido con numero '{{ $cart->id }}' ya fue entregado

# Gracias por tu pedido, {{ $cart->user->name }}

<h1> Total: {{ $cart->total }}</h1>

# Detalles del Pedido
<br>
<ul>
    @foreach($cart->details as $detail)
        <li>
            {{ $detail->product->name }} x {{ $detail->quantity }} ($ {{ $detail->quantity * $detail->product->price }})
            <br>
            Comentarios Adicionales: {{ $detail->comment }}
        </li>
    @endforeach
</ul>

Gracias por comprar con nosotros,<br>
{{ config('app.name') }}
@endcomponent
