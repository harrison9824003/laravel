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
                    <label for="sample_intro" class="form-label">商品簡介</label>
                    <textarea name="sample_intro" class="form-control" id="sample_intro" rows="3"></textarea>
                </div>                          
                <div class="mb-3 col-12">
                    <label for="intro" class="form-label">商品介紹(*)</label>
                    <textarea name="intro" class="form-control ckeditor" id="intro" rows="5"></textarea>
                </div>
                <div class="col-6">
                    <label for="productImg" class="form-label">商品圖片</label>
                    <input class="form-control" type="file" id="productImg" multiple>
                </div>  
                <!-- <div class="col-6">
                    <label for="formFile" class="form-label">已上傳圖片</label>
                    <input class="form-control" type="file" id="formFile" multiple>
                </div>   -->
            </div>
            <div class="mt-auto text-end">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <button type="submit" class="btn btn-primary">新增</button>
                <!-- <button type="button" class="btn btn-secondary">儲存草稿</button> -->
            </div>        
        </div>
    </form>
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
</script>
@endpush