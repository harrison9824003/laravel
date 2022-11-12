@extends('admin.layout.master')

@section('content')
    <form action="{{ route('product.store') }}" method="post" enctype="multipart/form-data">
        <div class="d-flex flex-column h-100 bg-white p-3 rounded">
            <div class="row g-3">
                <div class="col-6">
                    <label for="name" class="form-label">商品名稱(*)</label>
                    <input type="text" name="name" class="form-control" id="name" placeholder="" aria-describedby="defaultFormControlHelp">
                    <!-- <div id="defaultFormControlHelp" class="form-text">
                        We'll never share your details with anyone else.
                    </div> -->
                </div>
                <div class="col-6">
                    <label for="html5-date-input" class="form-label">上架日期(*)</label>
                    <input class="form-control" name='start_date' type="date" value="<?= date("Y-m-d"); ?>" id="html5-date-input">
                </div>
                <div class="col-6">
                    <label for="price" class="form-label">商品售價(*)</label>
                    <input type="text" name="price" class="form-control" id="price" placeholder="" aria-describedby="defaultFormControlHelp">                
                </div>
                <div class="col-6">
                    <label for="market_price" class="form-label">建議售價</label>
                    <input type="text" name="market_price" class="form-control" id="market_price" placeholder="" aria-describedby="defaultFormControlHelp">                
                </div>            
                <div class="col-6">
                    <label for="part_number" class="form-label">店家料號</label>
                    <input type="text" name="part_number" class="form-control" id="part_number" placeholder="" aria-describedby="defaultFormControlHelp">                
                </div>
                <div class="col-6">
                    <label for="simple_intro" class="form-label">商品簡介</label>
                    <textarea name="simple_intro" class="form-control" id="simple_intro" rows="3"></textarea>
                </div>              
                <div class="text-success">
                    <hr>
                </div>   

                <div class="mb-3 col-12">
                    <label for="intro" class="form-label">商品介紹(*)</label>
                    <textarea name="intro" class="form-control ckeditor" id="intro" rows="5"></textarea>
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
                            value="{{ old('category_name_parent', '') }}"
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
                            value="{{ old('category_name_childen', '') }}"
                        />
                        <datalist id="datalistOptions_childen">                            
                        </datalist>
                        <input type="hidden" name="category_childen" id="category_childen" value="">
                    </div>                
                </div>
                <div class="text-success">
                    <hr>
                </div>

                <div class="spec_wapper">
                    <h3>規格</h3>                    
                    <div class="spec_sub_item row" data-order="1"> 
                        <div class="col-12">
                            <div class="row">                                
                                <div class="mb-3 col-2">
                                    <label for="spec_name_parent[1]" class="form-label">規格分類</label>    
                                    <div id="category">
                                        <!-- 全站分類 -->
                                        <input
                                            class="form-control"
                                            list="spec_parent_list[1]"
                                            id="spec_parent_name[1]"
                                            placeholder=""
                                            name="spec_parent_name[1]"
                                            value="{{ old('spec_parent_name[1]', '') }}"
                                        />
                                        <datalist id="spec_parent_list[1]">  
                                            @foreach( $spec_parent as $spec )
                                                <option value="{{ $spec->name }}" data-id="{{ $spec->id }}" />
                                            @endforeach
                                        </datalist>
                                        <input type="hidden" name="spec_parent[1]" id="spec_parent[1]" value="{{ old('spec_parent[1]', '') }}">
                                    </div>                
                                </div>
                                <div class="mb-3 col-2">
                                    <label for="spec_name_childen[1]" class="form-label">全站分類子階層</label>    
                                    <div id="category">
                                        <!-- 全站分類 -->
                                        <input
                                            class="form-control"
                                            list="spec_childen_list[1]"
                                            id="spec_name_childen[1]"
                                            placeholder=""
                                            name="spec_name_childen[1]"
                                            value="{{ old('spec_name_childen[1]', '') }}"
                                        />
                                        <datalist id="spec_childen_list[1]">                            
                                        </datalist>
                                        <input type="hidden" name="spec_childen[1]" id="spec_childen[1]" value="{{ old('spec_childen[1]', '') }}">
                                    </div>                
                                </div> 
                            </div>                              
                        </div>          
                        <div class="mb-3 col-2">
                            <label for="spec_reserve[1]" class="form-label">庫存</label> 
                            <input type="number" name="spec_reserve[1]" class="form-control" id="spec_reserve[1]" placeholder="" aria-describedby="defaultFormControlHelp">
                        </div>
                        <div class="mb-3 col-2">
                            <label for="spec_low_reserve[1]" class="form-label">最低庫存</label> 
                            <input type="number" name="spec_low_reserve[1]" class="form-control" id="spec_low_reserve[1]" placeholder="" aria-describedby="defaultFormControlHelp">
                        </div>
                        <div class="mb-3 col-2">
                            <label for="spec_volume[1]" class="form-label">材積</label> 
                            <input type="number" name="spec_volume[1]" class="form-control" id="spec_volume[1]" placeholder="" aria-describedby="defaultFormControlHelp">
                        </div>
                        <div class="mb-3 col-2">
                            <label for="spec_weight[1]" class="form-label">重量</label> 
                            <input type="number" name="spec_weight[1]" class="form-control" id="spec_weight[1]" placeholder="" aria-describedby="defaultFormControlHelp">
                        </div>
                        <div class="mb-3 col-2">
                            <label for="spec_order[1]" class="form-label">排序</label> 
                            <input type="number" name="spec_order[1]" class="form-control" id="spec_order[1]" placeholder="" aria-describedby="defaultFormControlHelp">
                        </div>
                        <div class="mb-3 col-2 d-flex align-items-end">
                            <button type="button" class="btn btn-danger btn-icon spec_delete_btn" id="spec_delete_btn[1]" data-order="1">
                                <i class='bx bx-message-square-x'></i>
                            </button>
                        </div>
                        <div class="text-success">
                            <hr>
                        </div>
                    </div>                                        
                </div>
                <div class="row">
                    <div class="col-12">
                        <button type="button" id="add_spec_btn" class="btn btn-primary btn-icon mb-0">
                            <i class='bx bx-plus'></i>
                        </button>
                    </div>
                </div>
                
                <div class="text-success">
                    <hr>
                </div>

                <div class="col-6">
                    <label for="productImg" class="form-label">商品圖片</label>
                    <input class="form-control" type="file" id="productImg" multiple>
                </div>  
                <!-- <div class="col-6">
                    <label for="formFile" class="form-label">已上傳圖片</label>
                </div>   -->
            </div>

            <div class="mt-auto text-end">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <button type="submit" class="btn btn-primary">新增</button>
                <!-- <button type="button" class="btn btn-secondary">儲存草稿</button> -->
            </div>        
        </div>
    </form>

    <!-- template -->
    <template id="spec_template">
        <div class="spec_sub_item row" data-order="@{{order}}"> 
            <div class="col-12">
                <div class="row">                                
                    <div class="mb-3 col-2">
                        <label for="spec_name_parent[@{{order}}]" class="form-label">規格分類</label>    
                        <div>
                            <!-- 全站分類 -->
                            <input
                                class="form-control"
                                list="spec_parent_list[@{{order}}]"
                                id="spec_parent_name[@{{order}}]"
                                placeholder=""
                                name="spec_parent_name[@{{order}}]"
                                value=""
                            />
                            <datalist id="spec_parent_list[@{{order}}]">  
                                @foreach( $spec_parent as $spec )
                                    <option value="{{ $spec->name }}" data-id="{{ $spec->id }}" />
                                @endforeach
                            </datalist>
                            <input type="hidden" name="spec_parent[@{{order}}]" id="spec_parent[@{{order}}]" value="">
                        </div>                
                    </div>
                    <div class="mb-3 col-2">
                        <label for="spec_name_childen[@{{order}}]" class="form-label">規格子階層</label>
                        <div>
                            <!-- 全站分類 -->
                            <input
                                class="form-control"
                                list="spec_childen_list[@{{order}}]"
                                id="spec_name_childen[@{{order}}]"
                                placeholder=""
                                name="spec_name_childen[@{{order}}]"
                                value=""
                            />
                            <datalist id="spec_childen_list[@{{order}}]">                            
                            </datalist>
                            <input type="hidden" name="spec_childen[@{{order}}]" id="spec_childen[@{{order}}]" value="">
                        </div>                
                    </div> 
                </div>                              
            </div>          
            <div class="mb-3 col-2">
                <label for="spec_reserve[@{{order}}]" class="form-label">庫存</label> 
                <input type="number" name="spec_reserve[@{{order}}]" class="form-control" id="spec_reserve[@{{order}}]" placeholder="" aria-describedby="defaultFormControlHelp">
            </div>
            <div class="mb-3 col-2">
                <label for="spec_low_reserve[@{{order}}]" class="form-label">最低庫存</label> 
                <input type="number" name="spec_low_reserve[@{{order}}]" class="form-control" id="spec_low_reserve[@{{order}}]" placeholder="" aria-describedby="defaultFormControlHelp">
            </div>
            <div class="mb-3 col-2">
                <label for="spec_volume[@{{order}}]" class="form-label">材積</label> 
                <input type="number" name="spec_volume[@{{order}}]" class="form-control" id="spec_volume[@{{order}}]" placeholder="" aria-describedby="defaultFormControlHelp">
            </div>
            <div class="mb-3 col-2">
                <label for="spec_weight[@{{order}}]" class="form-label">重量</label> 
                <input type="number" name="spec_weight[@{{order}}]" class="form-control" id="spec_weight[@{{order}}]" placeholder="" aria-describedby="defaultFormControlHelp">
            </div>
            <div class="mb-3 col-2">
                <label for="spec_order[@{{order}}]" class="form-label">排序</label> 
                <input type="number" name="spec_order[@{{order}}]" class="form-control" id="spec_order[@{{order}}]" placeholder="" aria-describedby="defaultFormControlHelp">
            </div>
            <div class="mb-3 col-2 d-flex align-items-end">
                <button type="button" class="btn btn-danger btn-icon spec_delete_btn" id="spec_delete_btn[@{{order}}]" data-order="@{{order}}">
                    <i class='bx bx-message-square-x'></i>
                </button>
            </div>
            <div class="text-success">
                <hr>
            </div>
        </div>  
    </template>
