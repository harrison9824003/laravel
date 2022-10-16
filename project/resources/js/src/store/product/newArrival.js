export default {
    namespaced:true,
    actions:{    
        getNewArrival(context, value) {
            console.log('arrival actions start')

            let url = '/api/front/category/'+value
            axios.get(url).then(
                response => {
                    console.log(response.data)
                    let products = response.data.data
                    context.commit('GETNEWARRIVAL', {item: value, products} )
                },
                error => {
                    console.log('banner action error', error)
                }
            )
        }
    },
    mutations:{ 
        GETNEWARRIVAL(state, data) {
            state.new_arrivals = data.products
        }
    },
    state:{       
        new_arrivals:{}
    },
    getters:{
        getSlice(state){
            let newArrival = [];
            let cnt = 0;
            for ( var x in state.new_arrivals) {
                newArrival.push(state.new_arrivals[x])
                cnt++;
                if ( cnt >= 10 ) break;
            }
            return newArrival
        }
    }
}