@extends('admin.layout.master')

@section('content')
    <div class="d-flex flex-column h-100 bg-white p-3 rounded">
        <div class="d-flex mb-5">
            <a href="{{ route('product.create') }}" class="btn btn-icon btn-primary d-flex">
                <span class="tf-icons bx bx-plus"></span>
            </a>
        </div>
        <div class="table-responsive text-nowrap">
            <table class="table">
            <thead>
                <tr>
                    <th>商品名稱</th>
                    <th>分類</th>
                    <th>庫存數</th>
                    <th>狀態</th>
                    <th>操作</th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">
                <tr>
                <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>Angular Project</strong></td>
                <td>Albert Cook</td>
                <td>
                    3
                </td>
                <td><span class="badge bg-label-primary me-1">上架中</span></td>
                <td>
                    <div class="dropdown">
                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                            <i class="bx bx-dots-vertical-rounded"></i>
                        </button>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="javascript:void(0);"
                            ><i class="bx bx-edit-alt me-1"></i> 編輯</a
                            >
                            <a class="dropdown-item" href="javascript:void(0);"
                            ><i class="bx bx-trash me-1"></i> 刪除</a
                            >
                        </div>
                    </div>
                </td>
                </tr>
                <tr>
                <td><i class="fab fa-react fa-lg text-info me-3"></i> <strong>React Project</strong></td>
                <td>Barry Hunter</td>
                <td>
                    4
                </td>
                <td><span class="badge bg-label-primary me-1">上架中</span></td>
                <td>
                    <div class="dropdown">
                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                        <i class="bx bx-dots-vertical-rounded"></i>
                    </button>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="javascript:void(0);"
                        ><i class="bx bx-edit-alt me-2"></i> 編輯</a
                        >
                        <a class="dropdown-item" href="javascript:void(0);"
                        ><i class="bx bx-trash me-2"></i> 刪除</a
                        >
                    </div>
                    </div>
                </td>
                </tr>
                <tr>
                <td><i class="fab fa-vuejs fa-lg text-success me-3"></i> <strong>VueJs Project</strong></td>
                <td>Trevor Baker</td>
                <td>
                    10
                </td>
                <td><span class="badge bg-label-info me-1">預上架</span></td>
                <td>
                    <div class="dropdown">
                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                        <i class="bx bx-dots-vertical-rounded"></i>
                    </button>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="javascript:void(0);"
                        ><i class="bx bx-edit-alt me-2"></i> 編輯</a
                        >
                        <a class="dropdown-item" href="javascript:void(0);"
                        ><i class="bx bx-trash me-2"></i> 刪除</a
                        >
                    </div>
                    </div>
                </td>
                </tr>
                <tr>
                <td>
                    <i class="fab fa-bootstrap fa-lg text-primary me-3"></i> <strong>Bootstrap Project</strong>
                </td>
                <td>Jerry Milton</td>
                <td>
                    11
                </td>
                <td><span class="badge bg-label-danger me-1">下架商品</span></td>
                <td>
                    <div class="dropdown">
                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                        <i class="bx bx-dots-vertical-rounded"></i>
                    </button>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="javascript:void(0);"
                        ><i class="bx bx-edit-alt me-2"></i> 編輯</a
                        >
                        <a class="dropdown-item" href="javascript:void(0);"
                        ><i class="bx bx-trash me-2"></i> 刪除</a
                        >
                    </div>
                    </div>
                </td>
                </tr>
            </tbody>
            </table>
        </div>
        <div class="d-flex justify-content-center mt-auto">
            <!-- Basic Pagination -->
            <nav aria-label="Page navigation">
                <ul class="pagination">
                <li class="page-item first">
                    <a class="page-link" href="javascript:void(0);"
                    ><i class="tf-icon bx bx-chevrons-left"></i
                    ></a>
                </li>
                <li class="page-item prev">
                    <a class="page-link" href="javascript:void(0);"
                    ><i class="tf-icon bx bx-chevron-left"></i
                    ></a>
                </li>
                <li class="page-item">
                    <a class="page-link" href="javascript:void(0);">1</a>
                </li>
                <li class="page-item">
                    <a class="page-link" href="javascript:void(0);">2</a>
                </li>
                <li class="page-item active">
                    <a class="page-link" href="javascript:void(0);">3</a>
                </li>
                <li class="page-item">
                    <a class="page-link" href="javascript:void(0);">4</a>
                </li>
                <li class="page-item">
                    <a class="page-link" href="javascript:void(0);">5</a>
                </li>
                <li class="page-item next">
                    <a class="page-link" href="javascript:void(0);"
                    ><i class="tf-icon bx bx-chevron-right"></i
                    ></a>
                </li>
                <li class="page-item last">
                    <a class="page-link" href="javascript:void(0);"
                    ><i class="tf-icon bx bx-chevrons-right"></i
                    ></a>
                </li>
                </ul>
            </nav>
            <!--/ Basic Pagination -->        
        </div>   
    </div>
@endsection