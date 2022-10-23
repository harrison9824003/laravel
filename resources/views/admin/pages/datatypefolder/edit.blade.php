@extends('admin.layout.master')

@section('content')
    <form action="{{ route('datatypefolder.update', ['datatypefolder'=> $datatypefolder->id]) }}" method="post" enctype="multipart/form-data">
        <div class="d-flex flex-column h-100 bg-white p-3 rounded">
            <div class="row g-3">
                <div class="col-6">
                    <label for="name" class="form-label">分類名稱(*)</label>
                    <input type="text" name="name" class="form-control" id="name" placeholder="" aria-describedby="defaultFormControlHelp" value="{{ old('name', $datatypefolder->name) }}">                    
                </div> 
                <div class="col-6">
                    <div class="form-check">
                        <div>
                            <label for="name" class="form-label">Models</label>
                        </div>
                        @foreach($datatypes as $datatype)                             
                        <div class="form-check">
                            <input class="form-check-input" 
                                    name="datatype[]" 
                                    type="checkbox" 
                                    id="inlineCheckbox{{ $datatype->id }}" 
                                    value="{{ $datatype->id }}" 
                                    @if(in_array($datatype->id, $datatypes_exists)) checked @endif
                            >
                            <label class="form-check-label" for="inlineCheckbox{{ $datatype->id }}">
                                {{ $datatype->name }}
                            </label>
                        </div>                  
                        @endforeach
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