@extends('common.main')

@section('title')
タグ編集
@endsection

@section('body')
<a href="{{ route('tags.createForm') }}">新規タグ登録</a>
<a href="{{ route('tags.index') }}">出品中タグ一覧</a>
<h1>タグ編集ページ</h1>
{!! Form::open(['route' => 'tags.update']) !!}

{!! Form::label('name', 'タグ名') !!}
{!! Form::text('name', $tag->name, ['required']) !!}
<br>
{!! Form::hidden('id' ,$tag->id) !!}
{!! Form::submit('更新する') !!}

{!! Form::close() !!}
@endsection
