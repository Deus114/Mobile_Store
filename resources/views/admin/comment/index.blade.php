@extends('admin.index')

@section('content')

    <div class="bg-light d-flex align-items-center justify-content-center border rounded-3 p-1 p-sm-3 m-2 m-sm-4">
        <h2>QUẢN LÍ BÌNH LUẬN</h2>
    </div>
    <table class="table table-hover">
        <thead>
            <tr>
                <th>STT</th>
                <th>Email</th>
                <th>Tên sản phẩm</th>
                <th>Nội dung</th>
                <th>Ngày gửi</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($comments as $item)
                <tr>
                    <td>{{ $loop->index+1 }}</td>
                    <td>{{ $item->email  }}</td>
                    <td>{{ $item->product_name  }}</td>
                    <td>{{ $item->content}}</td>
                    <td>{{ $item->created_at  }}</td>
                    <td>
                        <form action="{{ route('comment.destroy', $item->id) }}" method="post">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-danger" onclick="return confirm('Bạn có muốn xóa?')"><i class="bi bi-trash"></i> Xóa</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $comments->links() }}
@endsection