<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>タグ一覧</title>
</head>
<body>
    <a href="{{ route('tags.createForm') }}">新規タグ登録</a>
    <h1>タグ一覧</h1>
    @foreach ($tags as $tag)
    <h2>{{ $tag->name }}</h2>
    <a href="{{ route('tags.updateForm', ['tag_id' => $tag->id]) }}">タグ編集</a>
    {!! Form::open(['route' => ['tags.destroy', 'tag_id' => $tag->id], 'id' => 'delete'.$tag->id]) !!}
    {!! Form::button('削除', ['onClick' => 'deleteConfirm('.$tag->id.')']) !!}
    {!! Form::close() !!}
    @endforeach

<script>
function deleteConfirm(tag_id) {
    var res = confirm('本当に削除しますか？');
    if (res === true) {
        document.getElementById('delete'+tag_id).submit();
    } 
}
</script>
</body>
</html>