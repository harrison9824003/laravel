@extends('admin.layout.master')

@section('content')
    <form action="{{ route('spec.store') }}" method="post" enctype="multipart/form-data">
        <div class="d-flex flex-column h-100 bg-white p-3 rounded">
            <div class="row g-3">
                <div class="col-6">
                    <label for="name" class="form-label">規格分類名稱(*)</label>
                    <input type="text" name="name" class="form-control" id="name" placeholder="" aria-describedby="defaultFormControlHelp" value="{{ old('name', '') }}">                    
                </div>       
                <div class="col-6">
                    <label for="exampleDataList" class="form-label">父階層</label>
                    <input
                        class="form-control"
                        list="datalistOptions"
                        id="exampleDataList"
                        placeholder="請輸入要搜尋的類別名稱..."
                        name="spec_category_name"
                        value="{{ old('spec_category_name', '') }}"
                    />
                    <datalist id="datalistOptions">
                        @foreach( $parent_category as $parent )
                        <option value="{{ $parent->name }}" data-id="{{ $parent->id }}"></option>
                        @endforeach
                    </datalist>
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