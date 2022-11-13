@extends('admin.layout.master')

@section('content')
    <form action="{{ route('permission.store') }}" method="post" enctype="multipart/form-data">
        <div class="d-flex flex-column h-100 bg-white p-3 rounded">
            <div class="row g-3">
                <div class="col-6">
                    <label for="function" class="form-label">function</label>
                    <input type="text" name="function" class="form-control" id="function" placeholder="" value="{{ old('function', '') }}">
                </div>
                <div class="col-6">
                    <label for="name" class="form-label">名稱</label>
                    <input type="text" name="name" class="form-control" id="name" placeholder="" aria-describedby="defaultFormControlHelp" value="{{ old('name', '') }}">
                </div>
                <div class="col-6">
                    <label for="description" class="form-label">備註說明</label>
                    <textarea class="form-control" name="description" id="description" rows="10"></textarea>
                </div>
            </div>
            <div class="mt-3 text-end">
                <input type="hidden" name="model_id" value="{{ $model_id }}">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <button type="submit" class="btn btn-primary">新增</button>
            </div>
        </div>
    </form>
@endsection