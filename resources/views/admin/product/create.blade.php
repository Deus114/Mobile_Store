@extends('admin.index')
@section('content')
    <div class="bg-light d-flex align-items-center justify-content-center border rounded-3 p-1 p-sm-3 m-2 m-sm-4">
        <h2>THÊM SẢN PHẨM</h2>
    </div>
    <div class="crud">
        <form action="{{ route('product.store') }}" method="post" role="form" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-9">
                    <div class="form-group">
                        <h5>Tên sản phẩm</h5>
                        <input type="text" class="form-control" name="name" placeholder="Nhập tên sản phẩm">
                        @error('name')
                            <span class="errtext">{{ $message }}</span>
                        @enderror
                    </div>
                    <br>
                    <div class="form-group">
                        <h5>Giá</h5>
                        <input type="text" class="form-control" name="price" placeholder="Nhập giá">
                        @error('price')
                            <span class="errtext">{{ $message }}</span>
                        @enderror
                    </div>
                    <br>
                    <div class="form-group">
                        <h5>Giới thiệu</h5>
                        <textarea class="form-control" name="content" placeholder="Nhập giới thiệu sản phẩm"></textarea>
                        @error('content')
                            <span class="errtext">{{ $message }}</span>
                        @enderror
                    </div>
                    <br>
                    <div class="form-group">
                        <h5>Mô tả</h5>
                        <textarea class="form-control" name="description" placeholder="Nhập mô tả"></textarea>
                        @error('description')
                            <span class="errtext">{{ $message }}</span>
                        @enderror
                    </div>
                    <br>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <h5>Hình ảnh</h5>
                        <input type="file" name="image" class="form-control">
                        @error('content')
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
                    <div class="form-group">
                        <h5>Danh mục sản phẩm</h5>
                        <select name="category_id">
                            @foreach ($cats as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <br>
                    <button type="submit" class="btn btn-success crud-btn">Thêm mới</button>
                </div>
            </div>
        </form>
    </div>
@endsection