<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('css/index.css') }}"  rel="stylesheet" type="text/css">
    <title>Login</title>
</head>
<body>
    <div class="form-tt" id="login" style="display: block; border: 1px solid black; animation: none;">
        <h2>NGƯỜI GIAO HÀNG</h2>
        <form action="/giaohang/login" method="post" enctype="multipart/form-data">
            @csrf
            <input type="text" name="name" placeholder="Tên đăng nhập" required="required" />
            <input type="password" name="pass" placeholder="Mật khẩu" required="required" />
            <label class="psw-text"><a>{{$message}}</a></label>
            <input type="submit" value="Đăng nhập" />
            <label class="psw-text"> <a href="/">Trở về</a></label> 
        </form>
        
    </div>
</body>
</html>
