@extends('layouts.app')
@section('body-class', 'login-page sidebar-collapse')
@section('content')
    <div class="page-header header-filter" style="background-image: url('{{ asset('img/Pinata02.jpg ') }}'); background-size: cover; background-position: top center;">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-6 col-sm-12 ml-auto mr-auto">
                    <div class="card card-login">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <form method="POST" action="{{ route('password.email') }}" class="form">
                            @csrf
                            <div class="card-header card-header-primary text-center">
                                <h4 class="card-title">Recupera tu contraña</h4>
                            </div>
                            <div class="card-body">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                          <i class="material-icons">email</i>
                                        </span>
                                    </div>
                                    <input id="email" placeholder="Correo Electronico" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="footer text-center">
                                <button type="submit" class="btn btn-primary btn-link btn-wd btn-lg">{{ __('Restaurar Contraseña') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @include('includes.footer')
    </div>
@endsection
