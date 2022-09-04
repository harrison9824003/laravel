<template>
    <form action="/transaction" method="post" enctype="multipart/form-data">
        <ul class="list-group">
            <transition-group name="hello" appear>
                <li v-show="cartitem.isShow" class="list-group-item d-flex align-items-center" v-for="(cartitem,index) in cartProducts" :key="cartitem.id">
                    <span class="me-1">
                        <input type="checkbox" name="cartCheckBox[]" :id="cartitem.id" :checked="cartitem.pcheck" :value="cartitem.id" @click="handleCheck(cartitem.id)">
                    </span>
                    <label :for="cartitem.id">{{cartitem.name}}</label>            
                    <div class="d-inline-block w-cart-input ms-auto">
                        <div class="input-group cartBtnGroup">                    
                            <button class="btn btn-outline-secondary cartBtnMinus" :data-c_id="cartitem.id" @click="MinuxNum($event)" type="button"><i class="bi bi-dash-lg"></i></button>
                            <input name="checkNumber[]" type="number" @change="UpdateInputNum($event, cartitem.id)" class="form-control text-center cartBtnInput" placeholder="" aria-label="Example text with two button addons" v-model.number="cartitem.cnt">
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
            </transition-group> 
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
    import axios from 'axios'
    export default {
        data(){
            return {
                cartItemCnt:0,
                cartProducts: [],
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
                        this.updateCartNum(current.id, cnt)
                    }
                })
            },
            PlusNum(e){
                let c_id = $(e.currentTarget).data("c_id")
                this.cartProducts.forEach((current) => {
                    if(current.id == c_id) {
                        let cnt = current.cnt
                        current.cnt = ++cnt
                        this.updateCartNum(current.id, cnt)
                    }
                })
            },
            UpdateInputNum(e, c_id){
                //let c_id = $(e.currentTarget).data("c_id")
                this.cartProducts.forEach((current) => {
                    if(current.id == c_id) {                        
                        this.updateCartNum(current.id, current.cnt)
                    }
                })
            },
            handleCheck(c_id){
                this.cartProducts.forEach((current,idx) => {
                    if(current.id == c_id) current.pcheck = !current.pcheck
                })
            },deleteItem(id){
                //console.log(id)
                //console.log(this.cartProducts)
                if ( !confirm('確定要將商品移出購物車?') ) return false
                this.cartProducts.forEach((element, idx) => {
                    console.log(idx)
                    if( element.id == id ) {
                        element.isShow = !element.isShow
                        setTimeout(() => {
                            //console.log("@@@",this)
                            this.cartProducts.splice(idx, 1);
                        }, 500)    
                        
                        // axios 移除購物車內的商品
                        let url = 'http://127.0.0.1:8000/user/auth/cart-delete'
                         axios.post(url,{
                            headers:{
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            p_id:id,
                        }).then(
                            response => {
                                //console.log("success",this)
                                console.log(response)      
                                let template = `
                                <div id="liveToast" class="toast hide" role="alert" aria-live="assertive" aria-atomic="true">
                                    <div class="toast-header">
                                        <!-- <img src="..." class="rounded me-2" alt="..."> -->
                                        <strong class="me-auto">`+(response.data.status == '1' ? '<i class="bi bi-check-circle-fill"></i>' : '<i class="bi bi-x-circle-fill"></i>')+`</strong>
                                        <small>`+response.data.time+`</small>
                                        <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                                    </div>
                                    <div class="toast-body">
                                        `+response.data.p_name + ` : ` + (response.data.status == '1' ? '商品從購物車刪除' : ( response.data.errorMsg != '' ? response.data.errorMsg :'商品從購物車刪除失敗' ) ) +`
                                    </div>
                                </div>
                            `
                            $("#toastArea").html('');
                            $("#toastArea").append(template)

                            $('.toast').toast('show')

                            },
                            error => {
                                //console.log("erros",this)
                                console.log(error)
                            }
                        )

                    }                        
                })
            },
            getCart(){
                // 取得 cart 內容
                let url = 'http://127.0.0.1:8000/user/auth/get-carts'
                axios.get(url).then(
                    response => {
                        //console.log("success",this)
                        console.log(response)
                       
                        // 原本內容初始,每次新增到購物車後會更新
                        this.cartProducts = []
                        this.cartItemCnt = 0

                        // 添加傳回的資料
                        console.log(response.data.cart_data.length);
                        for ( let i = 0 ; i < response.data.cart_data.length ; i++ ) {
                            console.log(response.data.cart_data[i]);
                            response.data.cart_data[i]['photo'] = response.data.cart_img[response.data.cart_data[i]['id']]
                            if ( response.data.cart_data[i]['photo'] != '' ) response.data.cart_data[i]['photo'] = '/' + response.data.cart_data[i]['photo']
                            response.data.cart_data[i]['pcheck'] = true
                            response.data.cart_data[i]['isShow'] = true
                            this.cartProducts.push(response.data.cart_data[i])
                        }
                        // console.log(response.data.cart_cnt);
                        this.cartItemCnt = response.data.cart_cnt
                    },
                    error => {
                        //console.log("erros",this)
                        console.log(error)
                    }
                )
            },
            updateCartNum(p_id, p_num){
                let url = 'http://127.0.0.1:8000/user/auth/cart-edit-number'
                axios.post(url,{
                    headers:{
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    p_id:p_id,
                    p_num:p_num
                }).then(
                    response => {
                        //console.log("success",this)
                        //console.log(response) 
                        if ( response.data.status == 0 ) {
                            console.log('inside status')
                            let template = `
                                <div id="liveToast" class="toast hide" role="alert" aria-live="assertive" aria-atomic="true">
                                    <div class="toast-header">
                                        <!-- <img src="..." class="rounded me-2" alt="..."> -->
                                        <strong class="me-auto">`+(response.data.status == '1' ? '<i class="bi bi-check-circle-fill"></i>' : '<i class="bi bi-x-circle-fill"></i>')+`</strong>
                                        <small>`+response.data.time+`</small>
                                        <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                                    </div>
                                    <div class="toast-body">
                                        `+ response.data.errorMsg +`
                                    </div>
                                </div>
                            `
                            $("#toastArea").html('');
                            $("#toastArea").append(template)

                            $('.toast').toast('show')
                            this.cartProducts.forEach((element) => {
                                // console.log('update to 0', element.id, response.data.product_id)
                                if ( element.id == response.data.product_id ){
                                    // console.log('update to 0', element)
                                    element.cnt = 0
                                }
                            })
                        }
                    },
                    error => {
                        //console.log("erros",this)
                        console.log(error)
                    }
                )
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
            // console.log('cartlist is mounted')
            this.cartItemCnt = this.cartProducts.length
            window.$cartList = this
            this.getCart()
            // console.log(axios)
        },
        beforeDestroy() {
        }
    }
</script>

<style scoped>
    /* 进入的起点、离开的终点 */
	.hello-enter,.hello-leave-to{
		transform: translateX(-100%);
	}
	.hello-enter-active,.hello-leave-active{
		transition: 0.5s linear;
	}
	/* 进入的终点、离开的起点 */
	.hello-enter-to,.hello-leave{
		transform: translateX(0);
	}
</style>