@extends('index')
@section('content')
<!-- Begin Content -->
    <div class="content row">
        <div class="col-sm-3 cat">
            <div class="row">
                <aside>
                    <h3 class="asi">DANH MỤC SẢN PHẨM</h3>
                    <ul class="list-group">
                        @foreach ($cats as $item)
                            @if ($item->status == 1)
                            <li class="list-group-item"><a href="" class="ellipsis">{{ $item->name }}</a></li>
                            @endif
                        @endforeach
                    </ul>
                </aside>
            </div> <br>
            <div class="row">
                <aside>
                    <h3 class="asi">SẢN PHẨM BÁN CHẠY <i class="bi bi-fire"></i></h3>
                    <ul class="list-group sellprd">
                        @foreach ($buys as $item)
                            @if ($item->status == 1)
                            <li class="list-group-item">
                                <div class="row">
                                    <div class="col-md-5">
                                        <a href="{{ route('home.detail', $item->id) }}">
                                            <img class="prdimg" src="/uploads/products/{{ $item->image }}" alt="{{ $item->name }}" width="100%">
                                        </a>
                                    </div>
                                    <div class="col-md-7">
                                        <div class="row">
                                            <a href="{{ route('home.detail', $item->id) }}" class="ellipsis">{{ $item->name }}</a>
                                        </div> <br>
                                        <div class="row">
                                            <p class="errtext">{{ number_format($item->price) }}đ</p>
                                        </div>
                                        <div class="row">
                                            <form action="" method="post">
                                                <input class="btn-primary btn sellprdbtn" type="submit" name="addcart" value="Mua ngay">
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            @endif
                        @endforeach
                    </ul>
                </aside>
            </div>
        </div>
        <div class="col-sm-8 homeprd">
            <div class="row">
                <div class="slider">
                    @foreach ($banners as $item)
                        @if ($item->status == 1)
                            <div>
                                <img src="/uploads/banners/{{ $item->image }}" alt="Image 1" width="100%">
                            </div>
                        @endif
                    @endforeach
                </div>
            </div> <br>
            <h4>SẢN PHẨM NỔI BẬT</h4>
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
                            $count-0;        
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
                            <form action="" method="post">
                                <input class="btn btn-primary res" type="submit" name="addcart" value="Thêm giỏ hàng">
                            </form>
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
<!-- End Content -->
@endsection