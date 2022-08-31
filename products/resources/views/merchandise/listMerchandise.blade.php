<!-- 檔案目錄：resources/views/merchandise/listMerchandise.blade.php -->

<!-- 指定繼承 layout.master 母模板 -->
@extends('layout.master')

<!-- 傳送資料到母模板，並指定變數為 title -->
@section('title', $title)

<!-- 傳送資料到母模板，並指定變數為 content -->
@section('content')
    <div class="container px-0">
        <h1>{{ $title }}</h1>

        {{-- 錯誤訊息模板元件 --}}
        @include('components.validationErrorMessage')

        <div class="row">
            @foreach($MerchandisePaginate as $Merchandise)
            <div class="col-lg-3 col-md-6 col-sm-12 my-2">
                <div class="card h-100">
                    @if( $Merchandise->photo != '' )
                    <a href="/merchandise/{{ $Merchandise->id }}">
                        <img src="{{ $Merchandise->photo }}" class="card-img-top" alt="...">
                    </a>
                    @endif
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">{{ $Merchandise->name }}</h5>
                        <p class="card-text">{{ Str::limit($Merchandise->introduction, 100, $end='...') }}</p>
                        <div class="mt-auto">
                            <a href="/merchandise/{{ $Merchandise->id }}" class="btn btn-primary w-100">詳細商品內容</a>
                        </div>                        
                    </div>
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-6 text-center border-end"><a href="#" class="link-danger fs-3" onclick="addToLike({{ $Merchandise->id }})"><i class="bi bi-suit-heart-fill"></i></a></div>
                            <div class="col-6 text-center"><a href="#" class="link-secondary fs-3" onclick="addToCart(event, {{ $Merchandise->id }})"><i class="bi bi-cart-plus"></i></a></div>
                        </div>
                    </div>
                </div>
            </div>            
            @endforeach
            <hr>
            <div class="col-md-12 d-flex justify-content-end"> 
                {{-- 分頁頁數按鈕 --}}
                {{ $MerchandisePaginate->links() }}
            </div>
        </div>
    </div>
@endsection