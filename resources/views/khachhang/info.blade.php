<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Thông tin khách hàng</title>
    <link href="{{ asset('css/index.css') }}"  rel="stylesheet" type="text/css">
    <link href="{{ asset('js/index.js') }}" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@500&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/6202e56613.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.min.js" ></script>

    <script>   
    document.addEventListener("touchstart", function(){}, true);
    function validate(evt) {
        var theEvent = evt || window.event;

        // Handle paste
        if (theEvent.type === 'paste') {
            key = event.clipboardData.getData('text/plain');
        } else {
        // Handle key press
            var key = theEvent.keyCode || theEvent.which;
            key = String.fromCharCode(key);
        }
        var regex = /[0-9]|\./;
        if( !regex.test(key) ) {
            theEvent.returnValue = false;
            if(theEvent.preventDefault) theEvent.preventDefault();
        }
    }
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
            <input type="text" name="username" placeholder="Tên đăng nhập"  required="required"/>
            <input type="password" name="password" placeholder="Mật khẩu"/>
            <input type="submit" name="submit" value="Đăng nhập" />
            <label class="psw-text"><a href="/khachhang/forgetpass">Quên mật khẩu ?</a></label>
            <label class="psw-text">Bạn chưa có tài khoản ? <a href="/khachhang/dangky">Đăng ký</a></label> 
            <label class="psw-text"><a href="/admin/login">Đăng nhập với tư cách Admin</a></label>
        </form>
        
    </div>
    <div class="container">
        @include('template.header')
        <div class="info">
            <h3>Thông tin khách hàng: </h3>
            <form method="post" action="/khachhang/update/{{session('MaKH')}}">
                @csrf
                @foreach($khachhang as $khachhang)
                <label for="id"> ID: 
                    <input type="text" name="id" value="{{$khachhang->MaKH}}" disabled>
                </label>
                <label for="name"> Họ và tên: 
                    <input type="text" name="name" value="{{$khachhang->TenKH}}">
                </label>
                <label for="email"> Email: 
                    <input type="text" name="email" value="{{$khachhang->Email}}" disabled>
                </label>
                <label for="SĐT">SĐT: 
                    <input type='text' onkeypress='validate(event)'  name="sdt" value="{{$khachhang->SDT}}"  />
                </label>
                <label for="SĐT">Địa chỉ: 
                    <input type="text" name="diachi" value="{{$khachhang->DiaChi}}">
                </label><br><br>
                @endforeach
                <input type="submit"value="Cập nhật thông tin">
            </form>
        </div>
        @include('template/footer')
    </div>

</body>
</html>
