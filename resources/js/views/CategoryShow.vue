<template>
    <div>
        <div class="page-header header-filter" data-parallax="true" style="background-image: url('/img/categorias.jpg');"></div>
        <div class="main main-raised">
            <div class="profile-content">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6 ml-auto mr-auto">
                            <div class="profile">
                                <div class="avatar">
                                    <img :src="category.featured_image_url" :alt="`Imagen Representativa  de la categoria ${category.name}` " class="img-raised rounded-circle img-fluid">
                                </div>
                                <div class="name">
                                    <h3 class="title"></h3>
                                    <a href="#pablo" class="btn btn-just-icon btn-link btn-dribbble"><i class="fa fa-dribbble"></i></a>
                                    <a href="#pablo" class="btn btn-just-icon btn-link btn-twitter"><i class="fa fa-twitter"></i></a>
                                    <a href="#pablo" class="btn btn-just-icon btn-link btn-pinterest"><i class="fa fa-pinterest"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="description text-center">
                        <p v-text="category.description"></p>
                    </div>
                    <div class="row">
                        <div class="col-md-6 ml-auto mr-auto">
                            <div class="profile-tabs">
                            </div>
                        </div>
                    </div>
                    <div class="team text-center">
                        <div class="row">
<!--                            @foreach($products as $p)-->
                            <div class="col-md-4" v-for="product in products" :key="product.id">
                                <div class="card team-player">
                                    <div class="card card-plain">
                                        <div class="col-md-6 ml-auto mr-auto">
                                            <img :src="product.featured_image_url" alt="Thumbnail Image" class="img-raised rounded-circle img-fluid" width="250px" height="250px">
                                        </div>
                                        <h4 class="card-title">
                                            <router-link :to="{name: 'products_show', params: {id: product.id}}">{{ product.name }}
                                            </router-link>
                                        </h4>
                                        <div class="card-body">
                                            <p class="card-description" v-text="product.description"></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
<!--                            @endforeach-->
                        </div>
                        <div class="row justify-content-center" >
<!--                            {{ $products->links() }}-->
                        </div>
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
                products: [],
                category: {}
            }
        },
        mounted(){
            axios.get(`/api/category/${this.$route.params.id}`)
            .then(res => {
                console.log(res.data);
                this.category = res.data.category;
                this.products = res.data.products.data;
            })
            .catch(err => {
                console.log(err.response.data);
            })
        }
    }
</script>

<style scoped>

</style>
