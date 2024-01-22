@extends('admin.index')

@section('content')

    <div class="bg-light d-flex align-items-center justify-content-center border rounded-3 p-1 p-sm-3 m-2 m-sm-4">
        <h2>DANH MỤC SẢN PHẨM</h2>
    </div>
    <a href="{{ route('product.create') }}" class="btn btn-success">Thêm mới</a>
    <table class="table table-hover">
        <thead>
            <tr>
                <th>STT</th>
                <th>Tên sản phẩm</th>
                <th>Hình ảnh</th>
                <th>Giá</th>
                <th>Giới thiệu</th>
                <th>Mô tả</th>
                <th>Danh mục</th>
                <th>Trạng thái</th>
                <th>Lượt mua</th>
                <th>Lượt xem</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @php
                $stt=0;
            @endphp
            @foreach ($products as $item)
                @php
                    $stt++;
                @endphp
                <tr>
                    <td>{{ $stt }}</td>
                    <td>{{ $item -> name }}</td>
                    <td>
                        <img src="/uploads/products/{{ $item -> image }}" alt="{{ $item -> name }}" width="60">
                    </td>
                    <td>{{ number_format($item -> price) }}đ</td>
                    <td>{{ $item -> content }}</td>
                    <td>{{ $item -> description }}</td>
                    <td>{{ $item->cat->name }}</td>
                    <td>{{ $item -> status == 0 ? 'Ẩn' : 'Hiển thị' }}</td>
                    <td>{{ $item -> buy }}</td>
                    <td>{{ $item -> watch }}</td>
                    <td>
                        <form action="{{ route('product.destroy', $item->id) }}" method="post">
                            @csrf @method('DELETE')
                            <br>
                            <a href="{{ route('product.edit', $item->id) }}" class="btn btn-sm btn-warning">Sửa</a>
                            <button class="btn btn-sm btn-danger" onclick="return confirm('Bạn có muốn xóa {{ $item->name }}')">Xóa</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $products->links() }}
@endsection