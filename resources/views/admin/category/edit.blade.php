@extends('admin.index')
@section('content')
    <div class="bg-light d-flex align-items-center justify-content-center border rounded-3 p-1 p-sm-3 m-2 m-sm-4">
        <h2>CHỈNH SỬA DANH MỤC SẢN PHẨM</h2>
    </div>
    <div class="col-md-4 crud">
        <form action="{{ route('category.update', $category->id) }}" method="post" role="form">
            @csrf @method('PUT')
            <div class="form-group">
                <h5>Tên danh mục</h5>
                <input type="text" class="form-control" name="name" value="{{ $category->name }}">
                @error('name')
                    <span class="errtext">{{ $message }}</span>
                @enderror
            </div>
            <br>
            <div class="form-group">
                <h5>Trạng thái</h5>
                <div class="radio">
                    <label>
                        <input type="radio" name="status" value="1" {{ $category->status == 1 ? 'checked' : '' }}>
                        Hiển thị
                    </label>
                </div>
                <div class="radio">
                    <label>
                        <input type="radio" name="status" value="0" {{ $category->status == 0 ? 'checked' : '' }}>
                        Ẩn
                    </label>
                </div>
            </div>
            <br>
            <button type="submit" class="btn btn-success crud-btn">Chỉnh sửa</button>
        </form>
    </div>
@endsection