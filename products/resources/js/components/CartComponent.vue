<template>
    <div class="dropdown">
        <a class="btn btn-outline-secondary border-0" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" title="購物車">
            <i class="bi bi-bag"></i>購物車
        </a>

        <ul class="dropdown-menu">
            <li v-for="(product) in getSliceCartData" :key="product.id">                
                <a class="dropdown-item me-1" href="#">
                    <img v-if="product.photo" :src="product.photo" class="img-cover cart-list-img me-1" alt="">
                    <span>{{product.name}}</span>
                </a>
            </li>
            <li class="w-100" v-if="userCartCnt > 0 && userCartCnt > 5"><p class="text-center mb-0">...共 {{userCartCnt}} 商品</p></li>
            <li class="w-100" v-if="userCartCnt > 0"><a href="/user/auth/list-cart" class="btn btn-outline-primary border-0 w-100">前往購物車</a></li>
            <li class="w-100" v-else><p class="text-center mb-0">購物車目前為空值</p></li>
        </ul>
    </div>    
</template>

<script>
    // import axios from 'axios'
    import {mapState, mapGetters} from 'vuex'
    // axios.defaults.withCredentials = true
    export default { 
        data(){
            return {
            }
        },
        computed:{
            ...mapState('CartList', ['userCartCnt']),
            ...mapGetters('CartList', ['getSliceCartData'])
        },
        methods:{
            getCart(){
                this.$store.dispatch('CartList/getCart')                        
            }
        },
        beforeCreate() {
            // 建立全局事件總線
            Vue.prototype.$bus = this
        },
        mounted() {  
            this.getCart()
        },
        beforeDestroy() {
        }
    }
</script>