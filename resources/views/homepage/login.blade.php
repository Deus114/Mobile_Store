@extends('index')
@section('content')
    <div class="col-md-4 col-md-offset-4 login">
        <form action="" method="post" role="form">
            @csrf
            @if ($message = Session::get('success'))
                <div class="alert alert-success alert-block" id="xclik">
                    <button type="button" class="close" data-dismiss="alert" onclick="disable()">×</button>	
                        <strong>{{ $message }}</strong>
                </div>
            @endif
            <legend class="formname">Đăng nhập</legend>
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
                @if(session()->has('erro'))
                    <span class="errtext">{{ session('erro')}}</span>
                @endif
                @error('password')
                    <span class="errtext">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input">
                <label class="form-check-label">Ghi nhớ đăng nhập</label>
            </div>
            <button type="submit" class="btn btn-primary">Đăng nhập</button>
            <a href="{{ route('register') }}">Đăng kí</a>
        </form>
    </div>
@endsection