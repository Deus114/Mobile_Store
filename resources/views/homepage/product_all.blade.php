@extends('index')
@section('content')
    <div class="content row">
        <div class="col-sm-3 cat">
            <aside>
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
        </div>
        <div class="col-sm-8 homeprd">
            <div class="row">
                <div class="col">
                    <h4 class="modal-title">Tất cả sản phẩm</h4> 
                </div>
                <div class="col">
                    <div class="dropdown">
                        <a class="btn dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                            Sắp xếp theo giá
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                            <li class="dropdown-item"><a class="text-decoration-none" href="{{ route('product_all_price', 1) }}">Giảm dần</a></li>
                            <li class="dropdown-item"><a class="text-decoration-none" href="{{ route('product_all_price', 2) }}">Tăng dần</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            @php
                $count=0;        
            @endphp
            <div class="row justify-content-start">
            @foreach ($products as $item)
                @if ($item->status == 1)
                    @if ($count==4)
                        </div>
                        <div class="row justify-content-start">
                        @php
                            $count=0;        
                        @endphp
                    @endif
                    <div class="card col-sm-3">
                        <div>
                            <a href="{{ route('home.detail', $item->id) }}">
                                <img class="rounded mx-auto d-block prdimg" src="/uploads/products/{{ $item->image }}" style="width:90%">
                            </a>
                        </div>
                            <a href="{{ route('home.detail', $item->id) }}" class="card-text ellipsis">{{ $item->name }}</a>
                        <div class="card-body">
                            <p class="card-text errtext">{{ number_format($item->price) }}đ</p>
                            @if (Auth::check())
                                <a href="{{ route('usercart.add', $item->id) }}" class="btn btn-primary res">Thêm giỏ hàng</a>
                            @else
                                <a href="{{ route('onlinecart.add', $item->id) }}" class="btn btn-primary res">Thêm giỏ hàng</a>
                            @endif
                        </div>
                    </div>
                    @php
                        $count++;        
                    @endphp
                @endif
            @endforeach
            </div>
        </div>
    </div>
@endsection