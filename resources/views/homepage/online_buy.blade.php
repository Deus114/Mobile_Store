@extends('index')
@section('content')
    <a href="{{ route('onlinecart.view') }}" class="non-dec">< Giỏ hàng</a>
    <br></br>
    <div class="row">
        <div class="col">
            <h2>Đơn hàng của bạn</h2>
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
                    </tr>
                </thead>
                <tbody>
                    @foreach ($onlinecart->items as $item)
                        <tr>
                            <td>{{ $loop->index + 1 }}</td>
                            <td>{{ $item->name }}</td>
                            <td><img src="/uploads/products/{{ $item->image }}" alt="{{ $item->name }}" width="40"></td>
                            <td>{{ number_format($item->price) }}đ</td>
                            <td>{{ $item->quantity }}</td>
                            <td>{{ number_format($item->price*$item->quantity) }}đ</td>
                        </tr>
                    @endforeach
                    <tr>
                        <th colspan="4"></th>
                        <th >Tổng số lượng:</th>
                        <th colspan="2">{{ $onlinecart->totalQuantity }} (sản phẩm)</th>
                    </tr>
                    <tr>
                        <th colspan="4"></th>
                        <th >Tổng tiền:</th>
                        <th colspan="2">{{ number_format($onlinecart->totalPrice) }}đ</th>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="col">
            <h2>Thông tin mua hàng</h2>
            <hr>
            <form action="" method="post" role="form">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Họ và tên</label>
                    <input type="text" class="form-control" name="name">
                    @error('name')
                        <span class="errtext">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" class="form-control" name="email" aria-describedby="emailHelp">
                    @error('email')
                        <span class="errtext">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label">Số điện thoại</label>
                    <input type="text" class="form-control" name="phone">
                    @error('phone')
                        <span class="errtext">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label">Địa chỉ</label>
                    <input type="text" class="form-control" name="address">
                    @error('address')
                        <span class="errtext">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label">Phương thức thanh toán: </label>
                    <select name="payment" require>
                        <option value="1" selected>Thanh toán khi nhận hàng</option>
                        <option value="2">Thanh toán qua ví MOMO</option>
                        <option value="3">Thanh toán qua VNPAY</option>
                        <option value="4">Thanh toán bằng chuyển khoản ngân hàng</option>
                    </select>
                </div>
                @php
                    $content = "";
                @endphp
                @foreach ($onlinecart->items as $item)
                    @php
                        $content = $content . $item->name . "*" . $item->quantity . " . ";
                    @endphp
                @endforeach
                <input type="hidden" name="content" value="{{ $content }}">
                <input type="hidden" name="totalQuantity" value="{{ $onlinecart->totalQuantity }}">
                <input type="hidden" name="totalPrice" value="{{ $onlinecart->totalPrice }}">
                <button type="submit" class="btn btn-success">Đặt hàng</button>
            </form>
        </div>
    </div>
@endsection