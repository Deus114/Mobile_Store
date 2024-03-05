@extends('admin.index')

@section('content')

    <div class="bg-light d-flex align-items-center justify-content-center border rounded-3 p-1 p-sm-3 m-2 m-sm-4">
        <h2>QUẢN LÍ TÀI KHOẢN</h2>
    </div>
    <table class="table table-hover">
        <thead>
            <tr>
                <th>STT</th>
                <th>Họ và tên</th>
                <th>Email</th>
                <th>Địa chỉ</th>
                <th>SĐT</th>
                <th>Quyền</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $item)
                <tr>
                    <td>{{ $loop->index+1 }}</td>
                    <td>{{ $item->name}}</td>
                    <td>{{ $item->email  }}</td>
                    <td>{{ $item->address  }}</td>
                    <td>{{ $item->phone  }}</td>
                    <td>{{ $item->role == 0 ? "User" : "Admin"  }}</td>
                    <td>
                        <form action="{{ route('user.destroy', $item->id) }}" method="post">
                            @csrf @method('DELETE')
                            @if ($item->role == 0)
                                <a href="{{ route('user.promote', $item->id) }}" class="btn btn-sm btn-success" onclick="return confirm('Bạn thăng chức {{ $item->name }} thành Admin?')">Admin</a> <br>
                            @else
                            <a href="{{ route('user.demote', $item->id) }}" class="btn btn-sm btn-warning" onclick="return confirm('Bạn muốn chuyển {{ $item->name }} thành User?')">User</a> <br>
                            @endif
                            <button class="btn btn-sm btn-danger" onclick="return confirm('Bạn có muốn xóa {{ $item->name }} ?')"><i class="bi bi-trash"></i> Xóa</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $users->links() }}
@endsection