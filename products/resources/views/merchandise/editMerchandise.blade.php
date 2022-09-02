<!-- 檔案目錄：resources/views/merchandise/editMerchandise.blade.php -->

<!-- 指定繼承 layout.master 母模板 -->
@extends('layout.master')

<!-- 傳送資料到母模板，並指定變數為 title -->
@section('title', $title)

<!-- 傳送資料到母模板，並指定變數為 content -->
@section('content')
    <div class="container">
        <h1 class="text-center">{{ $title }}</h1>

        {{-- 錯誤訊息模板元件 --}}
        @include('components.validationErrorMessage')

        <div class="row justify-content-center">
            <div class="col-md-6  border shadow p-3">
                <form action="/merchandise/{{ $Merchandise->id }}"
                      method="post"
                      enctype="multipart/form-data"
                >
                    {{-- 隱藏方法欄位 --}}
                    {{ method_field('PUT') }}

                    <div class="form-group mt-3">
                        <label for="type">{{ trans('shop.merchandise.fields.status-name') }}</label>
                        <select class="form-select"
                                name="status"
                                id="status"
                        >
                            <option value="C"
                                    @if(old('status', $Merchandise->status)=='C') selected @endif
                            >
                                {{ trans('shop.merchandise.fields.status.create') }}
                            </option>
                            <option value="S"
                                    @if(old('status', $Merchandise->status)=='S') selected @endif
                            >
                                {{ trans('shop.merchandise.fields.status.sell') }}
                            </option>
                        </select>
                    </div>
                    <div class="form-group mt-3">
                        <label for="name">{{ trans('shop.merchandise.fields.name') }}</label>
                        <input type="text"
                               class="form-control"
                               id="name"
                               name="name"
                               placeholder="{{ trans('shop.merchandise.fields.name') }}"
                               value="{{ old('name', $Merchandise->name) }}"
                        >
                    </div>
                    <div class="form-group mt-3">
                        <label for="name_en">{{ trans('shop.merchandise.fields.name-en') }}</label>
                        <input type="text"
                               class="form-control"
                               id="name_en"
                               name="name_en"
                               placeholder="{{ trans('shop.merchandise.fields.name-en') }}"
                               value="{{ old('name_en', $Merchandise->name_en) }}"
                        >
                    </div>
                    <div class="form-group mt-3">
                        <label for="introduction">{{ trans('shop.merchandise.fields.introduction') }}</label>
                        <input type="text"
                               class="form-control"
                               id="introduction"
                               name="introduction"
                               placeholder="{{ trans('shop.merchandise.fields.introduction') }}"
                               value="{{ old('introduction', $Merchandise->introduction) }}"
                        >
                    </div>
                    <div class="form-group mt-3">
                        <label for="introduction_en">{{ trans('shop.merchandise.fields.introduction-en') }}</label>
                        <input type="text"
                               class="form-control"
                               id="introduction_en"
                               name="introduction_en"
                               placeholder="{{ trans('shop.merchandise.fields.introduction-en') }}"
                               value="{{ old('introduction_en', $Merchandise->introduction_en) }}"
                        >
                    </div>
                    <div class="form-group mt-3">
                        <label for="photo">{{ trans('shop.merchandise.fields.photo') }}</label>
                        <input type="file"
                               class="form-control"
                               id="photo"
                               name="photo"
                               placeholder="{{ trans('shop.merchandise.fields.photo') }}"
                        >
                        @if( !empty($Merchandise->photo) )
                        <img src="{{ $Merchandise->photo }}" class="img-fluid mt-3" />
                        @endif
                    </div>

                    <div class="form-group mt-3">
                        <label for="price">{{ trans('shop.merchandise.fields.price') }}</label>
                        <input type="text"
                               class="form-control"
                               id="price"
                               name="price"
                               placeholder="{{ trans('shop.merchandise.fields.price') }}"
                               value="{{ old('price', $Merchandise->price) }}"
                        >
                    </div>
                    <div class="form-group mt-3">
                        <label for="remain_count">{{ trans('shop.merchandise.fields.remain-count') }}</label>
                        <input type="text"
                               class="form-control"
                               id="remain_count"
                               name="remain_count"
                               placeholder="{{ trans('shop.merchandise.fields.remain-count') }}"
                               value="{{ old('remain_count', $Merchandise->remain_count) }}"
                        >
                    </div>
                    <div class="text-end">
                        <button type="submit" class="btn btn-outline-secondary mt-3">{{ trans('shop.merchandise.update') }}</button>
                    </div>
                    
                    {{-- CSRF 欄位--}}
                    {{ csrf_field() }}
                </form>
            </div>
        </div>
    </div>
@endsection