@extends('admin.index')

@section('content')
    <div class="bg-light d-flex align-items-center justify-content-center border rounded-3 p-1 p-sm-3 m-2 m-sm-4">
        <h2>THÊM BANNER</h2>
    </div>
    <div class="crud">
        <form action="{{ route('banner.store') }}" method="post" role="form" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-9">
                    <div class="form-group">
                        <h5>Nội dung</h5>
                        <textarea class="form-control" name="content" placeholder="Nhập nội dung"></textarea>
                        @error('content')
                            <span class="errtext">{{ $message }}</span>
                        @enderror
                    </div>
                    <br>
                    <div class="form-group">
                        <h5>Ưu tiên</h5>
                        <div class="radio">
                            <label>
                                <input type="radio" name="priority" value="0" checked>
                                0
                            </label>
                        </div>
                        <div class="radio">
                            <label>
                                <input type="radio" name="priority" value="1">
                                1
                            </label>
                        </div>
                        <div class="radio">
                            <label>
                                <input type="radio" name="priority" value="2">
                                2
                            </label>
                        </div>
                        <div class="radio">
                            <label>
                                <input type="radio" name="priority" value="3">
                                3
                            </label>
                        </div>
                        <div class="radio">
                            <label>
                                <input type="radio" name="priority" value="4">
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
                        @error('image')
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
                </div>
            </div>
        </form>
    </div>
@endsection