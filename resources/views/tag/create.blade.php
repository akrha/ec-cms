@extends('common.main')

@section('title')
タグ登録
@endsection

@section('body')
{!! Form::open(['route' => 'tags.create']) !!}

    {!! Form::label('name', 'タグ名') !!}
    {!! Form::text('name', '', ['required']) !!}
    <br>
    {!! Form::submit('登録する') !!}
{!! Form::close() !!}
@endsection