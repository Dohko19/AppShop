@component('mail::message')
# Tu pedido con numero {{ $id }} fue confirmado

El negocio esta preparando tu pedido, puedes ver los detalles de tu pedido pulsando el siguiente boton.

@component('mail::button', ['url' => url('/home')])
    Ver mas...
@endcomponent

# Detalles del Pedido
<ul>
    @foreach($cart->details as $detail)
        <li>
            {{ $detail->product->name }} x {{ $detail->quantity }} ($ {{ $detail->quantity * $detail->product->price }})
        </li>
    @endforeach
</ul>



Gracias por tu Preferencia,<br>
{{ config('app.name') }}
@endcomponent
