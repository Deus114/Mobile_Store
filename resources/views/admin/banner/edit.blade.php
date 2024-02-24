@extends('admin.index')

@section('content')
    <div class="bg-light d-flex align-items-center justify-content-center border rounded-3 p-1 p-sm-3 m-2 m-sm-4">
        <h2>THÊM BANNER</h2>
    </div>
    <div class="crud">
        <form action="{{ route('banner.update', $banner->id) }}" method="post" role="form" enctype="multipart/form-data">
            @csrf @method('PUT')
            <div class="row">
                <div class="col-md-9">
                    <div class="form-group">
                        <h5>Nội dung</h5>
                        <textarea class="form-control" name="content" placeholder="Nhập nội dung">{{ $banner->content }}</textarea>
                        @error('content')
                            <span class="errtext">{{ $message }}</span>
                        @enderror
                    </div>
                    <br>
                    <div class="form-group">
                        <h5>Ưu tiên</h5>
                        <div class="radio">
                            <label>
                                <input type="radio" name="priority" value="0" {{ $banner->priority == 0 ? 'checked' : '' }}>
                                0
                            </label>
                        </div>
                        <div class="radio">
                            <label>
                                <input type="radio" name="priority" value="1" {{ $banner->priority == 1 ? 'checked' : '' }}>
                                1
                            </label>
                        </div>
                        <div class="radio">
                            <label>
                                <input type="radio" name="priority" value="2" {{ $banner->priority == 2 ? 'checked' : '' }}>
                                2
                            </label>
                        </div>
                        <div class="radio">
                            <label>
                                <input type="radio" name="priority" value="3" {{ $banner->priority == 3 ? 'checked' : '' }}>
                                3
                            </label>
                        </div>
                        <div class="radio">
                            <label>
                                <input type="radio" name="priority" value="4" {{ $banner->priority == 4 ? 'checked' : '' }}>
                                4
                            </label>
                        </div>
                    </div>
                    <br>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <h5>Hình ảnh</h5>
                        <input type="file" name="image" class="form-control">
                        <img src="/uploads/banners/{{ $banner -> image }}" alt="{{ $banner -> name }}" width="50%">
                        @error('image')
                            <span class="errtext">{{ $message }}</span>
                        @enderror
                    </div>
                    <br>
                    <div class="form-group">
                        <h5>Trạng thái</h5>
                        <div class="radio">
                            <label>
                                <input type="radio" name="status" value="1" {{ $banner->status == 1 ? 'checked' : '' }}>
                                Hiển thị
                            </label>
                        </div>
                        <div class="radio">
                            <label>
                                <input type="radio" name="status" value="0" {{ $banner->status == 0 ? 'checked' : '' }}>
                                Ẩn
                            </label>
                        </div>
                    </div>
                    <br>
                    <button type="submit" class="btn btn-success crud-btn">Chỉnh sửa</button>
                </div>
            </div>
        </form>
    </div>
@endsection