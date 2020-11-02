<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>
        @yield('title')
    </title>
</head>
<body>
<a href="{{ route('items.index') }}">TOP</a>
<a href="{{ route('items.index') }}">商品一覧</a>
<a href="{{ route('items.createForm') }}">新規商品登録</a>
<a href="{{ route('tags.index') }}">タグ一覧</a>
<a href="{{ route('tags.createForm') }}">新規タグ登録</a>
@if (Auth::id())
<a class="dropdown-item" href="{{ route('logout') }}"
    onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
    {{ __('Logout') }}
</a>
<form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
    @csrf
</form>
@else
<a href="{{ route('login') }}">ログイン</a>
@endif
@yield('body')
</body>
</html>
