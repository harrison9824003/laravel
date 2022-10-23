@extends('admin.layout.master')

@section('content')
    <div class="d-flex flex-column h-100 bg-white p-3 rounded">
        <div class="d-flex mb-5">
            <a href="{{ route('spec.create') }}" class="btn btn-icon btn-primary d-flex">
                <span class="tf-icons bx bx-plus"></span>
            </a>
        </div>
        <div class="table-responsive text-nowrap h-100">
            <table class="table">
                
                <thead>
                    <tr>
                        <th>父階層</th>
                        <th>分類名稱</th>
                        <th class="text-end">操作</th>
                    </tr>
                </thead>   
                @if( $paginate->count() > 0 )
                <tbody class="table-border-bottom-0">
                    @foreach ( $paginate as $spec_category )
                    <tr>                        
                        <td width="40%">{{ $spec_category->parent_id != 0 ? $spec_category->parent->name : '' }}</td>                        
                        <td width="40%">{{ $spec_category->name }}</td>  
                        <td class="text-end">
                            <div class="dropdown">
                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                    <i class="bx bx-dots-vertical-rounded"></i>
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="{{ route('spec.edit', ['spec' => $spec_category->id]) }}"><i class="bx bx-edit-alt me-1"></i> 編輯</a>
                                    <a class="dropdown-item" href="javascript:void(0);" id="{{ $spec_category->id }}" onclick="deleteSpec(this.id)"><i class="bx bx-trash me-1"></i> 刪除</a>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                @else
                <tbody class="table-border-bottom-0">
                    <tr>
                        <td colspan="5" class="text-center">無資料</td>
                    </tr>
                </tbody>
                @endif
            </table>
        </div>
        <div class="d-flex justify-content-center mt-auto">
            {{ $paginate->links('vendor.pagination.bootstrap') }}                 
        </div>   
    </div>
@endsection

@push('scripts')
    <script>
        function deleteSpec(id) {
            if(confirm('確定要刪除嗎')) {
                $.ajax({
                    url:'/adm/spec/'+id,
                    type:"Post",
                    dataType: 'json',
                    headers:{
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        '_method':'delete'
                    },
                    success:function(data){
                        if(data.status == 1) {
                            alert(data.msg);
                            window.location.reload();
                        }
                    }
                });
            }
        }
    </script>
@endpush