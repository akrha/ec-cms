@extends('common.main')
@section('title')
出品中商品一覧
@endsection

@section('body')
    <h1>出品中商品一覧</h1>
    @foreach ($items as $item)
    <div class="media">
        @if ($item->photo_url)
        <img src="/{{ $item->photo_url }}" class="img-thumbnail" style="width:30%">
        @else
        <img src="/no_photo.png"class="img-thumbnail w-3" style="width:30%">
        @endif
        <div class="media-body">
            <h5 class="mt-0">{{ $item->item_name }}</h5>
            {{ $item->description }}
            <p style="color:red">{{ $item->price }} 円</p>
            <a class="btn btn-success" href="{{ route('items.detail', ['item_id' => $item->id]) }}">商品詳細</a>
            <a class="btn btn-success" href="{{ route('items.updateForm', ['item_id' => $item->id]) }}">商品編集</a>
            {!! Form::open(['route' => ['items.destroy', 'item_id' => $item->id], 'id' => 'delete'.$item->id]) !!}
            <button class="btn btn-danger" onclick="deleteConfirm({{ $item->id }})" type="button">削除</button>
            {!! Form::close() !!}
        </div>
    </div>
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