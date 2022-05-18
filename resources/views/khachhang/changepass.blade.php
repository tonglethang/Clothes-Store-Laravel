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
    <title>Đổi mật khẩu</title>
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
        <h2>Đổi mật khẩu</h2>
        @foreach($datas as $data)
        <form action="/khachhang/changepass/{{$data->MaKH}}" method="post" enctype="multipart/form-data">
            @csrf
            <input type="Password" name="pass_old" placeholder="Nhập mật khẩu hiện tại" required="required"/>
            <input type="Password" name="pass_new" placeholder="Nhập mật khẩu mới"  required="required"/>
            <input type="Password" name="re_pass" placeholder="Nhập lại mật khẩu mới"  required="required"/>

            @if (session('message1') || session('message2'))
            <div class="alert alert-success">
                <p>{{ session('message1') }}</p>
                <p>{{ session('message2') }}</p>
            </div>
            @endif
            <input type="submit" value="Xác nhận" />
            <label class="psw-text"> <a href="/">Trở về</a></label> 
        </form>
        @endforeach
        
    </div>
</body>
</html>
