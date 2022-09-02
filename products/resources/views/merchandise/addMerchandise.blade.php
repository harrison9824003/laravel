<!-- 檔案目錄：resources/views/merchandise/editMerchandise.blade.php -->

<!-- 指定繼承 layout.master 母模板 -->
@extends('layout.master')

<!-- 傳送資料到母模板，並指定變數為 title -->
@section('title', $title)

<!-- 傳送資料到母模板，並指定變數為 content -->
@section('content')
    <div class="container">
        <h1>{{ $title }}</h1>

        {{-- 錯誤訊息模板元件 --}}
        @include('components.validationErrorMessage')

        <div class="row justify-content-center">
            <div class="col-md-6 border shadow p-3">
                <form action="/merchandise/create"
                      method="post"
                      enctype="multipart/form-data"
                >

                    <div class="form-group mt-3">
                        <label for="type">{{ trans('shop.merchandise.fields.status-name') }}</label>
                        <select class="form-select"
                                name="status"
                                id="status"
                        >
                            <option value="C">
                                {{ trans('shop.merchandise.fields.status.create') }}
                            </option>
                            <option value="S">
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
                               value=""
                        >
                    </div>
                    <div class="form-group mt-3">
                        <label for="name_en">{{ trans('shop.merchandise.fields.name-en') }}</label>
                        <input type="text"
                               class="form-control"
                               id="name_en"
                               name="name_en"
                               placeholder="{{ trans('shop.merchandise.fields.name-en') }}"
                               value=""
                        >
                    </div>
                    <div class="form-group mt-3">
                        <label for="introduction">{{ trans('shop.merchandise.fields.introduction') }}</label>
                        <input type="text"
                               class="form-control"
                               id="introduction"
                               name="introduction"
                               placeholder="{{ trans('shop.merchandise.fields.introduction') }}"
                               value=""
                        >
                    </div>
                    <div class="form-group mt-3">
                        <label for="introduction_en">{{ trans('shop.merchandise.fields.introduction-en') }}</label>
                        <input type="text"
                               class="form-control"
                               id="introduction_en"
                               name="introduction_en"
                               placeholder="{{ trans('shop.merchandise.fields.introduction-en') }}"
                               value=""
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
                    </div>

                    <div class="form-group mt-3">
                        <label for="price">{{ trans('shop.merchandise.fields.price') }}</label>
                        <input type="text"
                               class="form-control"
                               id="price"
                               name="price"
                               placeholder="{{ trans('shop.merchandise.fields.price') }}"
                               value=""
                        >
                    </div>
                    <div class="form-group mt-3">
                        <label for="remain_count">{{ trans('shop.merchandise.fields.remain-count') }}</label>
                        <input type="text"
                               class="form-control"
                               id="remain_count"
                               name="remain_count"
                               placeholder="{{ trans('shop.merchandise.fields.remain-count') }}"
                               value=""
                        >
                    </div>
                    <div class="text-end">
                        <button type="submit" class="btn btn-outline-secondary mt-3">{{ trans('shop.merchandise.create') }}</button>
                    </div>
                    {{-- CSRF 欄位--}}
                    {{ csrf_field() }}
                </form>
            </div>
        </div>
    </div>
@endsection