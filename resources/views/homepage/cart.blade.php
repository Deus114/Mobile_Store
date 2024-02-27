@extends('index')
@section('content')
    <a href="{{ route('home') }}" class="non-dec">< Tiếp tục mua hàng</a>
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
            @foreach ($cart->items as $item)
                <tr>
                    <td>{{ $loop->index + 1 }}</td>
                    <td>{{ $item->name }}</td>
                    <td><img src="/uploads/products/{{ $item->image }}" alt="{{ $item->name }}" width="40"></td>
                    <td>{{ number_format($item->price) }}đ</td>
                    @if (Auth::check())
                        
                    @else
                        <td><a href="{{ route('onlinecart.down', $item->id) }}" class="none-dec">-</a> {{ $item->quantity }} <a href="{{ route('onlinecart.up', $item->id) }}" class="none-dec">+</a></td> 
                    @endif
                    <td>{{ number_format($item->price*$item->quantity) }}đ</td>
                    @if (Auth::check())
                        <td><a href="" class="btn btn-danger btn-sm"><i class="bi bi-trash"></i> Xóa</a></td>
                    @else
                        <td><a href="{{ route('onlinecart.delete', $item->id) }}" class="btn btn-danger btn-sm"><i class="bi bi-trash"></i> Xóa</a></td>
                    @endif
                </tr>
            @endforeach
            <tr>
                <th colspan="4"></th>
                <th >Tổng số lượng:</th>
                <th colspan="2">{{ $cart->totalQuantity }} (sản phẩm)</th>
            </tr>
            <tr>
                <th colspan="4"></th>
                <th >Tổng tiền:</th>
                <th colspan="2">{{ number_format($cart->totalPrice) }}đ</th>
            </tr>
        </tbody>
    </table>
@endsection