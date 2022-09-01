<!-- 檔案目錄：resources/views/auth/signUp.blade.php -->

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
            <div class="col-md-6">
                <form action="/user/auth/sign-up" method="post">
                    <div class="form-group mt-3">
                        <label for="nickname">{{ trans('shop.user.fields.nickname') }}</label>
                        <input type="text"
                               class="form-control mt-3"
                               id="nickname"
                               name="nickname"
                               placeholder="{{ trans('shop.user.fields.nickname') }}"
                               value="{{ old('nickname') }}"
                        >
                    </div>
                    <div class="form-group mt-3">
                        <label for="email">{{ trans('shop.user.fields.email') }}</label>
                        <input type="text"
                               class="form-control mt-3"
                               id="email"
                               name="email"
                               placeholder="{{ trans('shop.user.fields.email') }}"
                               value="{{ old('email') }}"
                        >
                    </div>
                    <div class="form-group mt-3">
                        <label for="password">{{ trans('shop.user.fields.password') }}</label>
                        <input type="password"
                               class="form-control mt-3"
                               id="password"
                               name="password"
                               placeholder="{{ trans('shop.user.fields.password') }}"
                        >
                    </div>
                    <div class="form-group mt-3">
                        <label for="password">{{ trans('shop.user.fields.confirm-password') }}</label>
                        <input type="password"
                               class="form-control mt-3"
                               id="password"
                               name="password_confirmation"
                               placeholder="{{ trans('shop.user.fields.confirm-password') }}"
                        >
                    </div>
                    <div class="form-group mt-3">
                        <label for="type">{{ trans('shop.user.fields.type-name') }}</label>
                        <select class="form-control mt-3"
                                name="type"
                                id="type"
                        >
                            <option value="G"
                                    @if(old('type')=='G') selected @endif
                            >
                                {{ trans('shop.user.fields.type.general') }}
                            </option>
                            <option value="A"
                                    @if(old('type')=='A') selected @endif
                            >
                                {{ trans('shop.user.fields.type.admin') }}
                            </option>
                        </select>
                    </div>

                    <div class="text-end">
                        <button type="submit" class="btn btn-secondary mt-3 col-6">{{ trans('shop.auth.sign-up') }}</button>
                    </div>

                    {{-- CSRF 欄位--}}
                    {{ csrf_field() }}
                </form>
            </div>
        </div>
    </div>
@endsection