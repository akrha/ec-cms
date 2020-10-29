<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>出品中商品一覧</title>
</head>
<body>
    <a href="{{ route('items.createForm') }}">新規商品登録</a>
    <h1>出品中商品一覧</h1>
    @foreach ($items as $item)
    <h2>{{ $item->item_name }}</h2>
    説明：
    <pre>{{ $item->description }}</pre>
    価格：
    <p>{{ $item->price }} 円</p>
    登録日：
    <p>{{ $item->created_at }}</p>
    更新日：
    <p>{{ $item->updated_at }}</p>
    画像：
    <p><img src="{{ $item->photo_url }}" alt=""></p>
    タグ(WIP)：
    <p>{{ $item->tag_name }}</p>
    <a href="{{ route('items.detail', ['item_id' => $item->id]) }}">商品詳細</a>
    <a href="{{ route('items.updateForm', ['item_id' => $item->id]) }}">商品編集</a>
    @endforeach
</body>
</html>