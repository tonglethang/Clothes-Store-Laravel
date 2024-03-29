<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Chi tiết</title>
    <link href="{{ asset('css/index.css') }}"  rel="stylesheet" type="text/css">
    <link href="{{ asset('css/chitiet.css') }}" rel="stylesheet" type="text/css" media="all">
    <link href="{{ asset('css/cuahang.css') }}"  rel="stylesheet" type="text/css">
    <link href="{{ asset('css/donhang.css') }}"  rel="stylesheet" type="text/css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://kit.fontawesome.com/6202e56613.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.min.js" ></script>

    <script>
        document.addEventListener("touchstart", function(){}, true);
        function Redirect() {
            var a = document.getElementById("soluong");
            window.location="/khachhang/giohang/update/" + a.value;
        }
        function quay_lai(){
            history.back();
        }
    </script>
    <script src="{{ asset('js/index.js') }}"> </script>
</head>
<body>
    <div id="back"></div>
    <div class="exit" id="exit">
        <button onclick="exit()" style="border: none; background-color: inherit"><i class="fas fa-times"></i></button>
    </div>
    <div class="form-tt" id="login">
        <h2>Đăng nhập</h2>
        <form action="#" method="post" name="dang-ky">
        
        <input type="text" name="username" placeholder="Tên đăng nhập hoặc email" />
        <input type="password" name="password" placeholder="Mật khẩu" />
        <input type="submit" name="submit" value="Đăng nhập" />
        <label class="psw-text"><a>Quên mật khẩu ?</a></label>
        <label class="psw-text">Bạn chưa có tài khoản ? <a>Đăng ký</a></label> 
        <label class="psw-text"><a href="/admin/login">Đăng nhập với tư cách Admin</a></label>
        <label class="psw-text"><a href="/admin/login">Đăng nhập với tư cách người giao hàng</a></label>
        </form>
        
        </div>
    <div class="containe">
       @include('template.header')
        <div class="chitiet">
                @foreach($donhang as $donhang)
                <h4>ĐƠN HÀNG CỦA BẠN</h4>
                    <ul>
                        <li>Mã đơn hàng: <b>{{$donhang->MaDon}}</b></li>
                        <li>Sản phẩm: <b>{{$donhang->TenSP}}</b></li>
                        <li>Tống số lượng: <b>{{$donhang->SoLuongDH}}</b></li>
                        <li>Tổng cộng: <b style="color: rgb(201, 58, 58)"><?php echo number_format($donhang->TongTien,0,",", ".")?><u>đ</u></b></li>
                        <li>Ngày đặt hàng: <b>{{$donhang->ThoiGianDH}}</b></li>
                        <li>Địa chỉ: <b>{{$donhang->DiaChi}}</b></li>
                        <li>Phương thức thanh toán: <b>{{$donhang->Phuongthuc}} </b></li>
                        <li>Tình trạng đơn hàng: <b>{{$donhang->status}}</b></li>
                        @if ($donhang->status == "Đã nhận hàng")
                        <li>Thời gian nhận hàng: <b>{{$donhang->ThoiGianNH}}</b></li>
                        @endif
                        
                    <ul>
                @endforeach
        </div>          
        @include('template.footer')
    </div>
    
</body>
</html>
