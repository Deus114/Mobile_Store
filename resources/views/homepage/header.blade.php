<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Mobile Store - Địa chỉ tin cậy để mua sắm điện thoại di động chất lượng với mức giá cạnh tranh. Chuyên các dòng máy của Samsung, Iphone, Xiaomi.">
    <title>Mobile Store - Điện thoại chính hãng</title>
    <link rel="stylesheet" href="{{ asset('asset') }}/css/homepage.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css"/>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css"/>
</head>
<body>
  <header>
        <!-- Begin Nav -->
        <nav class="navbar navbar-expand-lg bg-blue"> 
          <div class="container-fluid">
            <img class="nav-content logo" src="/uploads/logo/logo.png" alt="Mobile Store" width="5%">
            <form class="d-flex search">
              <input class="form-control me-2 sear" type="search" placeholder="Tìm kiếm" aria-label="Search">
              <button class="btn btn-search" type="submit">Search</button>
            </form>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"> 
              <span class="navbar-toggler-icon"></span> 
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <ul class="navbar-nav me-auto">
                <li class="nav-item active"> <a class="nav-link white" href="{{ route('home') }}">Trang chủ</a> </li>
                <li class="nav-item"> <a class="nav-link white" href="#info">Liên hệ</a> </li>
                <li class="nav-item"> <a class="nav-link white" href="#info">Giới thiệu</a> </li>
                <li class="nav-item"> <a class="nav-link white" href="index.php?act=tintuc">Tin tức</a> </li>
                <li class="nav-item"> 
                <a class="nav-link white" href="{{ route('login') }}">Đăng nhập</a>
                </li>
                <li class="nav-item">
                <a class="nav-link white" href="{{ route('register') }}">Đăng Kí</a>
                </li>
                <li class="nav-item"><a class="nav-link white" href="index.php?act=cart">Giỏ hàng</a> </li>
              </ul>
            </div>
          </div>
        </nav>
        <!-- End Nav -->
  </header>
        
        <div class="container">