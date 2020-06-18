 @extends('layouts.app')
@section('title', 'App Shop | Dashboard')
@section('body-class', 'profile-page sidebar-collapse')
@section('content')
  <div class="page-header header-filter" data-parallax="true" style="background-image: url('{{ asset('img/producto.jpg') }}');"></div>
  <div class="main main-raised">
    <div class="profile-content">
      <div class="container">
        <div class="row">
          <div class="col-md-6 ml-auto mr-auto">
            <div class="profile">
              <div class="avatar">
                <img src="{{ $product->featured_image_url }}" alt="Circle Image" class="img-raised rounded-circle img-fluid">
              </div>
              @if (session('notification'))
                <div class="alert alert-success" role="alert">
                    {{ session('notification') }}
                </div>
              @endif

              <div class="name">
                <h3 class="title">{{ $product->name }}</h3>
                <h6>{{ $product->category->name }}</h6>
                {{-- <a href="#pablo" class="btn btn-just-icon btn-link btn-dribbble"><i class="fa fa-dribbble"></i></a>
                    <a href="#pablo" class="btn btn-just-icon btn-link btn-twitter"><i class="fa fa-twitter"></i></a>
                    <a href="#pablo" class="btn btn-just-icon btn-link btn-pinterest"><i class="fa fa-pinterest"></i></a> --}}
              </div>
            </div>
          </div>
        </div>
        <div class="description text-center">
          <p>{{ $product->long_description }} </p>
        </div>

        <div class="text-center">
        <button class="btn btn-primary btn-round" data-toggle="modal" data-target="#ModalAddtoCart">
          <i class="material-icons">add</i> Añadir al Carrito de Compras
        </button>
        </div>
        <div class="row">
          <div class="col-md-6 ml-auto mr-auto">
            <div class="profile-tabs">
            </div>
          </div>
        </div>
        <div class="tab-content tab-space">
          <div class="tab-pane active text-center gallery">
            <div class="row">
              <div class="col-md-3 ml-auto">
                @foreach($imagesLeft as $il)
                <img src="{{ $il->url}}" class="rounded">
                @endforeach
              </div>
              <div class="col-md-3 mr-auto">
                @foreach($imagesRigth as $ir)
                <img src="{{ $ir->url}}" class="rounded">
                @endforeach
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>


<!-- Modal -->
<div class="modal fade" id="ModalAddtoCart" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Seleccione Cantidad</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="POST" action="{{ url('/cart') }}">
        @csrf
        <input type="hidden" name="product_id" value="{{ $product->id }}">
      <div class="modal-body">
        <input class="form-control" type="number" name="quantity" value="1">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <button type="submit" class="btn btn-primary">Añadir al Carrito</button>
      </div>
      </form>
    </div>
  </div>
</div>
@include('includes.footer')
@endsection