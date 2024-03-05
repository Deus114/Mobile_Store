@extends('index')
@section('content')
    <a href="{{ route('usercart.view') }}" class="non-dec">< Giỏ hàng</a>
    <br></br>
    <h2>Lịch sử mua hàng</h2>
    <hr>
    <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col">STT</th>
                <th scope="col">Mã ĐH</th>
                <th scope="col">Nội dung</th>
                <th scope="col">Email</th>
                <th scope="col">Địa chỉ</th>
                <th scope="col">SĐT</th>
                <th scope="col">SL</th>
                <th scope="col">TT</th>
                <th scope="col">Ngày mua</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($order as $item)
                <tr>
                    <td>{{ $loop->index + 1 }}</td>
                    <td>{{ $item->code }}</td>
                    <td>{{ $item->content }}</td>
                    <td>{{ $item->email }}</td>
                    <td>{{ $item->address }}</td>
                    <td>{{ $item->phone }}</td>
                    <td>{{ $item->totalQuantity }}</td>
                    <td>{{ $item->totalPrice }}</td>
                    <td>{{ $item->created_at }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection