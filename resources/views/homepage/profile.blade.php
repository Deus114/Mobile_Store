@extends('index')
@section('content')
     <!-- Thông tin cá nhân bắt đầu từ đây -->
     <div class="mmain-user-info">
        <h3>Thông tin cá nhân</h3>
        <br></br>
        <div class="row">
            <div class="col usf">
                <div class="row" ><p>Họ và tên:</p></div>
                <div class="row" ><p>Email:</p></div>
                <div class="row" ><p>Mật khẩu:</p></div>
                <div class="row" ><p>Điện thoại:</p></div>
                <div class="row" ><p>Địa chỉ:</p></div>
            </div>
            <div class="col">
                <div class="row"><p>{{ Auth::user()->name }}</p></div>
                <div class="row"><p>{{ Auth::user()->email }}</p></div>
                <div class="row"><p>**********</p></div>
                <div class="row"><p>{{ Auth::user()->phone }}</p></div>
                <div class="row"><p>{{ Auth::user()->address }}</p></div>
            </div>
        </div>
        <button type="button" class="btn btn-primary"><a class="add" href="{{ route('profile.edit') }}">Chỉnh sửa</a></button>
    </div>
</div>
@endsection