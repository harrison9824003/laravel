export default {
    namespaced:true,
    actions:{
        addToCart(context, value){
            // console.log(value)
            $.ajax({
                url: 'http://127.0.0.1:8000/user/auth/add-cart',
                method: 'post',
                dataType: 'json',
                headers:{
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    p_id: value
                },
                success:function(data){

                    let btn_id = 'liveToast_' + data.p_id
                    let template = `
                        <div id="`+btn_id+`" class="toast hide" role="alert" aria-live="assertive" aria-atomic="true">
                            <div class="toast-header">
                                <!-- <img src="..." class="rounded me-2" alt="..."> -->
                                <strong class="me-auto">`+(data.status == '1' ? '<i class="bi bi-check-circle-fill"></i>' : '<i class="bi bi-x-circle-fill"></i>')+`</strong>
                                <small>`+data.time+`</small>
                                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                            </div>
                            <div class="toast-body">
                                `+data.p_name + ` : ` + (data.status == '1' ? '商品成功加入購物車' : ( data.errorMsg != '' ? data.errorMsg :'商品加入購物車失敗' ) ) +`
                            </div>
                        </div>
                    `

                    $("#toastArea").append(template)
        
                    $('.toast').toast('show')

                    setTimeout(() => {
                        $("#"+btn_id).remove()
                    }, 2000)

                    if( data.statue == '1') {
                        let push_data = {
                            id: data.p_id,
                            name: data.p_name,
                            name_en: data.p_name_en,
                            price: data.price,
                            cnt: 1,
                            a_time: data.time
                        };

                        context.commit('PUSHCART', push_data)
                    }
        
                },
                error:function(a,b,c){
                    console.log(a)
                    console.log(b)
                    console.log(c)
                }
            })
        }
    },
    mutations:{
        PUSHCART(state, value){
            state.CartList.userCart.push(value)
        }
    },
    getters:{},
    state:{}
}