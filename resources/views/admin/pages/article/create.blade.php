@extends('admin.layout.master')

@section('content')
    <div class="d-flex flex-column h-100 bg-white p-3 rounded">
        <form action="{{ route('article.store') }}" method="post" enctype="multipart/form-data">
            <div class="row g-3">
                <div class="col-6">
                    <label for="title" class="form-label">文章標題</label>
                    <input type="text" class="form-control" name="title" value="{{ old('title', '') }}" id="title" placeholder="" aria-describedby="defaultFormControlHelp">
                    <!-- <div id="defaultFormControlHelp" class="form-text">
                        We'll never share your details with anyone else.
                    </div> -->
                </div>
                <div class="col-6">
                    <label for="sub_title" class="form-label">文章副標題</label>
                    <input type="text" class="form-control" name="sub_title" value="{{ old('sub_title', '') }}" id="sub_title" placeholder="" aria-describedby="defaultFormControlHelp">                
                </div>
                <div class="col-6">
                    <label for="strat_date" class="form-label">上架日期</label>
                    <input class="form-control" type="date" name="start_date" value="{{ old('start_date', date('Y-m-d')) }}" id="strat_date">
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
                            value=""
                        />
                        <datalist id="datalistOptions_parent">  
                            @foreach( $category_parent as $category )
                                <option value="{{ $category->name }}" data-id="{{ $category->id }}" />
                            @endforeach                          
                        </datalist>
                        <input type="hidden" name="category_parent" id="category_parent" value="">
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
                            value=""
                        />
                        <datalist id="datalistOptions_childen">                            
                        </datalist>
                        <input type="hidden" name="category_childen" id="category_childen" value="">
                    </div>                
                </div>
                <div class="text-success">
                    <hr>
                </div>

                <div class="col-12">
                    <label for="content" class="form-label">文章內容</label>
                    <textarea class="form-control ckeditor" name="content" id="content" rows="5">{{ old('content', '') }}</textarea>
                </div>

                <div class="col-6">
                    <label for="articleImg" class="form-label">文章圖片</label>
                    <input class="form-control" type="file" id="articleImg" multiple>
                </div>  
            </div>
            <div class="mt-auto text-end">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <button type="submit" class="btn btn-primary">新增</button>
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
    </script>
@endpush