
<nav class="header">
@if (session('message1'))
        <div class="alert alert-success" style="position: relative; z-index: 165641;" id="alert-message">
            <p style="float:left; width: 90%; margin-left: 50px">{{ session('message1') }}</p>
            <div class="exit2" id="exit2">
                <button onclick="alertmessage()" style="border: none; background-color: inherit; font-size:30px; margin-top:-7px"><i class="fas fa-times"></i></button>
            </div>
        </div>
@endif
            <div class="logo">
                <a href="/"style="color: black; text-decoration: none;">LT Store</a>
            </div>
            <div class="menu">
                <div class="menu-ngang">
                    <ul>
                        <li><a href="/">TRANG CHỦ</a></li>
                        <li><a href="/cuahang">CỬA HÀNG</a></li>
                        <li><a href="">DANH MỤC <i class="fa-solid fa-angle-down"></i></a>
                            <ul class="drop1">
                                <li><a href="/cuahang/Nam">Nam</a></li>
                                <li><a href="/cuahang/Nữ">Nữ</a></li>
                                <li><a href="/cuahang/Áo">Áo</a></li>
                                <li><a href="/cuahang/Quần">Quần</a></li>
                                <li><a href="/cuahang/Giày">Giày</a></li>
                                <li><a href="/cuahang/Túi xách">Túi xách</a></li>
                                <li><a href="/cuahang/Nón">Nón</a></li>
                            </ul>
                        </li>
                        <li><a href="">HÃNG <i class="fa-solid fa-angle-down"></i></a>
                            <ul class="drop1">
                                <li><a href="/cuahang/Gucci">Gucci</a></li>
                                <li><a href="/cuahang/Dior">Dior</a></li>
                                <li><a href="/cuahang/Louis Vuitton">Louis Vuitton</a></li>
                                <li><a href="/cuahang/Nike">Nike</a></li>
                                <li><a href="/cuahang/Adidas">Adidas</a></li>
                                <li><a href="/cuahang/Chanel">Chanel</a></li>
                            </ul>
                        </li>
                        <li><a href="/lienhe">LIÊN HỆ</a></li>
                    <ul>
                </div>
                <div class="icon">
                    <div class="search">
                        <form action="/cuahang" method="get">
                            <input type="text" name="txtSearch" id="t1" placeholder="Tìm kiếm...">
                            <button type="submit" name="btnSearch" id="b1"><i class="fa fa-search"></i></button>
                        </form>
                    <!-- timkiem -->
                    
                    <script>
                        var path = "{{ url('/action') }}";

                        $('#t1').typeahead({

                            source: function(query, process){

                                return $.get(path, { term: query}, function(data){

                                    return process(data);   

                                });
                            }
                        });

                    </script>
                    <!-- timkiem -->
                    </div>
                    @if(!session('username'))
                    <div class="login">
                        <button onclick="change_login()" style="border: none; background-color: inherit;"><i class="far fa-user-circle"></i></button>
                    </div>
                    <div class="giohang" onclick="change_login()">
                        <i class="fas fa-shopping-cart"></i>
                    </div>
                    @endif
                    @if(session('username'))
                    <a href="/khachhang/giohang">
                    <div class="giohang">
                        <i class="fas fa-shopping-cart"></i>
                    </div>
                    </a>
                    @endif
                    @if (session('username'))
                    <div class="profile">
                    <i class="fa-solid fa-user"></i>
                    <label>{{ session('username') }} <i class="fa-solid fa-angle-down"></i>
                        <ul class="drop2">
                            <li><i class="fa-solid fa-clock"></i><a href="/khachhang/lichsu">Lịch sử mua hàng</a></li>
                            <li><i class="fa-solid fa-circle-info"></i><a href="/khachhang/info/{{session('MaKH')}}">Thông tin</a></li>
                            <li><i class="fa-solid fa-key"></i><a href="/khachhang/changepass/{{session('MaKH')}}">Đổi mật khẩu</a></li>
                            <li><i class="fa-solid fa-arrow-right-from-bracket"></i><a href="/khachhang/dangxuat" onclick="return confirm('Bạn chắc chắn đăng xuất không?');">Đăng xuất</a></li>
                        </ul>
                    </label>
                    </div>
                    @endif
                </div>
            </div>
</nav>