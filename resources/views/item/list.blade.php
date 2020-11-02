@extends('common.main')
@section('title')
出品中商品一覧
@endsection

@section('body')
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
    <a href="{{ route('items.detail', ['item_id' => $item->id]) }}">商品詳細</a>
    <a href="{{ route('items.updateForm', ['item_id' => $item->id]) }}">商品編集</a>
    {!! Form::open(['route' => ['items.destroy', 'item_id' => $item->id], 'id' => 'delete'.$item->id]) !!}
    {!! Form::button('削除', ['onClick' => 'deleteConfirm('.$item->id.')']) !!}
    {!! Form::close() !!}
    @endforeach
    {{ $items->links() }}

<script>
function deleteConfirm(item_id) {
    var res = confirm('本当に削除しますか？');
    if (res === true) {
        document.getElementById('delete'+item_id).submit();
    }
}
</script>
@endsection