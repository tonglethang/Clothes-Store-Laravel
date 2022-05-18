<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Chi tiết</title>
    <link href="{{ asset('css/index.css') }}"  rel="stylesheet" type="text/css">
    <link href="{{ asset('css/chitiet.css') }}" rel="stylesheet" type="text/css" media="all">
    <link href="{{ asset('css/cuahang.css') }}"  rel="stylesheet" type="text/css">
    <link href="{{ asset('css/giohang.css') }}"  rel="stylesheet" type="text/css">
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
    <script src="{{ asset('js/index.js') }}"></script>
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
        </form>
        
        </div>
    <div class="containe">
        <nav class="header">
            <div class="logo">
                <a style="color: black">ABCDEF</a>
            </div>
            <div class="menu">
                <div class="menu-ngang">
                    <ul>
                        <li><a href="/">TRANG CHỦ</a></li>
                        <li><a href="/cuahang">CỬA HÀNG</a>
                            <ul class="drop1">
                                <li><a href="https://">Nam</a></li>
                                <li><a href="https://">Nữ</a></li>
                                <li><a href="https://">Áo</a></li>
                                <li><a href="https://">Quần</a></li>
                                <li><a href="https://">Giày</a></li>
                                <li><a href="https://">Túi xách</a></li>
                                <li><a href="https://">Nón</a></li>
                                <li><a href="https://">Áo khoác</a></li>
                            </ul>
                        </li>
                        <li><a href="https://">GIỚI THIỆU</a></li>
                        <li><a href="https://">TIN TỨC</a></li>
                        <li><a href="https://">LIÊN HỆ</a></li>
                    <ul>
                </div>
                <div class="icon">
                    <div class="search">
                        <form action="/cuahang" method="post" enctype="multipart/form">
                            <input type="text" name="txtSearch" id="t1" placeholder="Tìm kiếm...">
                            <button type="submit" name="ntnSearch" id="b1"><i class="fa fa-search"></i></button>
                        </form>
                    </div>
                    <!-- goi y tim kiem -->
                    <script>
                        var path = "{{ url('chitiet/action') }}";

                        $('#t1').typeahead({

                            source: function(query, process){

                                return $.get(path, { term: query}, function(data){

                                    return process(data);   

                                });
                            }
                        });

                    </script>
                    <!-- goi y tim kiem -->
                    <div class="login">
                        <button onclick="change_login()" style="border: none; background-color: inherit; {{ session('display') }}"><i class="far fa-user-circle"></i></button>
                    </div>

                    <div class="like">
                        <i class="fas fa-heart"></i>
                    </div>
                    @if (session('username'))
                    <div class="profile">
                    <i class="fa-solid fa-user"></i>
                    <label>{{ session('username') }} <i class="fa-solid fa-angle-down"></i>
                        <ul class="drop2">
                            <li><i class="fa-solid fa-key"></i><a href="/khachhang/changepass">Đổi mật khẩu</a></li>
                            <li><i class="fa-solid fa-arrow-right-from-bracket"></i><a href="/khachhang/dangxuat" onclick="return confirm('Bạn chắc chắn đăng xuất không?');">Đăng xuất</a></li>
                        </ul>
                    </label>
                    </div>
                    @endif
                </div>
            </div>
        </nav>
        <div class="content-cart">
            <div class="left-cart">
                <table>
                    <tr>
                        <th>SẢN PHẨM</th>
                        <th>GIÁ</th>
                        <th>SỐ LƯỢNG</th>
                        <th>TẠM TÍNH</th>
                    </tr>
                    @if (session('MaSP'))
                    <tr>
                        <td>
                            <a href="/khachhang/giohang/delete"><button type="button" class="delete-product" style="float:left">X</button></a>
                            <img width="110" height="135" src="{{ asset('upload/' . session('Image') ) }} " style="float:left; padding: 10px"> 
                            <p class="name-product" style="float:left">{{ session('TenSP') }} </p>
                        </td>
                        <td>
                            <p class="price-cart">{{ session('Gia') }} <u>đ</u></p>
                        </td>
                        <td>
                            <div class="qty mt-5">
                            <div class="qty mt-5">
                                    <span class="minus bg-dark">-</span>
                                    <input type="number" class="count" name="qty" value="{{session('Soluong')}}">
                                    <span class="plus bg-dark">+</span>
                            </div>
                            </div>
                        </td>
                        <td>
                            <p class="price-cart">{{ session('Tongtien') }}<u>đ</u></p>
                        </td>
                    </tr>
                    @endif
                </table>
                <div class="update-cart">
                    <a href="/cuahang"><button class="add-product"><i class="fa-solid fa-arrow-left-long"></i> TIẾP TỤC XEM SẢN PHẨM</button></a>

                </div>
            </div>
        </div>
        <div class="footer" style="clear: both;">
            <div class="left" style="float:left">
                <h4>THỜI GIAN MỞ CỬA</h4>
                    <p>Thứ Hai - Thứ Sáu .... 8,00 đến 18:00</p>
                    <p>Thứ Bảy ............ 9.00 đến 21.00</p>
                    <p>Chủ nhật ............ 10:00 đến 21:00</p>
            </div>
            <div class="mid-footer" style="float:left">
                <div class="mid1">
                    <h4>MENU</h4>
                    <ul>
                        <li><a>Trang chủ</a></li>
                        <li><a>Cửa hàng</a></li>
                        <li><a>Giỏ hàng</a></li>
                        <li><a>Giới thiệu</a></li>
                        <li><a>Liên hệ</a></li>
                    </ul>
                </div>
                <div class="mid1">
                    <h4>DANH MỤC</h4>
                    <ul>
                        <li><a>Áo</a></li>
                        <li><a>Quần</a></li>
                        <li><a>Giày</a></li>
                        <li><a>Túi xách</a></li>
                        <li><a>Trang sức</a></li>
                    </ul>
                </div>
                <div class="mid1">
                    <h4>CHÍNH SÁCH</h4>
                    <ul>
                        <li><a>Chính sách ưu đãi</a></li>
                        <li><a>Chính sách bảo mật</a></li>
                        <li><a>Chính sách giao nhận</a></li>
                        <li><a>Chính sách đổi trả</a></li>  
                    </ul>
                </div>
            </div>
            <div class="right" style="float:left">
                <h4>ĐĂNG KÝ</h4>
                <p>Đăng ký để nhận được được thông tin mới nhất từ chúng tôi</p>
                <form>
                    <input type="text" name="txtDangky" placeholder="Email.." id="txtDangky"/>
                    <input type="submit" name="btnDangky" value="Đăng ký" id="btnDangky"/>
                </form>
                <div class="icon-mxh">
                    <i class="fa-brands fa-facebook"></i>
                    <i class="fa-brands fa-instagram"></i>
                    <i class="fa-brands fa-twitter"></i>
                    <i class="fa-brands fa-youtube"></i>
                    <i class="fa-solid fa-envelope"></i>
                </div>
            </div>
            <div class="copyright">
                Wedsite được thiết kế bởi: TDS
            </div>
        </div>
    </div>
    
</body>
</html>
