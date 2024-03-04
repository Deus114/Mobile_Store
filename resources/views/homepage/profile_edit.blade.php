@extends('index')
@section('content')
    <div class="col-md-4 col-md-offset-4 updateinfo">
        <form action="" method="post" role="form">
            @csrf
            <legend class="formname">Chỉnh sửa thông tin cá nhân</legend>
            <div class="mb-3">
                <label class="form-label">Họ và tên</label>
                <input type="text" class="form-control" name="name" value="{{ Auth::user()->name }}">
                @error('name')
                    <span class="errtext">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" class="form-control" name="email" aria-describedby="emailHelp" value="{{ Auth::user()->email }}">
                @error('email')
                    <span class="errtext">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-3">
                <label class="form-label">Nhập mật khẩu cũ</label>
                <input type="password" class="form-control" name="password">
                @error('password')
                    <span class="errtext">{{ $message }}</span>
                @enderror
                @if(session()->has('erro'))
                    <span class="errtext">{{ session('erro')}}</span>
                @endif
            </div>
            <div class="mb-3">
                <label class="form-label">Mật khẩu mới</label>
                <input type="password" class="form-control" name="newpassword">
                @error('newpassword')
                    <span class="errtext">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-3">
                <label class="form-label">Số điện thoại</label>
                <input type="text" class="form-control" name="phone" value="{{ Auth::user()->phone }}">
                @error('phone')
                    <span class="errtext">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-3">
                <label class="form-label">Địa chỉ</label>
                <input type="text" class="form-control" name="address" value="{{ Auth::user()->address }}">
                @error('address')
                    <span class="errtext">{{ $message }}</span>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Chỉnh sửa</button>
        </form>
    </div>
@endsection