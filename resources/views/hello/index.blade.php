@extends('layouts.helloapp')

@section('title', 'Index')

@section('menubar')
    @parent
    インデックスページ
@endsection

@section('content')
    <p>ここが本文</p>
    <p>必要なだけ記述可能</p>

    @component('components.message')
        @slot('msg_title')
            CAUTION!
        @endslot

        @slot('msg_content')
            これはメッセージです。
        @endslot

    @endcomponent
@endsection

@section('footer')
    copyright 2024 OKABE
@endsection
