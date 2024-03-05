@extends('admin.index')

@section('content')

    <div class="bg-light d-flex align-items-center justify-content-center border rounded-3 p-1 p-sm-3 m-2 m-sm-4">
        <h2>DANH MỤC SẢN PHẨM</h2>
    </div>
    <a href="{{ route('category.create') }}" class="btn btn-success"><i class="bi bi-plus"></i> Thêm mới</a>
    <table class="table table-hover">
        <thead>
            <tr>
                <th>STT</th>
                <th>Tên danh mục</th>
                <th>Trạng thái</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @php
                $stt=0;
            @endphp
            @foreach ($cats as $item)
                @php
                    $stt++;
                @endphp
                <tr>
                    <td>{{ $stt }}</td>
                    <td>{{ $item -> name }}</td>
                    <td>{{ $item -> status == 0 ? 'Ẩn' : 'Hiển thị' }}</td>
                    <td>
                        <form action="{{ route('category.destroy', $item->id) }}" method="post">
                            @csrf @method('DELETE')
                            <a href="{{ route('category.edit', $item->id) }}" class="btn btn-sm btn-warning"><i class="bi bi-pencil-square"></i> Sửa</a>
                            <button class="btn btn-sm btn-danger" onclick="return confirm('Bạn có muốn xóa {{ $item->name }}')"><i class="bi bi-trash"></i> Xóa</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $cats->links() }}
@endsection