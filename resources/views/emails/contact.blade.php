@component('mail::message')
# Nombre del que envia el mensaje: {{ $name }}
<br>
# Cuerpo del mensaje: {{ $message }} <br>
# Email: {{ $email }}

<br>
{{ config('app.name') }}
@endcomponent
