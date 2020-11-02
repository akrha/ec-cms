@extends('common.main')
商品詳細
@section('title')
@endsection
<a href="{{ route('items.createForm') }}">新規商品登録</a>
    <a href="{{ route('items.index') }}">出品中商品一覧</a>
    <h1>商品詳細ページ</h1>
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
    <p><img src="/{{ $item->photo_url }}" alt=""></p>
    タグ：
    @if ($tags)
    @foreach ($tags as $tag)
    <p>{{ $tag->name }}</p>
    @endforeach
    @endif
    <p>{{ $item->tag_name }}</p>
    <a href="{{ route('items.updateForm', ['item_id' => $item->id]) }}">商品編集</a>
    {!! Form::open(['route' => ['items.destroy', 'item_id' => $item->id], 'id' => 'delete'.$item->id]) !!}
    {!! Form::button('削除', ['onClick' => 'deleteConfirm('.$item->id.')']) !!}
    {!! Form::close() !!}

<script>
function deleteConfirm(item_id) {
    var res = confirm('本当に削除しますか？');
    if (res === true) {
        document.getElementById('delete'+item_id).submit();
    } 
}
</script>
@section('body')
@endsection