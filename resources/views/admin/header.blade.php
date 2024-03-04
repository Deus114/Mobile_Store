<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
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
            <a href="{{ route('category.index') }}" style="--i:1;">Category</a> 
            <a href="{{ route('product.index') }}" style="--i:2;">Products</a> 
            {{-- <a href="" style="--i:3;">Comments</a>  --}}
            {{-- <a href="" style="--i:4;">Footer</a> --}}
            {{-- <a href="" style="--i:5;">Accounts</a>  --}}
            {{-- <a href="" style="--i:6;">Orders</a>  --}}
            <a href="{{ route('banner.index') }}" style="--i:7;">Banners</a> 
            <a href="{{ route('admin.logout') }}" style="--i:8;">Log out</a>
        </nav>
    </header>
    <div class="container">