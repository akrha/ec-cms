@extends('common.main')

@section('title')
商品編集
@endsection

@section('body')
<a href="{{ route('items.createForm') }}">新規商品登録</a>
    <a href="{{ route('items.index') }}">出品中商品一覧</a>
    <h1>商品編集ページ</h1>
    {!! Form::open(['route' => 'items.update']) !!}

    {!! Form::label('name', '商品名') !!}
    {!! Form::text('name', $item->item_name, ['required']) !!}
    <br>
    {!! Form::label('description', '説明文') !!}
    {!! Form::textarea('description', $item->description) !!}
    <br>
    {!! Form::label('price', '価格') !!}
    {!! Form::number('price', $item->price, ['min' => '0', 'required']) !!}
    <br>
    画像

    <br>
    {!! Form::hidden('item_id' ,$item->id) !!}
    {!! Form::submit('更新する') !!}

    {!! Form::close() !!}
@endsection
