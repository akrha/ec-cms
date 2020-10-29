<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>商品編集</title>
</head>
<body>
    <a href="{{ route('items.createForm') }}">新規商品登録</a>
    <a href="{{ route('items.index') }}">出品中商品一覧</a>
    <h1>商品編集ページ</h1>
    {!! Form::open(['route' => 'items.update']) !!}

    {!! Form::label('name', '商品名') !!}
    {!! Form::text('name', $item->item_name, ['required']) !!}
    <br>
    {!! Form::label('description', '説明文') !!}
    {!! Form::textarea('description', $item->description) !!}
    <br>
    {!! Form::label('price', '価格') !!}
    {!! Form::number('price', $item->price, ['min' => '0', 'required']) !!}
    <br>
    タグ
    WIP
    <br>
    画像
    WIP
    <br>
    {!! Form::hidden('item_id' ,$item->id) !!}
    {!! Form::submit('更新する') !!}

    {!! Form::close() !!}
</body>
</html>