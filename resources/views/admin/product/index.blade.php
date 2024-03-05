@extends('admin.index')

@section('content')

    <div class="bg-light d-flex align-items-center justify-content-center border rounded-3 p-1 p-sm-3 m-2 m-sm-4">
        <h2>SẢN PHẨM</h2>
    </div>
    <a href="{{ route('product.create') }}" class="btn btn-success"><i class="bi bi-plus"></i> Thêm mới</a>
    <a class="btn dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
        Sắp xếp theo lượt xem
    </a>
    <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
        <li class="dropdown-item"><a class="text-decoration-none" href="{{ route('product.watch', 1) }}">Giảm dần</a></li>
        <li class="dropdown-item"><a class="text-decoration-none" href="{{ route('product.watch', 2) }}">Tăng dần</a></li>
    </ul>
    <a class="btn dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
        Sắp xếp theo lươt mua
    </a>
    <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
        <li class="dropdown-item"><a class="text-decoration-none" href="{{ route('product.buy', 1) }}">Giảm dần</a></li>
        <li class="dropdown-item"><a class="text-decoration-none" href="{{ route('product.buy', 2) }}">Tăng dần</a></li>
    </ul>
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
                            <a href="{{ route('product.edit', $item->id) }}" class="btn btn-sm btn-warning"><i class="bi bi-pencil-square"></i> Sửa</a>
                            <button class="btn btn-sm btn-danger" onclick="return confirm('Bạn có muốn xóa {{ $item->name }}')"><i class="bi bi-trash"></i> Xóa</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $products->links() }}
@endsection