@extends('layouts.app')
@section('title', config('app.name'))
@section('styles')
  <style>
.tt-query {
  -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
     -moz-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
          box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
}

.tt-hint {
  color: #999
}

.tt-menu {    /* used to be tt-dropdown-menu in older versions */
  width: 200px;
  margin-top: 4px;
  padding: 4px 0;
  background-color: #fff;
  border: 1px solid #ccc;
  border: 1px solid rgba(0, 0, 0, 0.2);
  -webkit-border-radius: 4px;
     -moz-border-radius: 4px;
          border-radius: 4px;
  -webkit-box-shadow: 0 5px 10px rgba(0,0,0,.2);
     -moz-box-shadow: 0 5px 10px rgba(0,0,0,.2);
          box-shadow: 0 5px 10px rgba(0,0,0,.2);
}

.tt-suggestion {
  padding: 3px 20px;
  line-height: 24px;
}

.tt-suggestion.tt-cursor,.tt-suggestion:hover {
  color: #fff;
  background-color: #0097cf;

}

.tt-suggestion p {
  margin: 0;
}
  </style>
@endsection
@section('body-class', 'landing-page sidebar-collapse')
@section('content')
<div class="page-header header-filter" data-parallax="true" style="background-image: url('{{ asset('img/Pinata01.jpg') }}')">
    <div class="container">
      <div class="row">
        <div class="col-md-6">
          <h1 class="title">Bienvenido a {{ config('app.name') }}.</h1>
          <h4>
                Tienda en linea donde encuentras lo que buscas.
          </h4>
          <br>
          <!--<video width="600" height="400" controls URL pixels>
             <source src="{{ asset('/media/Kyoukai no Kanata 1 Sub Español Online gratis.mp4') }}" type="video/mp4">
            <i class="fa fa-play"></i> Watch video
          </video>-->
{{--          <iframe src="https://player.twitch.tv/?channel=mym_alkapone" frameborder="0" allowfullscreen="true" scrolling="no" height="378" width="620"></iframe>--}}
          <div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="main main-raised">
    <div class="container">
      <div class="section text-center">
        <div class="row">
          <div class="col-md-8 ml-auto mr-auto">
            <h2 class="title">Producto</h2>
            <h5 class="description">
                Somos una empresa dedicada a la venta de productos por pedido mas segura.
            </h5>

          </div>
        </div>
        <div class="features">
          <div class="row">
            <div class="col-md-4">
              <div class="info">
                <div class="icon icon-info">
                  <i class="material-icons">chat</i>
                </div>
                <h4 class="info-title">Chat Libre</h4>
                <p>
                    Chatea con nosotros en <b>linea</b>.
                </p>
              </div>
            </div>
            <div class="col-md-4">
              <div class="info">
                <div class="icon icon-success">
                  <i class="material-icons">verified_user</i>
                </div>
                <h4 class="info-title">Usuarios Confiables</h4>
                <p>Clientes y Vendedores Confiables</p>
              </div>
            </div>
            <div class="col-md-4">
              <div class="info">
                <div class="icon icon-danger">
                  <i class="material-icons">fingerprint</i>
                </div>
                <h4 class="info-title">Seguridad</h4>
                <p>
                    Todos tus productos estan seguros con altos protocolos de seguridad
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="section text-center">
        <h2 class="title">Visita nuestras categorias</h2>

        <form action="{{ url('/search') }}" class="form-inline align-content-center text-center" method="GET">
          <input type="text" class="form-control typeahead" placeholder="¿Qué producto buscas?" name="query" id="search">
          <button type="submit" class="btn btn-primary btn-just-icon">
            <i class="material-icons">search</i>
          </button>
        </form>

        <div class="team">
          <div class="row">
            @foreach($categories as $category)
            <div class="col-md-4">
              <div class="card team-player">
                <div class="card card-plain">
                  <div class="col-md-6 ml-auto mr-auto">
                    <img src="{{ $category->featured_image_url  }}" alt="Imagen representativa de la categoria  " class="img-raised rounded-circle img-fluid" width="250px" height="250px">
                  </div>
                  <h4 class="card-title">
                    <a href="{{ url('/categories/'.$category->id) }}">
                    {{ $category->name }}
                    </a>
                  </h4>
                  <div class="card-body">
                    <p class="card-description">{{ $category->description }}</p>
                  </div>
                </div>
              </div>
            </div>
            @endforeach
            </div>
          </div>
        </div>
      </div>
      <div id="app">
          <contact></contact>
      </div>
    </div>
  </div>
@include('includes.footer')
@endsection
@section('scripts')
  <script src="{{ asset('js/typeahead.bundle.min.js') }}"></script>
  <script>
        $(function () {
          //type head sobre input de busqueda
          var products = new Bloodhound({
          queryTokenizer: Bloodhound.tokenizers.whitespace,
          datumTokenizer: Bloodhound.tokenizers.whitespace,
          prefetch: '{{ url("/products/json") }}'
        });

          $('#search').typeahead({
            hint: true,
            highlight: true,
            minlenght: 1
          }, {
            name: 'products',
            source: products
          });
        });
  </script>
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
