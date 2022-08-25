<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>@yield('title') - Shop Laravel</title>
    <script src="/assets/js/jquery-2.2.4.min.js" defer></script>
    <script src="/assets/js/bootstrap.min.js" defer></script>
    <script src="/assets/js/js.cookie.js" defer></script>
    <script src="/assets/js/shop-laravel.js" defer></script>
    <!-- <link rel="stylesheet" href="/assets/css/bootstrap.min.css"> -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">
    <link rel="stylesheet" href="/assets/css/font-awesome.min.css">
    <!-- <link rel="stylesheet" href="/assets/css/shop_laravel.css"> -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="stylesheet" type="text/css" href="{{ url('/css/style.css') }}" />    
</head>
<body>

<nav class="navbar navbar-inverse navbar-fixed-top p-0 sticky-top">
    <div class="container-fluid p-0">
        <nav class="navbar navbar-expand-lg navbar-light bg-light w-100">
            <div class="container">
                <a class="navbar-brand" href="/"><i class="bi bi-house-fill"></i></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <!-- <li class="nav-item"><a class="nav-link" aria-current="page" href="/">{{ trans('shop.home') }}</a></li> -->

                    {{-- 語言 --}}
                    <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-translate"></i>語言
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="#">繁體中文</a></li>
                        <li><a class="dropdown-item" href="#">简体中文</a></li>
                        <li><a class="dropdown-item" href="#">English</a></li>                        
                    </ul>
                    </li>

                    @if(session()->has('user_id'))

                        {{-- 交易 --}}
                        <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-wallet2"></i>{{ trans('shop.transaction.name') }}
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="/transaction">{{ trans('shop.transaction.list') }}</a></li>                   
                        </ul>
                        </li>

                        {{-- 商品管理 --}}
                        <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-bag-fill"></i>{{ trans('shop.merchandise.name') }}
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="/merchandise/create">{{ trans('shop.merchandise.create') }}</a></li>                   
                            <li><a class="dropdown-item" href="/merchandise/manage">{{ trans('shop.merchandise.manage') }}</a></li>                   
                        </ul>
                        </li>

                        {{-- 登出 --}}
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="/user/auth/sign-out">
                                <i class="bi bi-box-arrow-right"></i>{{ trans('shop.auth.sign-out') }}
                            </a>
                        </li>
                        
                    @else

                        <li class="nav-item"><a class="nav-link" href="/user/auth/sign-in">{{ trans('shop.auth.sign-in') }}</a></li>
                        <li class="nav-item"><a class="nav-link" href="/user/auth/github-sign-in">{{ trans('shop.auth.github-sign-in') }}</a></li>
                        <li class="nav-item"><a class="nav-link" href="/user/auth/facebook-sign-in">{{ trans('shop.auth.facebook-sign-in') }}</a></li>
                        <li class="nav-item"><a class="nav-link" href="/user/auth/sign-up">{{ trans('shop.auth.sign-up') }}</a></li>

                    @endif
                    
                </ul>
                <form class="d-flex ms-lg-3">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
                </div>
            </div>
        </nav>
    </div>
</nav>

<div class="container mt-3">
    @yield('content')
</div>

</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-p34f1UUtsS3wqzfto5wAAmdvj+osOnFyQFpp4Ua3gs/ZVWx6oOypYoCJhGGScy+8" crossorigin="anonymous"></script>
</html>