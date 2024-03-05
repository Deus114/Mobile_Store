@extends('admin.index')

@section('content')

    <div class="bg-light d-flex align-items-center justify-content-center border rounded-3 p-1 p-sm-3 m-2 m-sm-4">
        <h2>BANNER</h2>
    </div>
    <a href="{{ route('banner.create') }}" class="btn btn-success"><i class="bi bi-plus"></i> Thêm mới</a>
    <table class="table table-hover">
        <thead>
            <tr>
                <th>STT</th>
                <th>Nội dung</th>
                <th>Hình ảnh</th>
                <th>Ưu tiên</th>
                <th>Trạng thái</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @php
                $stt=0;
            @endphp
            @foreach ($banners as $item)
                @php
                    $stt++;
                @endphp
                <tr>
                    <td>{{ $stt }}</td>
                    <td>{{ $item -> content }}</td>
                    <td>
                        <img src="/uploads/banners/{{ $item -> image }}" alt="{{ $item -> name }}" width="60">
                    </td>
                    <td>{{ $item -> priority }}</td>
                    <td>{{ $item -> status == 0 ? 'Ẩn' : 'Hiển thị' }}</td>
                    <td>
                        <form action="{{ route('banner.destroy', $item->id) }}" method="post">
                            @csrf @method('DELETE')
                            <br>
                            <a href="{{ route('banner.edit', $item->id) }}" class="btn btn-sm btn-warning"><i class="bi bi-pencil-square"></i> Sửa</a>
                            <button class="btn btn-sm btn-danger" onclick="return confirm('Bạn có muốn xóa {{ $item->name }}')"><i class="bi bi-trash"></i> Xóa</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $banners->links() }}
@endsection