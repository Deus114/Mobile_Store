@extends('index')
@section('content')
    <div class="display">
        <div class="row">
            <aside class="col-sm-3 cat">
                <h3 class="asi">DANH MỤC SẢN PHẨM</h3>
                <ul class="list-group">
                    @foreach ($cats as $item)
                        @if ($item->status == 1)
                        <li class="list-group-item"><a href="{{ route('product_by_category', $item->id) }}" class="ellipsis">{{ $item->name }}</a></li>
                        @endif
                    @endforeach
                    <li class="list-group-item"><a href="{{ route('product_all') }}" class="ellipsis">Tất cả</a></li>
                </ul>
            </aside>
            <div class="col-sm-9">
                <div class="row">
                    <div class="col">
                        <div class="box-large">
                            <div class="box-top">
                            <img id="img-large" class="img-fluid" src="/uploads/products/{{ $product->image }}" alt="{{ $product->name }}">
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <h2>{{ $product->name }}</h2>
                        <br>
                        <h3>Giá bán: {{ number_format($product->price) }}đ</h3>
                        <br>
                        <h4>Mô tả:</h4>
                        <p>{{ $product->content }}</p>
                        @if (Auth::check())
                            <a href="{{ route('usercart.add', $product->id) }}" class="btn btn-danger respo">Mua ngay</a>
                        @else
                            <a href="{{ route('onlinecart.add', $product->id) }}" class="btn btn-danger respo">Mua ngay</a>
                        @endif
                    </div>
                </div>
                <div class="col-12" style="margin-top: 25px;">
                    <h3>Thông tin chi tiết:</h3>
                    <div class="des">
                        <p>{{ $product->description }}</p>
                    </div>
                </div>
                <br>
                <div class="binhluan">
                    <div class="mgl inbl">
                        <h3>Bình luận</h3>
                        <hr>
                        <div class="mgl">
                            @foreach ($comments as $item)
                                <div class="row">
                                    <div class="col">
                                        <h5><i class="bi bi-person"></i> {{ $item->email }} </h5>
                                        <span style="opacity: 0.5;">{{ $item->created_at }}</span>
                                        <br>
                                        <p>{{ $item->content }}</p>
                                    </div>
                                    @if ($item->user_id == Auth::user()->id)
                                        <div class="col">
                                            <a href="{{ route('home.del_cmt', $item->id) }}" class="btn btn-sm btn-danger">Xóa</a>
                                        </div>
                                    @endif
                                </div>
                            @endforeach
                            <hr>
                            {{ $comments->links() }}
                            @if (Auth::check())
                                <form action="" method="post" role="form">
                                    @csrf
                                    <label for="comment" class="form-label">Nhập bình luận:</label>
                                    <textarea class="form-control input noidung" name="content" require></textarea> <br>
                                    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                                    <input type="hidden" name="email" value="{{ Auth::user()->email }}">
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                    <input type="hidden" name="product_name" value="{{ $product->name }}">
                                    <input class="btn btn-primary" type="submit" name="guibl" value="Gửi">
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> 
@endsection