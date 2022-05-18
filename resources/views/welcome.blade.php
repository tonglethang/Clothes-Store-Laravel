<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Trang chủ</title>
    <link href="css/index.css" rel="stylesheet" type="text/css" media="all">
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
        <div class="slide">
            <div id="myCarousel" class="carousel slide" data-ride="carousel">
                <!-- Indicators -->
                <ol class="carousel-indicators">
                <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                <li data-target="#myCarousel" data-slide-to="1"></li>
                <li data-target="#myCarousel" data-slide-to="2"></li>
                <li data-target="#myCarousel" data-slide-to="3"></li>
                
                </ol>
            
                <!-- Wrapper for slides -->
                <div class="carousel-inner">
            
                <div class="item active">
                    <img src="../image/slide1.png" alt="slide1" style="width:100%;">
                </div>
            
                <div class="item">
                    <img src="../image/slide2.png" alt="slide2" style="width:100%;">
                </div>
                
                <div class="item">
                    <img src="../image/slide3.png" alt="slide3" style="width:100%;">
            
                </div>
                <div class="item">
                    <img src="../image/slide4.png" alt="slide4" style="width:100%;">
            
                </div>
                <!-- Left and right controls -->
                <a class="left carousel-control" href="#myCarousel" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left"></span>
                <span class="sr-only">Previous</span>
                </a>
                <a class="right carousel-control" href="#myCarousel" data-slide="next">
                <span class="glyphicon glyphicon-chevron-right"></span>
                <span class="sr-only">Next</span>
                </a>
            </div>
        </div>
        </div>
        <div class="select">
            <a href="/cuahang/Nam">
                <div class="men">
                    <h4 style="text-decoration: none">THỜI TRANG NAM</h4>
                    <img src="../image/men.jpg" />
            </div>
            </a>
            <a href="/cuahang/Nữ">
                <div class="women">
                    <h4>THỜI TRANG NỮ</h4>
                    <img src="../image/women.jpg"/>
                </div>
            </a>
        </div>
        <div class="hang">
            <a href="/cuahang/Gucci">
                <div class="gucci">
                    <img src="../image/logo-gucci.png"  style="width:70%;"/>
                </div>
            </a>
            <a href="/cuahang/Dior">
                <div class="dior">
                    <img src="../image/dior.png" style="width:70%;"/>
                </div>
            </a>
            <a href="/cuahang/Chanel">
                <div class="chanel">
                    <img src="../image/chanel.png" style="width:70%;"/>
                </div>
            </a>
            <a href="/cuahang/Louis Vuiton">
                <div class="LouisVuiton">
                    <img src="../image/lv.png" style="width:70%;"/>
                </div>
            </a>
            <a href="/cuahang/Nike">
                <div class="nike">
                    <img src="../image/nike.png" style="width:70%;"/>
                </div>
            </a>
            <a href="/cuahang/Adidas">
                <div class="adidas">
                    <img src="../image/adidas.png" style="width:70%;"/>
                </div>
            </a>
        </div>
        <div class="products">
            <div class="title-product">
                <h4>DANH MỤC SẢN PHẨM</h4>
                <button id="button1" onclick="content1()"><a>SẢN PHẨM MỚI</a></button>
                <button id="button2" onclick="content2()"><a>HÀNG CAO CẤP</a></button>
                <button id="button3" onclick="content3()"><a>BÁN CHẠY NHẤT</a></button>
            </div>
            <div class="content1" id="content1">
                @foreach($products1 as $product)
                <div class="product">
                    <a style="text-decoration: none;" href="/chitiet/{{$product->MaSP}}">
                    <div class="anh"><img src="{{ asset('upload/' . $product->Image) }}" /></div>
                    <p>{{$product->TenSP}}</p>
                    <div class="price"><?php echo number_format($product->Gia,0,",", ".")?><u>đ</u></div> 
                    </a>
                </div>
                @endforeach
            </div>
            <div class="content2" id="content2">
                @foreach($products2 as $product)
                <div class="product">
                    <a style="text-decoration: none;" href="/chitiet/{{$product->MaSP}}">
                    <div class="anh"><img src="{{ asset('upload/' . $product->Image) }}" /></div>
                    <p>{{$product->TenSP}}</p>
                    <div class="price">{{$product->Gia}}<u>đ</u></div> 
                    </a>
                </div>
                @endforeach
            </div>
            <div class="content3" id="content3">
                @foreach($products3 as $product)
                <div class="product">
                    <a style="text-decoration: none;" href="/chitiet/{{$product->MaSP}}">
                    <div class="anh"><img src="{{ asset('upload/' . $product->Image) }}" /></div>
                    <p>{{$product->TenSP}}</p>
                    <div class="price">{{$product->Gia}}<u>đ</u></div> 
                    </a>
                </div>
                @endforeach
            </div>
           
        </div>
        @include('template/footer')
    </div>

</body>
</html>
