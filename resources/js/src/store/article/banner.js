export default {
    namespaced:true,
    actions:{    
        getBanner(context, value) {
            console.log('banner actions start')

            let url = '/api/front/category/'+value
            axios.get(url).then(
                response => {
                    console.log(response.data)
                    let banner_data = response.data.data
                    context.commit('GETBANNER', {item: value, banner:banner_data} )
                },
                error => {
                    console.log('banner action error', error)
                }
            )
        }
    },
    mutations:{ 
        GETBANNER(state, data) {
            state.banners[data.item] = data.banner
        }
    },
    state:{       
        banners:{}
    },
    getters:{}
}