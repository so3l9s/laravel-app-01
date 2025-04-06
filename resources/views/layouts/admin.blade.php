<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', '管理画面')</title>
    
    <!-- StislaのCSS -->
    <link rel="stylesheet" href="{{ asset('stisla/assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('stisla/assets/css/components.css') }}">

</head>
<body>
    <div id="app">
        @if (Auth::check())
        <li class="dropdown">
            <a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
            <div class="d-sm-none d-lg-inline-block">
                {{ Auth::user()->name }}さん
            </div>
            </a>
        </li>
        @endif
        <div class="main-wrapper">
            <!-- サイドバー -->
            @include('layouts.sidebar')

            <!-- メインコンテンツ -->
            <div class="main-content">
                <section class="section">
                    <div class="section-header">
                        <h1>@yield('page-title')</h1>
                    </div>

                    <div class="section-body">
                        @yield('content')
                    </div>
                </section>
            </div>
        </div>
    </div>

    <!-- StislaのJS -->
    <script src="{{ asset('stisla/assets/js/stisla.js') }}"></script>
    <script src="{{ asset('stisla/assets/js/scripts.js') }}"></script>
</body>
</html>
