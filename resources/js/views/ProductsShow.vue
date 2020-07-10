<template>
    <div>
        <div class="page-header header-filter" data-parallax="true" style="background-image: url('img/producto.jpg');"></div>
        <div class="main main-raised">
            <div class="profile-content">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6 ml-auto mr-auto">
                            <div class="profile">
                                <div class="avatar">
                                    <img :src="product.featured_image_url" alt="Circle Image" class="img-raised rounded-circle img-fluid">
<!--                                </div>-->
<!--                                @if (session('notification_fail'))-->
<!--                                <div class="alert alert-warning" role="alert">-->
<!--                                    {{ session('notification_fail') }}-->
<!--                                    <br><br>-->
<!--                                    <a href="{{ route('home') }}">Ir a mi Carrito de compras</a>-->
<!--                                </div>-->
<!--                                @endif-->
                                <div class="name">
                                    <h3 class="title">{{ product.name }}</h3>
<!--                                    <h6>{{ .product.category.name }}</h6>-->
                                    <h6>Precio: ${{ product.price }}</h6>
                                </div>
                            </div>
                        </div>
                            <div class="description text-center">
                                <p>{{ product.long_description }} </p>
                            </div>
                            <button class="btn btn-primary btn-round" data-toggle="modal"
                                    data-target="#ModalAddtoCart" @click="newCart">
                                <i class="material-icons">add</i> Añadir al Carrito de Compras
                            </button>
                    </div>


                    <div class="text-center">
<!--                        @if(Auth::check())-->

<!--                        @else-->
<!--                        <b><p>Tienes que <a href="{{ route('login') }}">Iniciar sesion</a> o-->
<!--                            <a href="{{ route('register') }}">Registrarte</a> Para poder comprar algun producto</p></b>-->
<!--                        @endif-->

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
                                <div class="col-md-3 ml-auto" v-for="ileft in imagesLeft">
<!--                                    @foreach($imagesLeft as $il)-->
                                    <img :src="ileft.url" class="rounded">
<!--                                    @endforeach-->
                                </div>
                                <div class="col-md-3 mr-auto" v-for="iright in imagesRight">
<!--                                    @foreach($imagesRigth as $ir)-->
                                    <img :src="iright.url" class="rounded">
<!--                                    @endforeach-->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="ModalAddtoCart" tabindex="-1" role="dialog" aria-labelledby="addNewCart" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Seleccione Cantidad</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
<!--                    <form method="POST" action="{{ url('/cart') }}">-->
<!--                        @csrf-->
<!--                        <input type="hidden" name="product_id" value="{{ $product->id }}">-->
<!--                        <input type="hidden" name="price" value="{{ $product->price }}">-->
<!--                        <div class="modal-body">-->
<!--                            <input class="form-control" type="number" name="quantity" value="1">-->
<!--                            <textarea name="comment" id="comment" cols="10" rows="10" class="form-control"-->
<!--                                      placeholder="Añade mas detalles para tu producto, ej. Picante extra, aderezos aparte..."></textarea>-->
<!--                        </div>-->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-primary">Añadir al Carrito</button>
                        </div>
<!--                    </form>-->
                </div>
            </div>
        </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                product: {},
                imagesLeft: [],
                imagesRight: [],
            }
        },
        methods: {
            newCart(){
                $('#ModalAddtoCart').modal('show');
            },
        },
        mounted(){
            axios.get(`/api/products/${this.$route.params.id}`)
                .then(res => {
                    console.log(res.data);
                    this.imagesLeft = res.data.imagesLeft;
                    this.imagesRight = res.data.imagesRight;
                    this.product = res.data.product;
                })
                .catch(err => {
                    console.log(err.response)
                })
            }
        }
</script>

<style scoped>

</style>
