@extends('admin.layout.master')

@section('content')
    <form action="{{ route('category.update', ['category'=> $category->id]) }}" method="post" enctype="multipart/form-data">
        <div class="d-flex flex-column h-100 bg-white p-3 rounded">
            <div class="row g-3">
                <div class="col-6">
                    <label for="name" class="form-label">規格分類名稱(*)</label>
                    <input type="text" name="name" class="form-control" id="name" placeholder="" aria-describedby="defaultFormControlHelp" value="{{ old('name', $category->name) }}">                    
                </div>       
                <div class="col-6">
                    <label for="exampleDataList" class="form-label">父階層</label>
                    <input
                        class="form-control"
                        list="datalistOptions"
                        id="exampleDataList"
                        placeholder="請輸入要搜尋的類別名稱..."
                        name="category_name"
                        value="{{ old('category_name', $parent_name) }}"
                    />
                    <datalist id="datalistOptions">
                        @foreach( $parent_category as $parent )
                            <option value="{{ $parent->name }}" data-id="{{ $parent->id }}"></option>
                        @endforeach
                    </datalist>
                </div>
                <div class="col-6">
                    <label for="order" class="form-label">排序</label>
                    <input type="text" name="order" class="form-control" id="order" placeholder="" aria-describedby="defaultFormControlHelp" value="{{ old('order', $category->order) }}">                    
                </div>
                <div class="col-6">     
                    <label class="form-label" for="defaultCheck1"> 顯示於前台選單內 </label>           
                    <div class="form-check mt-3">
                        <input class="form-check-input" 
                                name="display" 
                                type="checkbox" 
                                value="1" 
                                id="defaultCheck1" 
                                @if( $category->display ) checked @endif 
                        />                  
                    </div>
                </div>
            </div>
            <div class="mt-3 text-end">
                <input type="hidden" name="parent_id" value="{{ $category->parent_id }}">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                {{ method_field('PATCH') }}
                <button type="submit" class="btn btn-primary">修改</button>
            </div>        
        </div>
    </form>
@endsection

@push('scripts')
    <script>        
        $(document).ready(function(){
            $("#exampleDataList").on('change', function(){
                let val = $(this).val();
                let option_obj = $('option[value="'+val+'"]');
                if( option_obj !== undefined ) {
                    $("[name='parent_id']").val(option_obj.data('id'));
                }
            });
        });
    </script>
@endpush