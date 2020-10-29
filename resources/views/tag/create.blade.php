タグ登録
{!! Form::open(['route' => 'tags.create']) !!}

    {!! Form::label('name', 'タグ名') !!}
    {!! Form::text('name', '', ['required']) !!}
    <br>
    {!! Form::submit('登録する') !!}
{!! Form::close() !!}
