@extends('layout.master')
@section('title', $title)

@section('content')
    <div class="container p-0">

        {{-- 錯誤訊息模板元件 --}}
        @include('components.validationErrorMessage')
        
        <h2>購物車清單</h2>
        
        <div id="cartlist">
            <cartlist-component></cartlist-component>
        </div>
            
    </div>
@endsection