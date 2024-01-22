@extends('index')
@section('content')
        <!-- Begin Content -->
    <div class="content row">
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
        <div class="col-sm-7 homeprd">
            <h2>Sản phẩm nổi bật</h2>
            @php
                $count=0;        
            @endphp
            <div class="row justify-content-start">
            @foreach ($products as $item)
                @if ($count==3)
                    </div>
                    <div class="row justify-content-start">
                    @php
                        $count-0;        
                    @endphp
                @endif
                <div class="card product col-4">
                    <a href="{{ route('home.detail', $item->id) }}"> <img class="rounded mx-auto d-block" src="/uploads/products/{{ $item->image }}" style="width:100%"> </a>
                    <div class="card-body">
                      <p class="card-text">{{ $item->name }}</p>
                      <p class="card-text">Giá:  {{ number_format($item->price) }}đ</p>
                      <form action="" method="post">
                        <input type="hidden" name="idsp" value="">
                        <input class="btn btn-primary res" type="submit" name="addcart" value="Thêm vào giỏ hàng">
                      </form>
                    </div>
                </div>
                @php
                    $count++;        
                @endphp
            @endforeach
            </div>
        </div>
    </div>
<!-- End Content -->
@endsection