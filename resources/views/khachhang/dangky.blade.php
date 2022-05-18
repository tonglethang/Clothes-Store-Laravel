<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('css/index.css') }}"  rel="stylesheet" type="text/css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <title>Đăng ký</title>
    <style>
        *{
            font-family: 'Roboto', sans-serif;
        }
        .form-tt{
            top: 70px;
            position: relative;
        }
        #re_pass{
            margin-top: -18px;
        }
        .error{
            background-color: #ff6183;
            font-size: 15px;
            width: 150%;
            position: relative;
            right: 55px;
            text-align: left;
        }
    </style>
</head>
<body>
    <div class="form-tt" id="login" style="display: block; border: 1px solid black; animation: none;">
        <h2>ĐĂNG KÝ</h2>
        <form action="/khachhang/dangky" method="post" enctype="multipart/form-data">
            @csrf
            <input type="text" name="name" placeholder="Họ và tên" required="required" />
            <input type="text" name="email" placeholder="Email" required="required" />
            <input type="number" name="SDT" placeholder="Số điện thoại" required="required" />
            <input type="text" name="diachi" placeholder="Địa chỉ" required="required" />
            <input type="text" name="user_name" placeholder="Tên đăng nhập" required="required" />
            <input type="password" name="pass" placeholder="Mật khẩu" required="required" />
            <input type="password" name="re_pass" placeholder="Nhập lại mật khẩu" required="required" id="re_pass" />
            @if (session('message1') || session('message2') || session('message3') || session('message4'))
            <div class="alert alert-success">
                <p>{{ session('message1') }}</p>
                <p>{{ session('message2') }}</p>
                <p>{{ session('message3') }}</p>
                <p>{{ session('message4') }}</p>
                <p>{{ session('message5') }}</p>
                <p>{{ session('message6') }}</p>
            </div>
            @endif
            <input type="submit" value="Đăng ký" />
            <label class="psw-text"> <a href="/">Trở về</a></label> 
        </form>
        
    </div>
    
</body>
</html>
