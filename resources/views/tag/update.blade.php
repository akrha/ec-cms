<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>タグ編集</title>
</head>
<body>
    <a href="{{ route('tags.createForm') }}">新規タグ登録</a>
    <a href="{{ route('tags.index') }}">出品中タグ一覧</a>
    <h1>タグ編集ページ</h1>
    {!! Form::open(['route' => 'tags.update']) !!}

    {!! Form::label('name', 'タグ名') !!}
    {!! Form::text('name', $tag->name, ['required']) !!}
    <br>
    {!! Form::hidden('id' ,$tag->id) !!}
    {!! Form::submit('更新する') !!}

    {!! Form::close() !!}
</body>
</html>