@extends('layouts.app')
@section('title', 'App Shop | Dashboard')
@section('body-class', 'profile-page sidebar-collapse')
@section('content')
  <div class="page-header header-filter" data-parallax="true" style="background-image: url('{{ asset('img/categorias.jpg') }}');"></div>
  <div class="main main-raised">
    <div class="profile-content">
      <div class="container">
        <div class="row">
          <div class="col-md-6 ml-auto mr-auto">
            <div class="profile">
              <div class="avatar">
                <img src="{{ $category->featured_image_url }}" alt="Imagen Representativa  de la categoria {{ $category->name }}" class="img-raised rounded-circle img-fluid">
              </div>
              @if (session('notification'))
                <div class="alert alert-success" role="alert">
                    {{ session('notification') }}
                </div>
              @endif

              <div class="name">
                <h3 class="title">{{ $category->name }}</h3>
                <a href="#pablo" class="btn btn-just-icon btn-link btn-dribbble"><i class="fa fa-dribbble"></i></a>
                <a href="#pablo" class="btn btn-just-icon btn-link btn-twitter"><i class="fa fa-twitter"></i></a>
                <a href="#pablo" class="btn btn-just-icon btn-link btn-pinterest"><i class="fa fa-pinterest"></i></a>
              </div>
            </div>
          </div>
        </div>
        <div class="description text-center">
          <p>{{ $category->description }} </p>
        </div>
        <div class="row">
          <div class="col-md-6 ml-auto mr-auto">
            <div class="profile-tabs">
            </div>
          </div>
        </div>
           <div class="team text-center">
          <div class="row">
            @foreach($products as $p)
            <div class="col-md-4">
              <div class="card team-player">
                <div class="card card-plain">
                  <div class="col-md-6 ml-auto mr-auto">
                    <img src="{{ $p->featured_image_url  }}" alt="Thumbnail Image" class="img-raised rounded-circle img-fluid" width="250px" height="250px">
                  </div>
                  <h4 class="card-title">
                    <a href="{{ url('/products/'.$p->id) }}">
                    {{ $p->name }}
                    </a>
                    {{-- <small class="card-description text-muted">{{$p->category_name}}</small> --}}
                  </h4>
                  <div class="card-body">
                    <p class="card-description">{{ $p->description }}</p>
                  </div>
                </div>
              </div>
            </div>
            @endforeach
            </div>
            <div class="row justify-content-center" >
              {{ $products->links() }}
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>


@include('includes.footer')
@endsection
