@extends('admin.index')
@section('content')
    <div class="bg-light d-flex align-items-center justify-content-center border rounded-3 p-1 p-sm-3 m-2 m-sm-4">
        <h2>THÊM DANH MỤC SẢN PHẨM</h2>
    </div>
    <div class="col-md-4 crud">
        <form action="{{ route('category.store') }}" method="post" role="form">
            @csrf
            <div class="form-group">
                <h5>Tên danh mục</h5>
                <input type="text" class="form-control" name="name" placeholder="Nhập tên danh mục">
                @error('name')
                    <span class="errtext">{{ $message }}</span>
                @enderror
            </div>
            <br>
            <div class="form-group">
                <h5>Trạng thái</h5>
                <div class="radio">
                    <label>
                        <input type="radio" name="status" value="1" checked>
                        Hiển thị
                    </label>
                </div>
                <div class="radio">
                    <label>
                        <input type="radio" name="status" value="0">
                        Ẩn
                    </label>
                </div>
            </div>
            <br>
            <button type="submit" class="btn btn-success crud-btn">Thêm mới</button>
        </form>
    </div>
@endsection