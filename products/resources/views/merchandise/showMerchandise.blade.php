<!-- 檔案目錄：resources/views/merchandise/showMerchandise.blade.php -->

<!-- 指定繼承 layout.master 母模板 -->
@extends('layout.master')

<!-- 傳送資料到母模板，並指定變數為 title -->
@section('title', $title)

<!-- 傳送資料到母模板，並指定變數為 content -->
@section('content')
    <div class="container px-0">       

        {{-- 錯誤訊息模板元件 --}}
        @include('components.validationErrorMessage')

        <div class="row">
            <div class="col-lg-6 col-sm-12">
                @if( $Merchandise->photo != '' )
                    <img class="img-fluid" src="{{ $Merchandise->photo }}" />
                @else
                    <img class="img-fluid" src="{{ url('/images/450_300.png') }}" />
                @endif
                
            </div>
            <div class="col-lg-6 col-sm-12">
                <h1>{{ $Merchandise->name }}</h1>

                <p class="mt-3">{{ trans('shop.merchandise.fields.price') }} : ${{ $Merchandise->price }}</p>
                <p>{{ trans('shop.merchandise.fields.remain-count') }} : {{ $Merchandise->remain_count }}</p> 
                <p>{{ trans('shop.merchandise.fields.introduction') }} : </p>
                <div>{{ $Merchandise->introduction }}</div>
                <!-- <p class="mb-0">{{ trans('shop.transaction.fields.buy-count') }} : </p> -->
                <form action="/merchandise/{{ $Merchandise->id }}/buy" class="mt-3 row" method="post" > 
                    <div class="col-lg-3 col-sm-12">
                    {{ trans('shop.transaction.fields.buy-count') }} :
                    </div>
                    <div class="col-lg-3 col-sm-12">
                        <select class="form-select" name="buy_count">
                            @for($count = 0; $count <= $Merchandise->remain_count; $count++)
                                <option value="{{ $count }}">{{ $count }}</option>
                            @endfor
                        </select>
                    </div>                   
                    <div class="col-lg-6 col-sm-12">
                        <button type="submit" class="btn btn-info w-100">
                            {{ trans('shop.transaction.buy') }}
                        </button>
                    </div>
                    {{ csrf_field() }}
                </form>       
            </div>
            
        </div>
    </div>
@endsection