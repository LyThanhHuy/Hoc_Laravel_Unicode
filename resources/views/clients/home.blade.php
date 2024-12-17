@extends('layouts.client')

@section('title')
    {{ $title }}
@endsection

@section('sidebar')
    @parent
    <h3>home sidebar</h3>
@endsection

@section('content')
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

    <p>
        <img src="https://d1hjkbq40fs2x4.cloudfront.net/2017-08-21/files/landscape-photography_1645-t.jpg" alt="">
    </p>

    {{-- <p>
        <a href="{{ route('download-image') . '?image=https://d1hjkbq40fs2x4.cloudfront.net/2017-08-21/files/landscape-photography_1645-t.jpg' }}"
            class="btn btn-primary">Download ảnh</a>
    </p> --}}
    <p>
        <a href="{{ route('download-image').'?image='.public_path('storage/landscape-photography_1645-t.jpg') }}"
            class="btn btn-primary">Download ảnh</a>
    </p>
@endsection

@section('css')
    <style>
        img {
            max-width: 100%;
            height: auto;
        }
    </style>
@endsection

@section('js')
@endsection
