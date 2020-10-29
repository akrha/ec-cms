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
    WIP
    <br>
    画像
    WIP
    <br>
    {!! Form::submit('登録する') !!}
{!! Form::close() !!}
