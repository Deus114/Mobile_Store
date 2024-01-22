@extends('index')
@section('content')
    <div class="display">
        <div class="row">
            <aside class="col-sm-3">
                <h3>Danh mục sản phẩm</h3>
                <ul class="list-group">
                    @foreach ($cats as $item)
                        @if ($item->status == 1)
                        <li class="list-group-item"><a href="" class="text-decoration-none">{{ $item->name }}</a></li>
                        @endif
                    @endforeach
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
                        <form action="" method="post">
                            <input type="hidden" name="idsp" value="">
                            <input class=" buy btn btn-primary respo" type="submit" name="addcart" value="Thêm vào giỏ hàng">
                        </form>
                    </div>
                </div>
                <div class="col-12" style="margin-top: 25px;">
                    <h3>Thông tin chi tiết:</h3>
                    <div class="des">
                        <p>{{ $product->description }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div> 
@endsection