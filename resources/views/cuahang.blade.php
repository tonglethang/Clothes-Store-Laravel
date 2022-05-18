<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Cửa hàng</title>
    <link href="{{ asset('css/index.css') }}"  rel="stylesheet" type="text/css">
    <link href="{{ asset('css/cuahang.css') }}"  rel="stylesheet" type="text/css">
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
    <script src="{{ asset('js/index.js') }}"></script>
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
    <div class="containe">
        @include('template/header')
        <div class="mid">
            <div class="menu-doc">
                <div class="title"><h3><a href="index.html">TRANG CHỦ</a>/<a style="color: black">CỬA HÀNG</a></h3></div>
                <div class="danhmuc">
                    <ul>
                        <h3>DANH MỤC SẢN PHẨM</h3>
                        <li><a href="/cuahang/Áo">Áo</a></li>
                        <li class="colorli"><a href="/cuahang/Quần">Quần</a></li>
                        <li><a href="/cuahang/Giày">Giày</a></li>
                        <li class="colorli"><a href="/cuahang/Túi xách">Túi xách</a></li>
                        <li><a href="/cuahang/Nón">Nón</a></li>
                    </ul>
                    <ul>
                        <h3>SẢN PHẨM</h3>
                        @foreach($product2 as $product2)
                        <a href="/chitiet/{{$product2->MaSP}}">
                        <li>
                            <img src="{{ asset('upload/' . $product2->Image) }}" />{{$product2->TenSP}}<p style="color: rgb(201, 58, 58)"> <?php echo number_format($product2->Gia,0,",", ".") ?><u>đ</u></p></a>
                        </li>
                        </a>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="content">
   
                @foreach($products as $product)
                <div class="product">
                    <a style="text-decoration: none;" href="/chitiet/{{$product->MaSP}}">
                    <div class="anh"><img src="{{ asset('upload/' . $product->Image) }}" /></div>
                    <p>{{$product->TenSP}}</p>
                    <div class="price"><?php echo number_format($product->Gia,0,",", ".") ?><u>đ</u></div> 
                    </a>
                </div>
                @endforeach
                <div class="phantrang">
                {{ $products->links() }}

                 </div>

                
            </div>
        </div>
        @include('template/footer')
    </div>

</body>
</html>
