@extends('admin.layout.master')

@section('content')
    <div class="d-flex flex-column h-100 bg-white p-3 rounded">
        <div class="row g-3">
            <div class="col-6">
                <label for="defaultFormControlInput" class="form-label">文章標題</label>
                <input type="text" class="form-control" id="defaultFormControlInput" placeholder="" aria-describedby="defaultFormControlHelp">
                <!-- <div id="defaultFormControlHelp" class="form-text">
                    We'll never share your details with anyone else.
                </div> -->
            </div>
            <div class="col-6">
                <label for="defaultFormControlInput" class="form-label">文章副標題</label>
                <input type="text" class="form-control" id="defaultFormControlInput" placeholder="" aria-describedby="defaultFormControlHelp">                
            </div>
            <div class="col-6">
                <label for="html5-date-input" class="form-label">上架日期</label>
                <input class="form-control" type="date" value="2021-06-18" id="html5-date-input">
            </div>
            <div class="col-6">
                <label for="formFile" class="form-label">商品主圖</label>
                <input class="form-control" type="file" id="formFile">
            </div>
            <div>
                <label for="exampleFormControlTextarea1" class="form-label">商品介紹</label>
                <textarea class="form-control" id="exampleFormControlTextarea1" rows="5"></textarea>
            </div>
        </div>
        <div class="mt-auto text-end">
            <button type="submit" class="btn btn-primary">新增</button>
            <button type="submit" class="btn btn-secondary">儲存草稿</button>
        </div>        
    </div>
@endsection