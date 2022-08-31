<template>
    <div class="dropdown">
        <a class="btn btn-outline-secondary border-0" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" title="購物車">
            <i class="bi bi-bag"></i>購物車
        </a>

        <ul class="dropdown-menu">
            <li v-for="(product) in cartItems" :key="product.id">
                <a class="dropdown-item me-1" href="#">{{product.name}}</a>
            </li>
            <li class="w-100" v-if="cartItemCnt > 0 && cartItemCnt > 5"><p class="text-center mb-0">...共 {{cartItemCnt}} 商品</p></li>
            <li class="w-100" v-if="cartItemCnt > 0"><a href="/user/auth/list-cart" class="btn btn-outline-primary border-0 w-100">前往購物車</a></li>
            <li class="w-100" v-else><p class="text-center mb-0">購物車目前為空值</p></li>
        </ul>
    </div>    
</template>

<script>
    import axios from 'axios'
    export default { 
        data(){
            return {
                cartItems:[],
                cartItemCnt:0,
                cartProducts: [
                    {id:1,name:'商品1',cnt:2},
                    {id:2,name:'商品2',cnt:3},
                    {id:3,name:'商品3',cnt:1},
                    {id:4,name:'商品4',cnt:1},
                    {id:5,name:'商品5',cnt:1},
                    {id:6,name:'商品6',cnt:1},
                ]
            }
        },
        beforeCreate() {
            // 建立全局事件總線
            Vue.prototype.$bus = this
        },
        mounted() {        
            this.cartItems = this.cartProducts.length > 5 ? this.cartProducts.slice(0,5) : this.cartProducts
            this.cartItemCnt = this.cartProducts.length   
            
            // 取得 cart 內容
            let url = 'http://127.0.0.1:8000/user/auth/get-cart'
            axios.post(url, {}).then(
                response => {
                    console.log(this)
                    console.log(response.data)
                },
                error => {
                    console.log(this)
                    console.log(error)
                }
            )

        },
        beforeDestroy() {
        }
    }
</script>