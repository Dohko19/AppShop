@extends('layouts.app')
@section('title', 'Editar un Producto')
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
        <h2 class="title text-center">Editar Categoria</h2>
        <form method="POST" action="{{ url('/admin/categories/'.$category->id.'/edit') }}" enctype="multipart/form-data">
            @csrf
            <div class="row">
            <div class="col-sm-6">
                 <div class="form-group label-floating">
                     <label class="control-label">Nombre de la Categoria</label>
                     <input type="text" value="{{ old('name',$category->name) }}" name="name" class="form-control" />
                 </div>
            </div>
            <div class="col-sm-6">
                     <label class="control-label">Imagen de la Categoria</label>
                     <input type="file" name="image"/>
                     @if($category->image)
                     <p class="help-block">Subir solo si desea reemplazar la
                      <a href="{{ asset('/images/categories/'.$category->image) }}" target="_blank">imagen actual</a></p>
                    @endif
            </div>
         </div>
            <div class="form-group">
                    <label for="exampleFormControlTextarea1">Descripcion de la Categoria</label>
                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="5" name="description">{{ old('description',$category->description) }}</textarea>
             </div>

             <button type="submit" class="btn btn-primary">Guardar Cambios</button>
             <a href="{{ url('/admin/categories') }}" class="btn btn-danger">Cancelar</a>
        </form>
      </div>

    </div>
  </div>
@include('includes.footer')
@endsection