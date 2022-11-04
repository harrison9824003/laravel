@extends('admin.layout.master')

@section('content')
    <form action="{{ route('datatype.update', ['datatype'=> $datatype->id]) }}" method="post" enctype="multipart/form-data">
        <div class="d-flex flex-column h-100 bg-white p-3 rounded">
            <div class="row g-3">
                <div class="col-6">
                    <label for="name" class="form-label">Model 名稱(別名)</label>
                    <input type="text" name="name" class="form-control" id="name" placeholder="" aria-describedby="defaultFormControlHelp" value="{{ old('spec_category_name', $datatype->name) }}">                    
                </div>
                <div class="col-6">
                    <label for="class_name" class="form-label">Class 名稱</label>
                    <input type="text" name="class_name" class="form-control" id="class_name" placeholder="" aria-describedby="defaultFormControlHelp" value="{{ $datatype->class_name }}" readonly>                    
                </div>
                <div class="col-6">
                    <label for="icon" class="form-label">icon [ <a href="https://boxicons.com/" target="_black">官網</a> ]</label>
                    <input type="text" name="icon" class="form-control" id="icon" placeholder="" aria-describedby="defaultFormControlHelp" value="{{ $datatype->icon }}">                    
                </div>
                <div class="col-6">
                    <label for="router_path" class="form-label">路由路徑(判斷是否為當下選單)</label>
                    <input type="text" name="router_path" class="form-control" id="router_path" placeholder="" aria-describedby="defaultFormControlHelp" value="{{ $datatype->router_path }}">                    
                </div>
                <div class="col-6">
                    <label class="form-check-label" for="flexSwitchCheckDefault">是否隱藏</label>
                    <div class="form-check form-switch d-flex align-items-center h-100">
                        <input class="form-check-input" 
                                name="disabled" type="checkbox" 
                                role="switch" 
                                id="flexSwitchCheckDefault" 
                                value="1" 
                                @if($datatype->disabled) checked @endif
                        >                        
                    </div>                    
                </div>
            </div>
            <div class="mt-3 text-end">                
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                {{ method_field('PATCH') }}
                <button type="submit" class="btn btn-primary">修改</button>
            </div>        
        </div>
    </form>
@endsection