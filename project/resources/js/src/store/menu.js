export default {
    namespaced:true,
    actions:{    
        getMenu(context, value) {
            console.log('menu actions start')

            let url = '/api/menu'
            axios.get(url).then(
                response => {
                    //console.log(response.data.data)
                    let menu = response.data.data
                    context.commit('GETMENU', menu)
                },
                error => {
                    console.log('menu action error', error)
                }
            )
        }    
    },
    mutations:{   
        GETMENU(state, data) {
            state.meun_data = data
        }     
    },
    state:{       
        meun_data: {}
    },
    getters:{   
    }
}