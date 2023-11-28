<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }} | @yield('title')</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    {{-- Stylesheet --}}
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    {{-- Font Awesome CDN Link --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    {{-- viewport --}}
    {{-- <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"> --}}
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <h1 class="h5 mb-0">{{ config('app.name') }}</h1>
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    {{-- Serch bar here. Show it when the user is logged in --}}
                    {{-- This serch bar is only available to logged-in users  --}}
                    @auth
                        @if (request()->is('admin/*'))
                            <ul class="navbar-nav ms-auto">
                                <form action="{{ route('search') }}" style="width: 300px">
                                    <input type="search" name="search" id="" class="form-control form-control-sm" placeholder=" 検索">
                                    {{-- <input type="search" name="search" id="" class="form-control form-control-sm" placeholder="Search..."> --}}
                                </form>
                            </ul>
                        @endif
                    @endauth

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            {{-- Home --}}
                            <li class="nav-item" title="ホーム">
                            {{-- <li class="nav-item" title="Home"> --}}
                                <a href="{{ route('index') }}" class="nav-link"><i class="fa-solid fa-house text-dark icon-sm"></i></a>
                            </li>

                            {{--  Create Post --}}
                            <li class="nav-item" title="新規投稿">
                            {{-- <li class="nav-item" title="Create Post"> --}}
                                <a href="{{ route('post.create') }}" class="nav-link"><i class="fa-solid fa-circle-plus text-dark icon-sm"></i></a>
                            </li>

                            {{-- Chat --}}
                            <li class="nav-item" title="チャット">
                            {{-- <li class="nav-item" title="Chat Box"> --}}
                                <a href="{{ route('chat.index', Auth::user()->id) }}" class="nav-link">
                                    <i class="fa-regular fa-paper-plane text-dark icon-sm"></i>
                                </a>
                            </li>

                            {{-- Account --}}
                            <li class="nav-item dropdown">

                                <button id="account-dropdown" class="btn shadow-none nav-link" data-bs-toggle="dropdown">

                                    @if (Auth::user()->avatar)
                                        <img src="{{ Auth::user()->avatar }}" alt="{{ Auth::user()->name }}" class="rounded-circle avatar-sm">
                                    @else
                                        <i class="fa-solid fa-circle-user text-dark icon-sm"></i>
                                    @endif

                                </button>

                                {{-- <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a> --}}

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="account-dropdown">
                                    @can('admin')
                                    {{-- Admin Controls --}}
                                    <a href="{{ route('admin.users') }}" class="dropdown-item">
                                        <i class="fa-solid fa-user-gear"></i> 管理者ページ
                                        {{-- <i class="fa-solid fa-user-gear"></i> Admin --}}
                                    </a>

                                    <hr>
                                    @endcan

                                    {{-- Profile --}}
                                    <a href="{{ route('profile.show', Auth::user()->id) }}" class="dropdown-item">
                                        @if (Auth::user()->avatar)
                                            <img src="{{ Auth::user()->avatar }}" alt="{{ Auth::user()->name }}" class="rounded-circle avatar-sm"> プロフィール
                                        @else
                                            <i class="fa-solid fa-circle-user"></i> プロフィール
                                            {{-- <i class="fa-solid fa-circle-user"></i> Profile --}}
                                            @endif
                                        </a>
                                    <hr>

                                    {{-- Logout --}}
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        <i class="fa-solid fa-right-from-bracket"></i> {{ __('ログアウト') }}
                                        {{-- <i class="fa-solid fa-right-from-bracket"></i> {{ __('Logout') }} --}}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-5">
            <div class="container">
                <div class="row justify-content-center">
                    {{-- Admin Controls --}}
                    {{-- true or false --}}

                    {{-- http:://localhost/post/3/show ---- false --}}
                    {{-- http:://localhost/admin/categories  ---> true --}}
                    {{-- http:://localhost/admin ---> true --}}

                    @if (request()->is('admin/*'))
                        <div class="col-3">
                            <div class="list-group">
                                <a href="{{ route('admin.users') }}" class="list-group-item {{ request()->is('admin/users') ? 'active':'' }}">
                                    <i class="fa-solid fa-users"></i> ユーザー
                                    {{-- <i class="fa-solid fa-users"></i> Users --}}
                                </a>
                                <a href="{{ route('admin.posts') }}" class="list-group-item {{ request()->is('admin/posts') ? 'active':'' }}">
                                    <i class="fa-solid fa-newspaper"></i> 投稿
                                    {{-- <i class="fa-solid fa-newspaper"></i> Posts --}}
                                </a>
                                <a href="{{ route('admin.categories') }}" class="list-group-item {{ request()->is('admin/categories') ? 'active':'' }}">
                                    <i class="fa-solid fa-tags"></i> カテゴリー
                                    {{-- <i class="fa-solid fa-tags"></i> Categories --}}
                                </a>
                            </div>
                        </div>
                    @endif

                    <div class="col-9">
                        @yield('content')
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>
</html>
