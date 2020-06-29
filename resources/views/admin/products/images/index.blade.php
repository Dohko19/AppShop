@extends('layouts.app')
@section('title', 'Imagenes de Productos')
@section('body-class', 'profile-page')
@section('content')

<div class="page-header header-filter" data-parallax="true" style="background-image: url('{{ asset('img/botw5.jpg') }}')">

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
        <h2 class="title">Imagenes de Productos "{{ $product->name }}"</h2>
        <div class="team">
            <form method="POST" action="" enctype="multipart/form-data">
                @csrf
                <input type="file" name="photo" required>
                <button type="submit" class="btn btn-primary btn-round">Subir Nueva Imagen</button>
                <a href="{{ url('/admin/products') }}" class="btn btn-default btn-round">Volver al Listado de Productos</a>
            </form>

            <hr>
            <div class="row">
            @foreach($images as $i)
            <div class="col-md-4">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <img src="{{ $i->img }}" width="250">
                        <form method="POST" action="">
                            @csrf
                            {{ method_field('DELETE') }}
                            <input type="hidden" name="image_id" value="{{ $i->id }}" required>
                        <button type="submit" class="btn btn-danger btn-round">Eliminar</button>
                        @if($i->featured)
                        <button class="btn btn-info btn-fab btn-fab-mini btn-round" rel="tooltip" title="Imagen Destacada Actual">
                          <i class="material-icons">favorite</i>
                        </button>
                        @else
                        <a href="{{ url('/admin/products/'.$product->id.'/images/select/'.$i->id) }}" class="btn btn-primary btn-fab btn-fab-mini btn-round">
                          <i class="material-icons">favorite</i>
                        </a>
                        @endif
                        </form>
                    </div>
                </div>
            </div>
             @endforeach
            </div>
          </div>
        </div>
      </div>


    </div>
  </div>
@include('includes.footer')
@endsection
