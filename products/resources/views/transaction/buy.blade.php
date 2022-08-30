<!-- 檔案目錄：resources/views/transaction/listUserTransaction.blade.php -->

<!-- 指定繼承 layout.master 母模板 -->
@extends('layout.master')

<!-- 傳送資料到母模板，並指定變數為 title -->
@section('title', $title)

<!-- 傳送資料到母模板，並指定變數為 content -->
@section('content')
    <div class="container p-0">
        <h1 class="text-center">{{ $title }}</h1>

        {{-- 錯誤訊息模板元件 --}}
        @include('components.validationErrorMessage')

        <div class="row">
            <div class="col-md-12">
                <h2 class="border-bottom pb-3">商品</h2>
                <ul class="list-group">
                    @foreach ( $final_list as $product )
                    <li class="list-group-item">
                        商品名稱: {{ $product['name'] }} | 
                        商品數量: {{ $product['num'] }} |
                        商品單價: {{ 'NT$: '.number_format($product['price']) }} |
                        商品總金額: {{ 'NT$: '.number_format($product['p_total']) }}
                    </li>                
                    @endforeach
                </ul>
                <div>
                    <div class="text-end">運費: NT$: {{ number_format($final_meta['delivery_money']) }}</div>                    
                    <div class="text-end">總金額: NT$: {{ number_format($final_meta['total'] + $final_meta['delivery_money']) }}</div>
                </div>
                <form action="/transaction/buy" method="post" enctype="multipart/form-data">                   
                    <h2 class="border-bottom pb-3">寄件者資訊</h2>
                    <div class="row">
                        <div class="col-6">
                            <label for="exampleFormControlInput1" class="form-label">寄件者</label>
                            <input type="text" name="send_user" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com" value="{{ $user_info['name'] }}">
                        </div>
                        <div class="col-6">
                            <label for="exampleFormControlInput1" class="form-label">Email</label>
                            <input type="email" name="send_email" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com" value="{{ $user_info['email'] }}">
                        </div>                    
                    </div>
                    <h2 class="mt-3 border-bottom pb-3">收件者資訊</h2>
                    <div class="row gy-3">
                        <div class="col-6">
                            <label for="exampleFormControlInput1" class="form-label">收件者</label>
                            <input type="text" name="user" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com" value="{{ $user_info['name'] }}">
                        </div>
                        <div class="col-6">
                            <label for="exampleFormControlInput1" class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com" value="{{ $user_info['email'] }}">
                        </div>  
                        <div class="col-12">
                            <label for="exampleFormControlInput1" class="form-label">收件地址</label>
                            <input type="text" name="address" class="form-control" id="exampleFormControlInput1" placeholder="請填寫詳細地址" value="">
                        </div>
                    </div>
                    <input type="hidden" name="final_list" value="{{ json_encode($final_list) }}">
                    <input type="hidden" name="final_meta" value="{{ json_encode($final_meta) }}">
                    <input type="hidden" name="delivery_money" value="{{ $final_meta['delivery_money'] }}">
                    <input type="hidden" name="total_money" value="{{ $final_meta['total'] + $final_meta['delivery_money'] }}">         
                    {{-- CSRF 欄位--}}
                    {{ csrf_field() }}
                    <div class="text-end mt-3">
                        <button type="submit" class="btn btn-success">確認購買</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection