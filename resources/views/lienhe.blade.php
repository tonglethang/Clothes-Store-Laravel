<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Trang chủ</title>
    <link href="{{ asset('css/index.css') }}"  rel="stylesheet" type="text/css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@500&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/6202e56613.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.min.js" ></script>
    <script>document.addEventListener("touchstart", function(){}, true);</script>
    <script src="js/index.js">
    </script>
</head>
<body>  
    <div id="back"></div>
    <div class="exit" id="exit">
        <button onclick="exit()" style="border: none; background-color: inherit"><i class="fas fa-times"></i></button>
    </div>
    <div class="form-tt" id="login">
        <h2>Đăng nhập</h2>
        <form method="post" action="/"> 
             @csrf
            <input type="text" name="username" placeholder="Tên đăng nhập hoặc email"  required="required"/>
            <input type="password" name="password" placeholder="Mật khẩu"  required="required"/>
            <input type="submit" name="submit" value="Đăng nhập" />
            <label class="psw-text"><a>Quên mật khẩu ?</a></label>
            <label class="psw-text">Bạn chưa có tài khoản ? <a href="/khachhang/dangky">Đăng ký</a></label> 
            <label class="psw-text"><a href="/admin/login">Đăng nhập với tư cách Admin</a></label>
        </form>
        
        </div>
    <div class="container">
        @include('template/header')

        @if (session('message1'))
        <div class="alert alert-success" style="position: relative; z-index: 0165641">
            <p>{{ session('message1') }}</p>
        </div>
        @endif
        <div class="lienhe">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d4816.908429447877!2d108.22199413791772!3d16.031899409230746!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x314219ee598df9c5%3A0xaadb53409be7c909!2zVHLGsOG7nW5nIMSQ4bqhaSBo4buNYyBLaeG6v24gdHLDumMgxJDDoCBO4bq1bmc!5e0!3m2!1svi!2s!4v1652151651412!5m2!1svi!2s" width="100%" height="580" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
        
        @include('template/footer')
    </div>

</body>
</html>
