<template>
    <form action="/transaction" method="post" enctype="multipart/form-data">
        <ul class="list-group">
            <li class="list-group-item d-flex align-items-center" v-for="(cartitem,index) in cartProducts" :key="cartitem.id">
                <span class="me-1">
                    <input type="checkbox" name="cartCheckBox[]" :id="cartitem.id" :checked="cartitem.pcheck" :value="cartitem.id" @click="handleCheck(cartitem.id)">
                </span>
                <label :for="cartitem.id">{{cartitem.name}}</label>            
                <div class="d-inline-block w-cart-input ms-auto">
                    <div class="input-group cartBtnGroup">                    
                        <button class="btn btn-outline-secondary cartBtnMinus" :data-c_id="cartitem.id" @click="MinuxNum($event)" type="button"><i class="bi bi-dash-lg"></i></button>
                        <input name="checkNumber[]" type="number" class="form-control text-center cartBtnInput" placeholder="" aria-label="Example text with two button addons" v-model.number="cartitem.cnt">
                        <input type="hidden" name="checkId[]" :value="cartitem.id">
                        <button class="btn btn-outline-secondary cartBtnPlus" :data-c_id="cartitem.id" @click="PlusNum($event)" type="button"><i class="bi bi-plus-lg"></i></button>
                    </div>                
                </div>    
                <div class="d-inline-block ms-1 text-gray">
                    單價:{{cartitem.price}}
                </div>        
                <div class="d-inline-block ms-1 text-gray">
                    <button class="btn btn-danger" type="button" @click="deleteItem(cartitem.id)"><i class="bi bi-x-lg"></i></button>
                </div>   
            </li>  
            <li class="d-flex">
                <span class="d-inline-block ms-auto">總金額NT$ : {{getTotalPrice}}</span>
            </li>     
            <li class="d-flex">
                <span class="d-inline-block ms-auto">
                    運費$ : 
                    <span v-if="delivery">100</span>
                    <span v-else>0</span>
                </span>
            </li>             
        </ul>
        <div class="d-flex justify-content-end mt-3">
            <input type="hidden" name="_token" :value="csrf">
            <button class="btn btn-outline-success" type="submit">確認結帳</button>
        </div>
    </form>
</template>

<script>
import { computed } from "vue";


    export default {
        data(){
            return {
                cartItemCnt:0,
                cartProducts: [
                    {id:1,name:'商品11',cnt:2, pcheck:true, price:100},
                    {id:2,name:'商品22',cnt:3, pcheck:false, price:100},
                    {id:3,name:'商品33',cnt:1, pcheck:true, price:100},
                    {id:4,name:'商品44',cnt:1, pcheck:true, price:100},
                    {id:5,name:'商品55',cnt:1, pcheck:true, price:100},
                    {id:6,name:'商品66',cnt:1, pcheck:true, price:100},
                ],
                delivery:true,
                csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        },
        methods:{
            MinuxNum(e){
                let c_id = $(e.currentTarget).data("c_id")
                console.log(this.cartProducts)
                this.cartProducts.forEach((current,idx) => {
                    if(current.id == c_id) {
                        console.log(current);
                        let cnt = current.cnt
                        if (cnt <= 0 ) cnt = 0
                        else --cnt 
                        current.cnt = cnt
                    }
                })
            },
            PlusNum(e){
                let c_id = $(e.currentTarget).data("c_id")
                this.cartProducts.forEach((current) => {
                    if(current.id == c_id) {
                        let cnt = current.cnt
                        current.cnt = ++cnt
                    }
                })
            },
            handleCheck(c_id){
                this.cartProducts.forEach((current,idx) => {
                    if(current.id == c_id) current.pcheck = !current.pcheck
                })
            },deleteItem(id){
                console.log(id)
            }  
        },
        computed:{
            getTotalPrice(){
                let total = 0
                for( let i in this.cartProducts) {
                    let p = this.cartProducts[i]
                    if ( !p.pcheck ) continue
                    let p_total = parseInt(p.price) * parseInt(p.cnt)
                    total += p_total
                }
                this.delivery = !(total > 500)
                return new Intl.NumberFormat('zh-TW').format(total)
            }

        },
        beforeCreate() {
            // 建立全局事件總線
            Vue.prototype.$bus = this
        },
        mounted() {        
            console.log('cartlist is mounted')
            this.cartItemCnt = this.cartProducts.length    
        },
        beforeDestroy() {
        }
    }
</script>