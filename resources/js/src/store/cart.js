import axios from "axios";

export default{
    namespaced: true,
    actions:{
        addCart(context, value){
            // console.log('addCart actions');
            // console.log(value);
            let url = '/cart/add';
            axios.post(url, {
                'product_id': value.product_id,
                'spec_id': value.spec_id,
                'number': value.number,
            }).then(
                response => {
                    if(response.status === 1)
                        context.commit('ADDCART', response.cart)
                    else 
                        console.log('add cart fail', response);
                },
                error => {
                    console.log('add cart error', error);
                }
            );
        }
    },
    mutations:{
        ADDCART(state, value){
            state.cart = value
        }
    },
    state:{
        cart: {}
    },
    getters:{

    }
}