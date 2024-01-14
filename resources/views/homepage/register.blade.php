@extends('index')
@section('content')
    <div class="col-md-4 col-md-offset-4 login">
        <form action="" method="post" role="form">
            @csrf
            <legend class="formname">Đăng kí</legend>
            <div class="mb-3">
                <label class="form-label">Họ và tên</label>
                <input type="text" class="form-control" name="name">
                @error('name')
                    <span class="errtext">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" class="form-control" name="email" aria-describedby="emailHelp">
                @error('email')
                    <span class="errtext">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-3">
                <label class="form-label">Mật Khẩu</label>
                <input type="password" class="form-control" name="password">
                @error('password')
                    <span class="errtext">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-3">
                <label class="form-label">Nhập lại mật khẩu</label>
                <input type="password" class="form-control" name="repassword">
                @error('repassword')
                    <span class="errtext">{{ $message }}</span>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Đăng kí</button>
            <a href="{{ route('login') }}">Đăng nhập</a>
        </form>
    </div>
@endsection