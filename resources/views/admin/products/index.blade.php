    @extends('layouts.app')
@section('title', 'Listado de Productos')
@section('body-class', 'profile-page')
@section('content')

<div class="page-header header-filter" data-parallax="true" style="background-image: url('{{ asset('img/botw.jpg') }}')">

  </div>
  <div class="main main-raised">
    <div class="container">
        @if( $errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
      <div class="section text-center">
        <h2 class="title">Listado de Productos Disponibles</h2>
        <div class="team">
                <a href="{{ url('/admin/products/create') }}" class="btn btn-primary btn-round">Nuevo Producto</a>
          <div class="row">
                <table class="table">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th class="text-center">Nombre</th>
                                <th class="text-center">Descripción</th>
                                <th class="text-center">Categoría</th>
                                <th class="text-right">Precio</th>
                                <th class="text-right">Opciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $p)
                            <tr>
                                <td class="text-center">{{ $p->id }}</td>
                                <td>{{ $p->name }}</td>
                                <td>{{ $p->description }}</td>
                                <td>{{ $p->category_name }}</td>
                                 <td class="text-right">$ {{ $p->price }}</td>
                                <td class="td-actions text-right">

                                    <form method="POST" action="{{ url('/admin/products/'.$p->id) }}">
                                        @csrf
                                        {{ method_field('DELETE') }}
                                        <a href="{{ url('/products/'.$p->id) }}" rel="tooltip" title="Ver Producto" class="btn btn-info btn-round btn-sm" target="_blank">
                                        <i class="material-icons">visibility</i>
                                        </a>
                                        <a href="{{ url('/admin/products/'.$p->id.'/edit') }}" rel="tooltip" title="Editar Producto" class="btn btn-success btn-round btn-sm">
                                            <i class="material-icons">edit</i>
                                        </a>
                                        <a href="{{ url('/admin/products/'.$p->id.'/images') }}" rel="tooltip" title="Imagenes Del Producto" class="btn btn-warning btn-round btn-sm">
                                        <i class="material-icons">image</i>
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
                            @endforeach
                        </tbody>
                </table>
                    <div class="text-center">
                    {{ $products->links() }}
                    </div>
            </div>
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
