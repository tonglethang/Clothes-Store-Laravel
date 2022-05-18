<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Chi tiết</title>
    <link href="{{ asset('css/index.css') }}"  rel="stylesheet" type="text/css">
    <link href="{{ asset('css/chitiet.css') }}" rel="stylesheet" type="text/css" media="all">
    <link href="{{ asset('css/cuahang.css') }}"  rel="stylesheet" type="text/css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://kit.fontawesome.com/6202e56613.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.min.js" ></script>

    <script>document.addEventListener("touchstart", function(){}, true);</script>
    <script src="{{ asset('js/index.js') }}">
        function kiemtrasoluong(){

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
            <input type="text" name="username" placeholder="Tên đăng nhập hoặc email"  required="required"/>
            <input type="password" name="password" placeholder="Mật khẩu"  required="required"/>
            <input type="submit" name="submit" value="Đăng nhập" />
            <label class="psw-text"><a>Quên mật khẩu ?</a></label>
            <label class="psw-text">Bạn chưa có tài khoản ? <a href="/khachhang/dangky">Đăng ký</a></label> 
            <label class="psw-text"><a href="/admin/login">Đăng nhập với tư cách Admin</a></label>
        </form>
        
        
        </div>
    <div style="height: 1350px"class="containe">
        @include('template/header')
        <div class="menu-doc">
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
                    <h3>SẢN PHẨM TƯƠNG TỰ</h3>
                    @foreach($product2 as $product2)
                        <a href="/chitiet/{{$product2->MaSP}}" >
                        <li>
                            <img src="{{ asset('upload/' . $product2->Image) }}" />{{$product2->TenSP}}<p style="color: rgb(201, 58, 58)">{{$product2->Gia}}<u>đ</u></p></a>
                        </li>
                        </a>
                    @endforeach
                </ul>
            </div>
        </div>
        <div class="sanpham">
            <div class="chitiet">
                @foreach($products as $product)
                <div class="anhsp">
                    <img src="{{ asset('upload/' . $product->Image) }}"  style="width:550px; height: 700px"/>
                </div>
                <div class="product-inf">
             
                    <h3>{{$product->TenSP}}</h3>
                    <form method="get" action="/khachhang/giohang/{{$product->MaSP}}">
                        <div class="gia"><p><?php echo number_format($product->Gia,0,",", ".") ?><u>đ</u></p></div>
                        <div class="brand">
                            Hãng: {{$product->Hang}}
                        </div>
                        <div class="size">
                            Size: {{$product->Size}}
                        </div>
                        <div class="color">Màu sắc: {{$product->Color}}
                            
                        </div>
                        <div class="hangcon">
                            Số lượng hàng còn: {{$product->SoLuong}}
                        </div>
                        <div class="soluong">
                            Số lượng: <input type="number" name="soluong" value="1" min="1" max="{{$product->SoLuong}}"/>
                        </div>
                        @if (!session('username'))
                        <button onclick="change_login()" type="button" name="btnMua">MUA HÀNG</button>
                        @endif
                        @if (session('username'))
                        <button type="submit" name="btnMua">MUA HÀNG</button>
                        @endif
                    </form>
                    <div class="yeuthich">
                        <i class="fas fa-heart"></i>Thêm vào danh sách yêu thích
                    </div>
                    <div class="id">
                        Mã sản phẩm:{{$product->MaSP}}
                    </div>
                    <div class="mota">Mô tả sản phẩm: <p>{{$product->Note}}</p></div>

                </div>
    
                <div class="product-footer" style="clear:both">
                    <div class="danhgiasp">
                        <h3>Đánh giá của khách hàng về sản phẩm: </h3>
                        @foreach($comment as $comment)
                        @if(!$comment)
                        <h4>Chưa có bình luận </h4>
                        @endif
                        <div class="binhluan">
                            <h4>{{$comment->TenKH}}: </h4>
                            <span class="time-cmt">{{$comment->time_create}}</span>
                            <p>{{$comment->content}}</p>
                        </div>

                        @endforeach
                    </div>
                    @if (session('username'))
                    <div class="themdanhgia" id="thang">
                        <h3>Thêm đánh giá: </h3>
                        <form action="/chitiet/{{$product->MaSP}}&{{ session('MaKH') }}" method="post" enctype="multipart/form-data">
                        @csrf
                            <h4>Nhận xét của bạn: </h4>
                            <textarea name="comment"></textarea>
                            <button type="submit">GỬI ĐI</button>
                        </form>
                    </div>
                    @endif
                    @endforeach
                </div>
            </div>
        </div>
        @include('template/footer')
    </div>
    
</body>
</html>
