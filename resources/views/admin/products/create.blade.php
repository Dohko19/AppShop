@extends('layouts.app')
@section('title', 'Producto Nuevo')
@section('body-class', 'profile-page sidebar-collapse')
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
      <div class="section ">
        <h2 class="title text-center">Registrar Nuevo Productos</h2>
        <form method="POST" action="{{ url('/admin/products') }}">
            @csrf
        <div class="row">
            <div class="col-sm-6">
                 <div class="form-group label-floating">
                     <label class="control-label">Nombre del Producto</label>
                     <input type="text" value="{{ old('name') }}" name="name" class="form-control" />
                 </div>
            </div>
            <div class="col-sm-6">
            <div class="form-group label-floating">
                    <label class="control-label">Precio</label>
                    <input type="number" step="0.01" value="{{ old('price') }}" name="price" class="form-control" />
            </div>
            </div>
         </div>

         <div class="row">
            <div class="col-sm-6">
                <div class="form-group label-floating">
                        <label class="control-label">Descripcion Corta</label>
                        <input type="text" value="{{ old('description') }}" name="description" class="form-control" />
                </div>
            </div>
            <div class="col-sm-6">
            <div class="form-group label-floating">
                    <label class="control-label">Categoria del Producto</label>
                    <select class="form-control" name="category_id">
                        <option value="0">General</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
            </div>
            </div>
         </div>




            <div class="form-group">
                    <label for="exampleFormControlTextarea1">Descripcion Extensa del Producto</label>
                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="5" name="long_description">{{ old('long_description') }}
                    </textarea>
             </div>

             <button type="submit" class="btn btn-primary">Registrar Producto</button>
             <a href="{{ url('/admin/products') }}" class="btn btn-danger">Cancelar</a>

        </form>
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
