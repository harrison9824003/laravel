<template>
    <div class="dropdown">
        <a class="btn btn-outline-secondary border-0" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" title="購物車">
            <i class="bi bi-bag"></i>購物車
        </a>

        <ul class="dropdown-menu">
            <li v-for="(product) in cartProducts" :key="product.id">                
                <a class="dropdown-item me-1" href="#">
                    <img v-if="product.photo" :src="product.photo" class="img-cover cart-list-img me-1" alt="">
                    <span>{{product.name}}</span>
                </a>
            </li>
            <li class="w-100" v-if="cartItemCnt > 0 && cartItemCnt > 5"><p class="text-center mb-0">...共 {{cartItemCnt}} 商品</p></li>
            <li class="w-100" v-if="cartItemCnt > 0"><a href="/user/auth/list-cart" class="btn btn-outline-primary border-0 w-100">前往購物車</a></li>
            <li class="w-100" v-else><p class="text-center mb-0">購物車目前為空值</p></li>
        </ul>
    </div>    
</template>

<script>
    import axios from 'axios'
    axios.defaults.withCredentials = true
    export default { 
        data(){
            return {
                cartItems:[],
                cartItemCnt:0,
                cartProducts: [],
            }
        },
        methods:{
            getCart(){
                // 取得 cart 內容
                let url = 'http://127.0.0.1:8000/user/auth/get-carts?pageCnt=5'
                axios.get(url).then(
                    response => {
                        //console.log("success",this)
                        //console.log(response)
                       
                       // 原本內容初始,每次新增到購物車後會更新
                        this.cartProducts = []
                        this.cartItemCnt = 0

                        // 添加傳回的資料
                        for ( let i = 0 ; i < response.data.cart_data.length ; i++ ) {
                            //console.log(response.data.cart_data[i]);
                            response.data.cart_data[i]['photo'] = response.data.cart_img[response.data.cart_data[i]['id']]
                            if ( response.data.cart_data[i]['photo'] != '' ) response.data.cart_data[i]['photo'] = '/' + response.data.cart_data[i]['photo']
                            this.cartProducts.push(response.data.cart_data[i])
                        }
                        console.log(response.data.cart_cnt);
                        this.cartItemCnt = response.data.cart_cnt
                    },
                    error => {
                        //console.log("erros",this)
                        console.log(error)
                    }
                )
            }
        },
        beforeCreate() {
            // 建立全局事件總線
            Vue.prototype.$bus = this
        },
        mounted() {   
            
            this.getCart()
            window.$cartComponent = this

        },
        beforeDestroy() {
        }
    }
</script>