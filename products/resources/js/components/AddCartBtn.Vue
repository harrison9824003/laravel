<template>
    <a href="#" class="link-secondary fs-3" @click.prevent="add_cart(product_id)"><i class="bi bi-cart-plus"></i></a>
</template>

<script>
import axios from 'axios'
export default {
    props:['product_id'],
    methods:{
        add_cart(product_id) {
            axios.post('http:\/\/localhost:8080/user/auth/getCart', {

            }).then(
                response => {
                    console.log('success', response.data)
                },
                error => {
                    console.log('error', error.message)
                }
            )
        }
    }
}
</script>
