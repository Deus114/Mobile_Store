@extends('index')
@section('content')

    @if (Session::has('ok'))
        <div class="alert alert-success" role="alert" id="alert">
            <h3>Thông báo:</h3>
            <p>{{ Session::get('ok') }}</p>
        </div>  
    @endif
    
    <a href="{{ route('home') }}" class="non-dec">< Tiếp tục mua hàng</a>
    <br></br>
    <a href="{{ route('usercart.history') }}" class="non-dec">Lịch sử mua hàng</a>
    <br></br>
    <h2>Giỏ hàng của bạn</h2>
    <hr>
    <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col">STT</th>
                <th scope="col">Tên sản phẩm</th>
                <th scope="col">Hình ảnh</th>
                <th scope="col">Giá</th>
                <th scope="col">Số lượng</th>
                <th scope="col">Thành tiền</th>
                <th scope="col">Xóa</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($usercart as $item)
                <tr>
                    <td>{{ $loop->index + 1 }}</td>
                    <td>{{ $item->name }}</td>
                    <td><img src="/uploads/products/{{ $item->image }}" alt="{{ $item->name }}" width="40"></td>
                    <td>{{ number_format($item->price) }}đ</td>
                    <td><a href="{{ route('usercart.down', $item->product_id) }}" class="none-dec">-</a> {{ $item->quantity }} <a href="{{ route('usercart.up', $item->product_id) }}" class="none-dec">+</a></td>
                    <td>{{ number_format($item->price*$item->quantity) }}đ</td>
                    <td><a href="{{ route('usercart.delete', $item->product_id) }}" class="btn btn-danger btn-sm"><i class="bi bi-trash"></i> Xóa</a></td>
                </tr>
            @endforeach
            <tr>
                <th colspan="4"></th>
                <th >Tổng số lượng:</th>
                <th colspan="2">{{ $totalQuantity }} (sản phẩm)</th>
            </tr>
            <tr>
                <th colspan="4"></th>
                <th >Tổng tiền:</th>
                <th colspan="2">{{ number_format($totalPrice )}} đ</th>
            </tr>
        </tbody>
    </table>
    @if ($totalQuantity > 0)
        <a href="{{ route('usercart.buy') }}" class="btn btn-success">Mua hàng</a>
    @endif
@endsection