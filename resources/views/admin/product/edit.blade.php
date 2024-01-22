@extends('admin.index')
@section('content')
    <div class="bg-light d-flex align-items-center justify-content-center border rounded-3 p-1 p-sm-3 m-2 m-sm-4">
        <h2>CHỈNH SỬA SẢN PHẨM</h2>
    </div>
    <div class="crud">
        <form action="{{ route('product.update', $product->id) }}" method="post" role="form" enctype="multipart/form-data">
            @csrf @method('PUT')
            <div class="row">
                <div class="col-md-9">
                    <div class="form-group">
                        <h5>Tên sản phẩm</h5>
                        <input type="text" class="form-control" name="name" value="{{ $product->name }}">
                        @error('name')
                            <span class="errtext">{{ $message }}</span>
                        @enderror
                    </div>
                    <br>
                    <div class="form-group">
                        <h5>Giá</h5>
                        <input type="text" class="form-control" name="price" value="{{ $product->price }}">
                        @error('price')
                            <span class="errtext">{{ $message }}</span>
                        @enderror
                    </div>
                    <br>
                    <div class="form-group">
                        <h5>Giới thiệu</h5>
                        <textarea class="form-control" name="content">{{ $product->content }}</textarea>
                        @error('content')
                            <span class="errtext">{{ $message }}</span>
                        @enderror
                    </div>
                    <br>
                    <div class="form-group">
                        <h5>Mô tả</h5>
                        <textarea class="form-control" name="description">{{ $product->description }}</textarea>
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
                    <img src="/uploads/products/{{ $product -> image }}" alt="{{ $product -> name }}" width="50%">
                    <div class="form-group">
                        <h5>Trạng thái</h5>
                        <div class="radio">
                            <label>
                                <input type="radio" name="status" value="1" {{ $product->status == 1 ? 'checked' : '' }}>
                                Hiển thị
                            </label>
                        </div>
                        <div class="radio">
                            <label>
                                <input type="radio" name="status" value="0" {{ $product->status == 0 ? 'checked' : '' }}>
                                Ẩn
                            </label>
                        </div>
                    </div>
                    <br>
                    <div class="form-group">
                        <h5>Danh mục sản phẩm</h5>
                        <select name="category_id">
                            @foreach ($cats as $item)
                                <option value="{{ $item->id }}"{{ $product->category_id == $item->id ? 'selected' : '' }}>{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <br>
                    <button type="submit" class="btn btn-success crud-btn">Xác nhận</button>
                </div>
            </div>
        </form>
    </div>
@endsection