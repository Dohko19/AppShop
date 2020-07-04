<template>
    <div>
        <div class="page-header header-filter" data-parallax="true" style="background-image: url() }}')">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <h1 class="title">Bienvenido a .</h1>
                        <h4>
                            Tienda en linea donde encuentras lo que buscas.
                        </h4>
                        <br>
<!--                        <video width="600" height="400" controls URL pixels>-->
<!--                           <source src="{{ asset('/media/Kyoukai no Kanata 1 Sub Español Online gratis.mp4') }}" type="video/mp4">-->
<!--                          <i class="fa fa-play"></i> Watch video-->
<!--                        </video>-->
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

<!--                    <form action="{{ url('/search') }}" class="form-inline align-content-center text-center" method="GET">-->
<!--                        <input type="text" class="form-control typeahead" placeholder="¿Qué producto buscas?" name="query" id="search">-->
<!--                        <button type="submit" class="btn btn-primary btn-just-icon">-->
<!--                            <i class="material-icons">search</i>-->
<!--                        </button>-->
<!--                    </form>-->

                    <div class="team">
                        <div class="row">
<!--                            @foreach($categories as $category)-->
                            <div class="col-md-4" v-for="category in categories">
                                <div class="card team-player">
                                    <div class="card card-plain">
                                        <div class="col-md-6 ml-auto mr-auto">
                                            <img :src="category.featured_image_url" alt="Imagen representativa de la categoria  " class="img-raised rounded-circle img-fluid" width="250px" height="250px">
                                        </div>
                                        <h4 class="card-title">
                                            <router-link :to="{name: 'category_show', params: {id: category.id}}">{{ category.name}}</router-link>
                                        </h4>
                                        <div class="card-body">
                                            <p class="card-description" v-text="category.description"></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
<!--                            @endforeach-->
                        </div>
                    </div>
                </div>
            </div>
                <contact></contact>
        </div>
    </div>
</template>
<script>
    export default {
        data() {
            return {
                categories: []
            }
        },
        methods: {
            categoriesList(){
                axios.get('api/categoriesList')
                .then(res => {
                    console.log(res)
                    this.categories = res.data;
                })
                .catch(err => {
                    console.log(err);
                })
            }
        },
        mounted() {
            this.categoriesList();
        }
    }
</script>

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
