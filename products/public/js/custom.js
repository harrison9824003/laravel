function addToLike(p_id){
    console.log('like',p_id);    
}   
function addToCart(event, p_id){
    event.preventDefault()
    //console.log('addCart',p_id);
    $.ajax({
        url: 'http://127.0.0.1:8000/user/auth/add-cart',
        method: 'post',
        dataType: 'json',
        headers:{
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
            p_id: p_id
        },
        success:function(data){
            //console.log(data)

            let template = `
                <div id="liveToast" class="toast hide" role="alert" aria-live="assertive" aria-atomic="true">
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
            $("#toastArea").html('');
            $("#toastArea").append(template)

            $('.toast').toast('show')
            window.$cartComponent.getCart()

        },
        error:function(a,b,c){
            console.log(a)
            console.log(b)
            console.log(c)
        }
    })
}