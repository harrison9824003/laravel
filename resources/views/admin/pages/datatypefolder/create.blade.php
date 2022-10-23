@extends('admin.layout.master')

@section('content')
    <form action="{{ route('datatypefolder.store') }}" method="post" enctype="multipart/form-data">
        <div class="d-flex flex-column h-100 bg-white p-3 rounded">
            <div class="row g-3">
                <div class="col-6">
                    <label for="name" class="form-label">分類名稱(*)</label>
                    <input type="text" name="name" class="form-control" id="name" placeholder="" aria-describedby="defaultFormControlHelp" value="{{ old('name', '') }}">                    
                </div> 
                <div class="col-6">
                    <div class="form-check">
                        <div>
                            <label for="name" class="form-label">Models</label>
                        </div>
                        @foreach($datatypes as $datatype)                             
                        <div class="form-check">
                            <input class="form-check-input" name="datatype[]" type="checkbox" id="inlineCheckbox{{ $datatype->id }}" value="{{ $datatype->id }}">
                            <label class="form-check-label" for="inlineCheckbox{{ $datatype->id }}">
                                {{ $datatype->name }}
                            </label>
                        </div>                  
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="mt-3 text-end">
                <input type="hidden" name="parent_id" value="0">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <button type="submit" class="btn btn-primary">新增</button>
            </div>
        </div>
    </form>
@endsection