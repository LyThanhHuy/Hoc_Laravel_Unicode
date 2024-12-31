@extends('layouts.client')

@section('title')
    {{ $title }}
@endsection

@section('content')
    @if (session('msg'))
        <div class="alert alert-success">
            {{ session('msg') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            Du lieu nhap vao khong hop le. Vui long kiem tra lai
        </div>
    @endif

    <h1>{{ $title }}</h1>

    <form action="{{ route('users.post-edit') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="">Ho va ten</label>
            <input type="text" class="form-control" name="fullname" placeholder="ho va ten"
                value="{{ old('fullname') ?? $userDetail->fullname }}">
            @error('fullname')
                <span style="color: red">
                    {{ $message }}
                </span>
            @enderror
        </div>

        <div class="mb-3">
            <label for="">Email</label>
            <input type="text" class="form-control" name="email" placeholder="Email"
                value="{{ old('email') ?? $userDetail->email }}">
            @error('email')
                <span style="color: red">
                    {{ $message }}
                </span>
            @enderror
        </div>

        <div class="mb-3">
            <label for="">Nhom</label>
            <select name="group_id" class="form-control" id="">
                <option value="0">Chon nhom</option>
                @if (!empty($allGroups))
                    @foreach ($allGroups as $item)
                        <option value="{{ $item->id }}"
                            {{ old('group_id') == $item->id || $userDetail->group_id == $item->id ? 'selected' : false }}>
                            {{ $item->name }}</option>
                    @endforeach
                @endif
            </select>
            @error('group_id')
                <span style="color: red">
                    {{ $message }}
                </span>
            @enderror
        </div>

        <div class="mb-3">
            <label for="">Trang thai</label>
            <select name="status" class="form-control" id="">
                <option value="0" {{ old('status') == 0 || $userDetail->status == 0 ? 'selected' : false }}>Chua kich
                    hoat</option>
                <option value="1" {{ old('status') == 1 || $userDetail->status == 1 ? 'selected' : false }}>Kich hoat</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Cap nhat</button>
        <a href="{{ route('users.index') }}" class="btn btn-warning">Quay lai</a>
    </form>
@endsection
