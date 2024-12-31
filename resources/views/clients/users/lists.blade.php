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
    <h1>{{ $title }}</h1>
    <a href="{{ route('users.add') }}" class="btn btn-primary">Them nguoi dung</a>
    <hr>

    <form action="" method="get" class="mb-3">
        <div class="row">

            <div class="col-3">
                <select class="form-control" name="status">
                    <option value="0">Tất cả trạng thái</option>
                    <option value="active" {{ request()->status === 'active' ? 'selected' : false }}>
                        Kích hoạt
                    </option>
                    <option value="inactive" {{ request()->status === 'inactive' ? 'selected' : false }}>
                        Chưa Kích hoạt
                    </option>
                </select>
            </div>

            <div class="col-3">
                <select class="form-control" name="group_id">
                    <option value="0">Tat ca nhom</option>
                    @if (!empty(getAllGroups()))
                        @foreach (getAllGroups() as $item)
                            <option value="{{ $item->id }}"
                                {{ request()->group_id === $item->id ? 'selected' : false }}>
                                {{ $item->name }}
                            </option>
                        @endforeach
                    @endif
                </select>
            </div>

            <div class="col-4">
                <input type="search" class="form-control" placeholder="Tu khoa tim kiem" name="keywords"
                    value="{{ request()->keywords }}">
            </div>

            <div class="col-2">
                <button type="submit" class="btn btn-primary btn-block">Tìm kiếm</button>
            </div>

        </div>
    </form>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th width="5%">STT</th>
                <th>
                    <a href="?sort-by=fullname&sort-type={{ $sortType }}">
                        Ten
                    </a>
                </th>
                <th>
                    <a href="?sort-by=email&sort-type={{ $sortType }}">
                        Email
                    </a>
                </th>
                <th>Nhom</th>
                <th>Trang thai</th>
                <th width="15%">
                    <a href="?sort-by=create_at&sort-type={{ $sortType }}">
                        Thoi gian
                    </a>
                </th>
                <th width="5%">Sua</th>.
                <th width="5%">Xoa</th>
            </tr>
        </thead>
        <tbody>
            @if (!@empty($usersList))
                @foreach ($usersList as $key => $item)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $item->fullname }}</td>
                        <td>{{ $item->email }}</td>
                        <td>{{ $item->group_name }}</td>
                        <td>
                            {!! $item->status === 0
                                ? '<button class="btn btn-danger btn-sm">Chua kich hoat</button>'
                                : '<button class="btn btn-success btn-sm">Kich hoat</button>' !!}
                        </td>
                        <td>{{ $item->create_at }}</td>
                        <td>
                            <a href="{{ route('users.edit', ['id' => $item->id]) }}" class="btn btn-warning btn-sm">Sua</a>
                        </td>
                        <td>
                            <a onclick="return confirm('ban co chac chan muon xoa')"
                                href="{{ route('users.delete', ['id' => $item->id]) }}"
                                class="btn btn-danger btn-sm">Xoa</a>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="6">Khong co nguoi dung</td>
                </tr>
            @endif
        </tbody>
    </table>

    <div class="d-flex justify-content-end">
        {{ $usersList->links() }}
    </div>

@endsection