@endsection

@push('scripts')
<script src="{{ mix('/admin/assets/js/filepond.js') }}"></script>
<script src="//cdn.ckeditor.com/4.19.1/standard/ckeditor.js"></script>
<script>
    // // Get a reference to the file input element
    const inputElement = document.querySelector('#productImg');
    // Create a FilePond instance
    FilePond.setOptions({
        name: 'productImg[]',
        storeAsFile: true,
        allowMultiple: true,
        maxFiles: 5,
        acceptedFileTypes: ['image/png', 'image/jpg', 'image/jpeg'],
    });
    const pond = FilePond.create(inputElement);  
    
    $(function(){
        
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
                url: '/adm/getChildenCategory/'+option_obj.data('id'),
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

        // 規格新增按鈕        
        $("#add_spec_btn").on('click', function(){
            let order = parseInt($(".spec_sub_item").last().data('order'));
            let ele = $("#spec_template").clone().html();
            let newEle = ele.replaceAll('@{{order}}', ++order);            
            $(".spec_wapper").append(newEle);
            $("[name='spec_parent_name["+order+"]']").on('change', get_childen_spec);
            $("[id='spec_delete_btn["+order+"]']").on('click', spec_delete_btn);
        });

        // 規格改變撈子規格資料
        $("[name^='spec_parent_name[']").on('change', get_childen_spec);

        function get_childen_spec(){
            let val = $(this).val();
            let wapper = $(this).parents(".spec_sub_item");
            let parent_row_order = wapper.data('order');
            let name_object = $("[name='spec_parent_name["+parent_row_order+"]']");
            let option_obj = wapper.find('option[value="'+name_object.val()+'"]');
            // option_obj = $(option_obj);
            // console.log(option_obj);

            if( option_obj.length > 0 ) {                
                $("[name='spec_parent["+parent_row_order+"]']").val(option_obj.data('id'));
            } else {
                $("[name='spec_parent["+parent_row_order+"]']").val('');
                $('[id="spec_childen_list['+parent_row_order+']"]').empty();
                $('[id="spec_name_childen['+parent_row_order+']"]').hide();
                return;
            }
            
            $('[id="spec_childen_list['+parent_row_order+']"]').empty();
            $('[id="spec_name_childen['+parent_row_order+']"]').hide();
            $.ajax({
                url: '/adm/get_childen_spec/'+option_obj.data('id'),
                method: 'post',
                dataType: 'json',
                headers:{
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {},
                success:function(res) {
                    
                    if ( res.data.length != undefined && res.data.length > 0 ) {
                        let template = '';
                        for ( var i in res.data ) {
                            template += `<option value='`+res.data[i].name+`' data-id="`+res.data[i].id+`"></option>`;
                        }
                        $('[id="spec_childen_list['+parent_row_order+']"]').append(template);
                        $('[id="spec_name_childen['+parent_row_order+']"]').show();
                        
                        $('[id="spec_name_childen['+parent_row_order+']"]').on('change', spec_change);
                    } else {
                        alert('此類別無子規格, 請到規格分類內設定, 或選擇其他規格!');
                    }
                    
                },
                error:function(a,b,c) {
                    console.log(a);
                    console.log(b);
                    console.log(c);
                }
            });
        }

        // 子規格選擇
        $("[name^='spec_name_childen[']").on('change', spec_change);

        function spec_change() {
            let val = $(this).val();
            let wapper = $(this).parents(".spec_sub_item");
            let parent_row_order = wapper.data('order');
            let name_object = $("[name='spec_name_childen["+parent_row_order+"]']");
            let option_obj = wapper.find('option[value="'+name_object.val()+'"]');          
            if( option_obj !== undefined ) {
                $("[name='spec_childen["+parent_row_order+"]']").val(option_obj.data('id'));
            }
        }

        // 規格刪除按鈕
        $(".spec_delete_btn").on('click', spec_delete_btn);

        function spec_delete_btn() {
            let order = $(this).data('order')
            //console.log(order);
            //console.log($('.spec_sub_item[data-order="'+order+'"]'));
            if( $('.spec_sub_item').length > 1 )
                $('.spec_sub_item[data-order="'+order+'"]').remove();
            //$('[data-id="'+order+'"]').remove()            
        }

    });
    
</script>
@endpush