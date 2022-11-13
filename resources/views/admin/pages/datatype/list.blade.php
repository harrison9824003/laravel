@extends('admin.layout.master')

@section('content')
    <div class="d-flex flex-column h-100 bg-white p-3 rounded">        
        <div class="table-responsive text-nowrap h-100">
            <table class="table">
                
                <thead>
                    <tr>
                        <th>icon 圖標</th>
                        <th>名稱</th>
                        <th>Class 類別</th>
                        <th>是否隱藏</th>                        
                        <th class="text-end">操作</th>
                    </tr>
                </thead>   
                @if( $paginate->count() > 0 )
                <tbody class="table-border-bottom-0">
                    @foreach ( $paginate as $datatype )
                    <tr>                        
                        <td width="20%"><i class='bx {{ $datatype->icon }}'></i></td>  
                        <td width="20%">{{ $datatype->name }}</td>                        
                        <td width="20%">{{ $datatype->class_name }}</td>                        
                        <td width="20%">{{ $datatype->disabled ? '是' : '否' }}</td>                        
                        <td class="text-end">
                            <div class="dropdown">
                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                    <i class="bx bx-dots-vertical-rounded"></i>
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="{{ route('datatype.edit', ['datatype' => $datatype->id]) }}"><i class="bx bx-edit-alt me-1"></i> 編輯</a>
                                    <a class="dropdown-item" href="{{ route('permission.index', ['datatype' => $datatype->id]) }}"><i class="bx bx-edit-alt me-1"></i> 權限設定</a>
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