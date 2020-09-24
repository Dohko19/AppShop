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
        <h2 class="title text-center">Editar Producto</h2>
        <form method="POST" action="{{ url('/admin/products/'.$product->id.'/edit') }}">
            @csrf
            <div class="row">
            <div class="col-sm-6">
                 <div class="form-group label-floating">
                     <label class="control-label">Nombre del Producto</label>
                     <input type="text" value="{{ old('name',$product->name) }}" name="name" class="form-control" />
                 </div>
            </div>
            <div class="col-sm-6">
            <div class="form-group label-floating">
                    <label class="control-label">Precio</label>
                    <input type="number" step="0.01" value="{{ old('price',$product->price)}}" name="price" class="form-control" />
            </div>
            </div>
         </div>
            <div class="row">
            <div class="col-sm-6">
            <div class="form-group label-floating">
                    <label class="control-label">Descripcion Corta</label>
                    <input type="text" value="{{ old('description',$product->description) }}" name="description" class="form-control" />
            </div>
            </div>
            <div class="col-sm-6">
            <div class="form-group label-floating">
                    <label class="control-label">Categoria del Producto</label>
                    <select class="form-control" name="category_id">
                        <option value="0">General</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" @if ($category->id == old('category_id', $product->category_id))
                              selected
                            @endif>
                              {{ $category->name }}</option>
                        @endforeach
                    </select>
            </div>
            </div>
         </div>
            <div class="form-group">
                    <label for="exampleFormControlTextarea1">Descripcion Extensa del Producto</label>
                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="5" name="long_description"> {{ old('long_description',$product->long_description) }}</textarea>
             </div>

             <div class="form-check">
                  <label class="form-check-label">
                      Producto activo o disponible?
                      <input class="form-check-input" name="active" value="1" type="checkbox" {{ $product->active == 1 ? 'checked' : '' }} >
                      <span class="form-check-sign">
                          <span class="check"></span>
                      </span>
                  </label>
              </div>

             <button type="submit" class="btn btn-primary">Guardar Cambios</button>
             <a href="{{ url('/admin/products') }}" class="btn btn-danger">Cancelar</a>
        </form>
      </div>

    </div>
  </div>
@include('includes.footer')
@endsection