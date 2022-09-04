<template>
    <a role="button" @click.pervent="$store.dispatch('addCartBtn/addToCart', id)" :class="classArr"><i class="bi bi-cart-plus me-3"></i>{{ text }}</a>
</template>

<script>
    
    export default {
        data(){
            return {
                classArr: ['link-secondary', 'fs-3']
            }
        },
        props:['id', 'text'],
        mounted(){
            if ( this.text != '' ) {
                this.classArr = [
                    'btn', 
                    'btn-outline-secondary', 
                    'w-100'
                ];
                console.log(this.classArr)
            } else {
                this.classArr = [
                    'link-secondary', 
                    'fs-3'
                ];
            }
        }
    }
</script>