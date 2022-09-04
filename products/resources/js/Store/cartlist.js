/**
 * vuex models CartList
 * axios 取得使用者的購物車內容存回到 vuex 共用
 */
export default {
    namespaced:true,
    actions:{
        // context 為vc, value 為傳入(修改)的值
        getCart(context, value) {
    
            console.log('actions getCart')
            // axios 更新購物車資料
            // 取回最新內容更新到 state 內 
            // 取得 cart 內容
            let url = 'http://127.0.0.1:8000/user/auth/get-carts'
            axios.get(url).then(
                response => {
                   
                   // 原本內容初始,每次新增到購物車後會更新
                    //this.cartProducts = []
                    //this.cartItemCnt = 0
                    let data = [];
                    let cnt = 0;
    
                    // 添加傳回的資料
                    for ( let i = 0 ; i < response.data.cart_data.length ; i++ ) {
                        //console.log(response.data.cart_data[i]);
                        response.data.cart_data[i]['photo'] = response.data.cart_img[response.data.cart_data[i]['id']]
                        if ( response.data.cart_data[i]['photo'] != '' ) response.data.cart_data[i]['photo'] = '/' + response.data.cart_data[i]['photo']
                        response.data.cart_data[i]['pcheck'] = true
                        data.push(response.data.cart_data[i])
                    }
    
                    cnt = response.data.cart_cnt
                    
                    // 提交給 mutations 更新 state                    
                    context.commit('GETCART', data)

                },
                error => {
                    //console.log("erros",this)
                    console.log('actions getCart', error)
                    //return {data:[], cnt:0, error:1}
                }
            )
    
        },
        delete(context, value) {
            
            context.commit('DELETE', value)

        }
    },
    mutations:{
        /**
         * 取的購物車內容後,放到 state.userCart 
         * @param {store} state 
         * @param {axios 回傳後整理的購物車內容} value 
         */
        GETCART(state, data){
           
            // 更新 userCart
            console.log(data)
            state.userCart = data
            state.userCartCnt = data.length
    
        },
        DELETE(state, value){
            state.userCart.splice(value, 1);
            state.userCartCnt = state.userCart.length
        }
    },
    state:{
        userCart:[], // 使用者的購物車
        userCartCnt:0
    },
    getters:{
        getLocationCartData(state){
            console.log('out',state.userCartCnt)        
            //return JSON.parse(window.sessionStorage.getItem('cartData'))
            return state.userCart
        },
        getSliceCartData(state){
            return state.userCart.slice(0,5)
        }
    }
}