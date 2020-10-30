商品登録
{!! Form::open(['route' => 'items.create']) !!}

    {!! Form::label('name', '商品名') !!}
    {!! Form::text('name', '', ['required']) !!}
    <br>
    {!! Form::label('description', '説明文') !!}
    {!! Form::textarea('description') !!}
    <br>
    {!! Form::label('price', '価格') !!}
    {!! Form::number('price', '0', ['min' => '0', 'required']) !!}
    <br>
    タグ
    <br>
    @foreach ($tags as $tag)
    <label>
    {!! Form::checkbox('tags_selected[]', $tag->id) !!}
    {!! $tag->name !!}
    </label>
    <br>
    @endforeach
    <a href="{{ route('tags.createForm') }}">新規タグ</a>
    <br>
    画像
    WIP
    <br>
    {!! Form::submit('登録する') !!}
{!! Form::close() !!}
