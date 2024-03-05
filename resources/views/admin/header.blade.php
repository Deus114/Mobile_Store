<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://cdn.datatables.net/1.13.8/css/dataTables.bootstrap5.min.css" rel='stylesheet'>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('asset') }}/css/styleadmin.css">
</head>
<body>
    <header class="header">
        <a class="non-dec" href="{{ route('admin.index') }}"><h1 class="logo">ADMIN</h1></a>
        <input type="checkbox" id="check">
        <label for="check" class="icons">
            <i class='bx bx-menu' id="menu-icon"></i>
            <i class='bx bx-x' id="close-icon"></i>
        </label>

        <nav class="heading">
            <a href="{{ route('category.index') }}" style="--i:1;">Danh mục</a> 
            <a href="{{ route('product.index') }}" style="--i:2;">Sản phẩm</a> 
            <a href="{{ route('comment.index') }}" style="--i:3;">Bình luận</a> 
            {{-- <a href="" style="--i:4;">Footer</a> --}}
            <a href="{{ route('user.index') }}" style="--i:5;">Người dùng</a> 
            <a href="{{ route('order.index') }}" style="--i:6;">Đơn hàng</a> 
            <a href="{{ route('banner.index') }}" style="--i:7;">Banners</a> 
            <a href="{{ route('admin.logout') }}" style="--i:8;">Log out <i class="bi bi-box-arrow-right"></i></a>
        </nav>
    </header>
    <div class="container">