@extends('layouts.client')

@section('title')
    {{ $title }}
@endsection

@section('content')
    @if (@session('msg'))
        <div class="alert alert-success">
            {{ session('msg') }}
        </div>
    @endif
    <h1>{{ $title }}</h1>

    <form action="{{ route('posts.delete-any') }}" method="POST" onsubmit="return confirm('ban co chac chan muon xoa')">

        <button type="submit" class="btn btn-danger">Xoa (0)</button>
        <hr>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th width="5%">
                        <input type="checkbox" id="checkAll">
                    </th>
                    <th width="5%">STT</th>
                    <th>Tieu de</th>
                    <th width="15%">Trang thai</th>
                    <th width="15%">Hanh dong</th>
                </tr>
            </thead>
            <tbody>
                @if ($allPosts->count() > 0)
                    @foreach ($allPosts as $key => $item)
                        <tr>
                            <td>
                                <input type="checkbox" name="delete[]" value="{{ $item->id }}">
                            </td>
                            <td>
                                {{ $key + 1 }}
                            </td>
                            <td>
                                {{ $item->title }}
                            </td>
                            <td>
                                @if ($item->trashed())
                                    <button class="btn btn-danger">Da xoa</button>
                                @else
                                    <button class="btn btn-success">Chua xoa</button>
                                @endif
                            </td>
                            <td>
                                @if ($item->trashed())
                                    <a onclick="return confirm('are you sure')" href="{{ route('posts.restore', $item) }}"
                                        class="btn btn-primary">Khoi phuc</a>
                                    <a onclick="return confirm('are you sure')"
                                        href="{{ route('posts.force-delete', $item) }}" class="btn btn-danger">Xoa vinh
                                        vien</a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
        @csrf
    </form>
@endsection
