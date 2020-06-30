@extends('layouts.app')
@section('title', 'Editar un Producto')
@section('body-class', 'profile-page sidebar-collapse')
@section('content')
<div class="page-header header-filter" data-parallax="true" style="background-image: url('{{ asset('img/botw.jpg') }}')"></div>
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
                @if (session('notification'))
                    <div class="alert alert-success" role="alert">
                        {{ session('notification') }}
                    </div>
                @endif
            <div class="section ">
                <h2 class="title text-center">Editar mi perfil</h2>
                <form method="POST" action="{{ route('users.update', $user) }}">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group label-floating">
                                <label class="control-label">Nombre:</label>
                                <input type="text" value="{{ old('name',$user->name) }}" name="name" class="form-control" />
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group label-floating">
                                <label class="control-label">Correo electrónico</label>
                                <input type="email" value="{{ old('email',$user->email)}}" name="email" class="form-control" />
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group label-floating">
                                <label class="control-label">Telefono</label>
                                <input type="text" value="{{ old('phone',$user->phone) }}" name="phone" class="form-control" />
                                @error('phone')
                                <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group label-floating">
                                <label class="control-label">Dirección de envío</label>
                                <input name="address" type="text" class="form-control" value="{{ old('address', $user->address) }}">
                                @error('address')
                                <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="">Nombre de Usuario</label>
                        <input type="text" class="form-control" name="username" value="{{ old('username', $user->name) }}">
                        @error('username')
                        <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                                </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="password">Contraseña</label>
                        <div class="input-group @error('password') is-invalid @else is-valid @enderror">
                            <input placeholder="" name="password" type="password" class="form-control">
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="password_confirmation">Repite la contraseña</label>
                        <div class="input-group">
                            <input type="password"
                                   name="password_confirmation"
                                   class="form-control"
                                   placeholder="">
                        </div>
                        <small style="color: red"> *Si no deseas cambiar tu contraseña no es necesario escribir algo</small>
                    </div>
                    <button type="submit" class="btn btn-info">Guardar Cambios</button>
                    <a href="{{ url('/') }}" class="btn btn-danger">Cancelar</a>
                </form>
            </div>

        </div>
    </div>
@include('includes.footer')
@endsection
