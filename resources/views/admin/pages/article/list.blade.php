@extends('admin.layout.master')

@section('content')
    <div class="d-flex flex-column h-100 bg-white p-3 rounded">
        <div class="d-flex mb-5">
            <a href="{{ route('article.create') }}" class="btn btn-icon btn-primary d-flex">
                <span class="tf-icons bx bx-plus"></span>
            </a>
        </div>
        <div class="table-responsive text-nowrap h-100">
            <table class="table">
            <thead>
                <tr>
                    <th>文章標題</th>
                    <th>分類</th>
                    <th>上架日期</th>
                    <th>狀態</th>
                    <th>操作</th>
                </tr>
            </thead>
            @if ( $paginate->count() > 0 )
                <tbody class="table-border-bottom-0"> 
                    @foreach( $paginate as $article )               
                        <tr>
                            <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>{{ $article->title }}</strong></td>
                            <td>{{ $article->category->name }}</td>
                            <td>
                                {{ date("Y-m-d", strtotime($article->start_date)) }}
                            </td>
                            <td>
                                @if( $article->start_date <= date('Y-m-d H:i:s') && $article->end_date >= date('Y-m-d H:i:s') )
                                    <span class="badge bg-label-primary me-1">上架中</span>
                                @elseif ( $article->start_date > date('Y-m-d H:i:s') && $article->end_date >= date('Y-m-d H:i:s') )
                                    <span class="badge bg-label-secondary me-1">預上架</span>
                                @elseif ( $article->end_date < date('Y-m-d H:i:s') )
                                    <span class="badge bg-label-danger me-1">下架</span>
                                @endif
                            </td>
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="{{ route('article.edit', ['article' => $article->id]) }}">
                                            <i class="bx bx-edit-alt me-1"></i> 編輯
                                        </a>
                                        <a class="dropdown-item" href="javascript:void(0);" id="{{ $article->id }}" onclick="deleteArticle(this.id)">
                                            <i class="bx bx-trash me-1"></i> 刪除
                                        </a>
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
        function deleteArticle(id) {
            if(confirm('確定要刪除嗎')) {
                $.ajax({
                    url:'/adm/article/'+id,
                    type:"POST",
                    dataType: 'json',
                    headers:{
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        '_method':'delete'
                    },
                    success:function(data){
                        //console.log(data);
                        if(data.status == 1) {
                            alert(data.msg);
                            window.location.reload();
                        }
                    }, error: function(a,b,c) {
                        console.log(a)
                        console.log(b)
                        console.log(c)
                    }
                });
            }
        }
    </script>
@endpush