@extends('admin.layout.master')

@section('content')
    <div class="d-flex flex-column h-100 bg-white p-3 rounded">
        <form action="{{ route('article.update', ['article' => $article->id]) }}" method="post" enctype="multipart/form-data">
            {{ method_field('PATCH') }}
            <div class="row g-3 mb-3">
                <div class="col-6">
                    <label for="title" class="form-label">文章標題</label>
                    <input type="text" class="form-control" name="title" value="{{ old('title', $article->title) }}" id="title" placeholder="" aria-describedby="defaultFormControlHelp">
                    <!-- <div id="defaultFormControlHelp" class="form-text">
                        We'll never share your details with anyone else.
                    </div> -->
                </div>
                <div class="col-6">
                    <label for="sub_title" class="form-label">文章副標題</label>
                    <input type="text" class="form-control" name="sub_title" value="{{ old('sub_title', $article->sub_title) }}" id="sub_title" placeholder="" aria-describedby="defaultFormControlHelp">                
                </div>
                <div class="col-6">
                    <label for="strat_date" class="form-label">上架日期</label>
                    <input class="form-control" type="date" name="start_date" value="{{ old('start_date', date('Y-m-d', strtotime($article->start_date)) ) }}" id="strat_date">
                </div> 
                
                <div class="text-success">
                    <hr>
                </div>  
                
                <h3>全站分類</h3>
                <div class="mb-3 col-6">
                    <label for="category_name_parent" class="form-label">分類</label>    
                    <div id="category">
                        <!-- 全站分類 -->
                        <input
                            class="form-control"
                            list="datalistOptions_parent"
                            id="category_name_parent"
                            placeholder="請輸入要搜尋的分類名稱..."
                            name="category_name_parent"
                            value="{{ old('category_name_parent', $article->category->parent->name) }}"
                        />
                        <datalist id="datalistOptions_parent">  
                            @foreach( $category_parent as $category )
                                <option value="{{ $category->name }}" data-id="{{ $category->id }}" />
                            @endforeach                          
                        </datalist>
                        <input type="hidden" name="category_parent" id="category_parent" value="{{ old('category_parent', $article->category->parent->id) }}">
                    </div>                
                </div>
                <div class="mb-3 col-6">
                    <label for="category_name_childen" class="form-label">分類子階層</label>    
                    <div id="category">
                        <!-- 全站分類 -->
                        <input
                            class="form-control"
                            list="datalistOptions_childen"
                            id="category_name_childen"
                            placeholder="請輸入要搜尋的分類名稱..."
                            name="category_name_childen"
                            value="{{ old('category_name_childen', $article->category->name) }}"
                        />
                        <datalist id="datalistOptions_childen">                            
                        </datalist>
                        <input type="hidden" name="category_childen" id="category_childen" value="{{ old('category_childen', $article->category->id) }}">
                        <input type="hidden" name="category_id" value="{{ $r_category->id }}">
                    </div>                
                </div>
                <div class="text-success">
                    <hr>
                </div>

                <div class="col-12">
                    <label for="content" class="form-label">文章內容</label>
                    <textarea class="form-control ckeditor" name="content" id="content" rows="5">{{ old('content', $article->content) }}</textarea>
                </div>

                <div class="col-6">
                    <label for="articleImg" class="form-label">文章圖片</label>
                    <input class="form-control" type="file" id="articleImg" multiple>
                </div>  
                <div class="col-6">
                    <div class="row">                        
                        @foreach( $a_images as $a_image )       
                            <div class="col-6 position-relative mt-5 img_block">
                                <img class="img-fluid" src="{{ url($a_image->path) }}" style="background-position: center center; background-size: cover;" alt="">
                                <button type="button" 
                                        class="btn btn-icon btn-danger position-absolute top-0 start-75 translate-middle img_delete_btn" 
                                        data-id="{{ $a_image->id }}">
                                    <i class='bx bxs-message-alt-x'></i>
                                </button>
                            </div> 
                        @endforeach
                    </div>                    
                </div>
            </div>
            <div class="mt-auto text-end">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <button type="submit" class="btn btn-primary">修改</button>
                <!-- <button type="submit" class="btn btn-secondary">儲存草稿</button> -->
            </div>    
        </form>    
    </div>
@endsection

@push('scripts')
    <script src="{{ mix('/admin/assets/js/filepond.js') }}"></script>
    <script src="//cdn.ckeditor.com/4.19.1/standard/ckeditor.js"></script>
    <script>
        // // Get a reference to the file input element
        const inputElement = document.querySelector('#articleImg');
        // Create a FilePond instance
        FilePond.setOptions({
            name: 'articleImg[]',
            storeAsFile: true,
            allowMultiple: true,
            maxFiles: 5,
            acceptedFileTypes: ['image/png', 'image/jpg', 'image/jpeg'],
        });
        const pond = FilePond.create(inputElement);  

        // 父階層更動 ajax 取子階層內容
        $("#category_name_parent").on('change', function(){
            let val = $(this).val();
            let option_obj = $('option[value="'+val+'"]');
            if( option_obj !== undefined ) {
                $("[name='category_parent']").val(option_obj.data('id'));
            }
            $('#datalistOptions_childen').empty();
            $('#category_name_childen').hide();
            $.ajax({
                url: '/adm/get_childen_category/'+option_obj.data('id'),
                method: 'post',
                dataType: 'json',
                headers:{
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {},
                success:function(res) {
                    console.log(res);
                    
                    if ( res.data.length != undefined && res.data.length > 0 ) {
                        let template = '';
                        for ( var i in res.data ) {
                            template += `<option value='`+res.data[i].name+`' data-id="`+res.data[i].id+`"></option>`;
                        }
                        $('#datalistOptions_childen').append(template);
                        $('#category_name_childen').val('');
                        $('#category_name_childen').show();
                    } else {
                        alert('此類別無子分類, 請到全站分類設定, 或選擇其他分類!');
                    }
                    
                },
                error:function(a,b,c) {
                    console.log(a);
                    console.log(b);
                    console.log(c);
                }
            });
        });

        // 子分類選擇
        $("#category_name_childen").on('change', function(){
            let val = $(this).val();
            let option_obj = $('option[value="'+val+'"]');
            if( option_obj !== undefined ) {
                $("[name='category_childen']").val(option_obj.data('id'));
            }
        });

        // 圖片刪除按鈕
        $('.img_delete_btn').on('click', deleteImg);
        function deleteImg(){
            let obj = this
            let id = $(obj).data('id')
            
            if ( id !== undefined ) {
                $.ajax({
                    url: '/adm/delete/img/'+id,
                    method: 'post',
                    dataType: 'json',
                    headers:{
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {},
                    success:function(res) {                        
                        
                        if(res.status == 1) {
                            $(obj).closest(".img_block").remove()
                            alert(res.msg);
                            //window.location.reload();
                        }
                        
                    },
                    error:function(a,b,c) {
                        console.log(a);
                        console.log(b);
                        console.log(c);
                    }
                });
            }
        }
    </script>
@endpush