<template>
    <div class="section section-contacts">
        <div class="row">
            <div class="col-md-8 ml-auto mr-auto">
                <h2 class="text-center title">Contactanos</h2>
                <h4 class="text-center description">
                   Ponte en contacto directo con nostros para enviar comentarios
                    informes sobre el sitio o solicitar nuestros servicios
                </h4>
                <transition name="fade" mode="out-in">
                    <p v-if="send">Tu mensaje a sido recibido te contactaremos pronto</p>
                    <form v-else @submit.prevent="submit">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="bmd-label-floating">Nombre</label>
                                    <input v-model="form.name" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="bmd-label-floating">Tu Correo</label>
                                    <input v-model="form.email" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="bmd-label-floating">Mensaje</label>
                            <textarea v-model="form.message" class="form-control" rows="4"></textarea>
                        </div>
                        <div class="row">
                            <div class="col-md-4 ml-auto mr-auto text-center">
                                <button class="btn btn-primary btn-raised" :disabled="working">
                                   <span v-if="working">Enviando...</span>
                                <span v-else="working">Enviar Mensaje</span>
                                </button>
                            </div>
                        </div>
                    </form>
                </transition>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data(){
            return {
                send: false,
                working: false,
                form: {
                    name: '',
                    email: '',
                    subject: '',
                    message: ''
                }
            }
        },
        methods:{
            submit(){
                this.working = true;
                axios.post('/api/messages', this.form)
                    .then(res => {
                        this.send = true;
                        this.working = false;
                    })
                    .catch(errors => {
                        console.log(errors);
                        this.sent = false;
                        this.working = false;
                    })
            }
        },
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
<style>
    .fade-enter-active, .fade-leave-active {
        transition: opacity .5s;
    }
    .fade-enter, .fade-leave-to /* .fade-leave-active below version 2.1.8 */ {
        opacity: 0;
    }
    /* Enter and leave animations can use different */
    /* durations and timing functions.              */
    .slide-fade-enter-active {
        transition: all .8s ease;
    }
    .slide-fade-leave-active {
        transition: all .6s cubic-bezier(.17, .67, .83, .67);
    }
    .slide-fade-enter, .slide-fade-leave-to
        /* .slide-fade-leave-active below version 2.1.8 */ {
        transform: translateY(800px);
        opacity: 0;
    }
</style>
