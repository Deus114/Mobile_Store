@extends('admin.index')

@section('content')

    <div class="bg-light d-flex align-items-center justify-content-center border rounded-3 p-1 p-sm-3 m-2 m-sm-4">
        <h2>QUẢN LÍ ĐƠN HÀNG</h2>
    </div>
    <a href="{{ route('order.confirmed', 1) }}" class="btn btn-success">Đơn hàng đã xác nhận</a>
    <a href="{{ route('order.confirmed', 0) }}" class="btn btn-danger">Đơn hàng chưa xác nhận</a>
    <a href="{{ route('order.index') }}" class="btn btn-warning">Tất cả đơn hàng</a>
    <table class="table table-hover">
        <thead>
            <tr>
                <th>STT</th>
                <th>Mã ĐH</th>
                <th>Nội dung</th>
                <th>Họ và tên</th>
                <th>Email</th>
                <th>Địa chỉ</th>
                <th>SĐT</th>
                <th>SL</th>
                <th>TT</th>
                <th>PTTT</th>
                <th>Trạng thái</th>
                <th>Ngày mua</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($orders as $item)
                <tr>
                    <td>{{ $loop->index+1 }}</td>
                    <td>{{ $item->code  }}</td>
                    <td>{{ $item->content  }}</td>
                    <td>{{ $item->name}}</td>
                    <td>{{ $item->email  }}</td>
                    <td>{{ $item->address  }}</td>
                    <td>{{ $item->phone  }}</td>
                    <td>{{ $item->totalQuantity  }}</td>
                    <td>{{ $item->totalPrice  }}</td>
                    <td>{{ $item->payment  }}</td>
                    <td>{{ $item->created_at  }}</td>
                    <td>{{ $item->confirm == 0 ? "Chưa xác nhận" : "Đã xác nhận"  }}</td>
                    <td>
                        <form action="{{ route('order.destroy', $item->id) }}" method="post">
                            @csrf @method('DELETE')
                            @if ($item->confirm == 0)
                                <a href="{{ route('order.confirm', $item->id) }}" class="btn btn-sm btn-success">Xác nhận</a> <br>
                            @endif
                            <button class="btn btn-sm btn-danger" onclick="return confirm('Bạn có muốn xóa {{ $item->code }}')"><i class="bi bi-trash"></i> Xóa</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $orders->links() }}
@endsection