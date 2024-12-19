@extends('layouts.client')

@section('title')
    {{ $title }}
@endsection

@section('sidebar')
    @parent
    <h3>home sidebar</h3>
@endsection

@section('content')
    @if (session('msg'))
        <div class="alert alert-{{session('type')}}">
            {{ session('msg') }}
        </div>
    @endif

    <h1>Trang chủ</h1>
    @datetime('2021-12-15 15:00:30')
    @include('clients.contents.slide')
    @include('clients.contents.about')

    @env('production')
    <p>Moi truong dev</p>
    @elseenv('local')
    <p>Khong phai moi truong dev</p>
    @endenv

    <x-alert type='info' :content="$message" data-icon="youtube" />

    {{-- <x-inputs.button/>
    <x-forms.button /> --}}
    {{-- <x-form-button /> --}}
@endsection

@section('css')
@endsection

@section('js')
@endsection
