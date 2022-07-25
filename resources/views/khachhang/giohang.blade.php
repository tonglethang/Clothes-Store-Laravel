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

    <script>
        document.addEventListener("touchstart", function(){}, true);
        function Redirect() {
            var a = document.getElementsByClassName("count");
            var tmp = "";
            for(var i=0; i<a.length; i++){
                tmp += a[i].value;
            }
            window.location="/khachhang/giohang/update/" + tmp;
        }
    </script>
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
       @include('template.header')
        <div class="content-cart">
            <div class="left-cart">
                    <table>
                        <tr>
                            <th>SẢN PHẨM</th>
                            <th>GIÁ</th>
                            <th>SỐ LƯỢNG</th>
                            <th>TẠM TÍNH</th>
                        </tr>
                        @if ($sanpham)
                        <?php $dem = 0; $soluongmua = "";?>
                        @foreach($sanpham as $sanphamm)
                        <tr>
                            <td>
                                <a href="/khachhang/giohang/delete/{{$sanphamm->id}}"><button type="button" class="delete-product" style="float:left">X</button></a>
                                <img width="110" height="135" src="{{ asset('upload/' . $sanphamm->Image) }} " style="float:left; padding: 10px"> 
                                <p class="name-product" style="float:left">{{ $sanphamm->TenSP }} </p>
                            </td>
                            <td>
                                <p class="price-cart"><?php echo number_format($sanphamm->Gia,0,",", ".")?><u>đ</u></p>
                            </td>
                            <td>
                              
                                <div class="qty mt-5">
                                        <button class="minus bg-dark1" id="minus" onclick="minus({{$dem}})">-</button>
                                        <input type="number" id="soluong" class="count" name="soluong" value="{{$sanphamm->SoLuongMua}}" min="1" max="{{session('Soluongbandau')}}">
                                        <button class="plus bg-dark15" id="plus"  onclick="plus({{$dem}})">+</button>
                                
                                </div>
                            </td>
                            <td>
                                <p class="price-cart"><?php echo number_format($tongtien = $sanphamm->SoLuongMua * $sanphamm->Gia,0,",", ".")?><u>đ</u></p>
                            </td>
                        </tr>
                        <?php $dem += 1; $soluongmua .= $sanphamm->SoLuongMua?>
                        <input type="hidden" class="abc" value="{{$sanphamm->Soluongcon }}"/>
                        <input type="hidden" class="soluong" value="{{$sanphamm->SoLuongMua }}"/>
                        @endforeach
                        @endif
                    </table>
                    @if (count($sanpham) == 0)
                        <div class="thongbao" style="padding: 40px 0px 36px 0px">
                            <h3>Chưa có sản phẩm trong giỏ hàng</h3>
                        </div>
                    @endif
                    <div class="update-cart">
                        <a href="/cuahang"><button class="add-product"><i class="fa-solid fa-arrow-left-long"></i> TIẾP TỤC XEM SẢN PHẨM</button></a>
                        @if (count($sanpham) != 0)
                        <button onclick=" Redirect()" id="updateCart" class="update-product" type="submit" name="update-product">CẬP NHẬT GIỎ HÀNG</button>
                        @endif
                    </div>
            </div>
        </div>          
        @if (count($sanpham) != 0)
        <div class="hoadon">
            <h4>ĐƠN HÀNG CỦA BẠN</h4>
            <table>
                <tr>
                    <th class="name-product">SẢN PHẨM</th>
                    <th class="total-product">TẠM TÍNH</th>
                </tr>
                <?php $tongtien = 0;
                    $tongsoluong = 0
                ?>
                @foreach($sanpham as $sanpham)
                <tr>
                    <td class="name-product">{{$sanpham->TenSP}}</td>
                    <td class="total-product" style="color: rgb(233, 2, 2);"><?php echo number_format($sanpham->Gia,0,",", ".")?><u>đ</u><td>
                </tr>
                <tr>
                    <td class="name-product">Số lượng</td>
                    <td class="total-product">{{$sanpham->SoLuongMua}}</td>
                </tr>
                <?php $tongtien += $sanpham->SoLuongMua * $sanpham->Gia;
                    $tongsoluong += $sanpham->SoLuongMua ?>
                @endforeach
                <tr>
                    <td class="name-product">Tổng</td>
                    <td class="total-product"  style="color: rgb(233, 2, 2);"><?php echo number_format($tongtien,0,",", ".")?><u>đ</u><td>
                </tr>
            </table>
            <table>
                @foreach($khachhang as $khachhang)
                <tr>
                    <th class="name-product">THÔNG TIN</th>
                    <th class="total-product">KHÁCH HÀNG</th>
                </tr>
                <tr>
                    <td class="name-product">Họ và tên</td>
                    <td class="total-product" >{{$khachhang->TenKH}}<td>
                </tr>
                <tr>
                    <td class="name-product">Địa chỉ</td>
                    <td class="total-product">{{$khachhang->DiaChi}}</td>
                </tr>
                <tr>
                    <td class="name-product">SĐT</td>
                    <td class="total-product">{{$khachhang->SDT}}<td>
                </tr>
                @endforeach
            </table>
            <div class="thanhtoan">
                <form action="/khachhang/giohang?soluongmua={{$soluongmua}}&tongtien={{$tongtien}}&tongsoluong={{$tongsoluong}}" method="post" >
                    @csrf
                    <input type="radio" name="thanhtoan" value="Chuyển khoản" required="required">
                    <label for="nganhang">Chuyển khoản ngân hàng</label>
                    <p>Thực hiện thanh toán vào ngay tài khoản ngân hàng của chúng tôi.Đơn hàng sẽ đươc giao sau khi tiền đã chuyển.</p>
                    <input type="radio" name="thanhtoan" value="Tiền mặt" required="required">
                    <label for="tienmat">Trả tiền mặt khi nhận được hàng</label>
                    <p>Trả tiền mặt khi giao hàng</p>
                    <input onclick="return confirm('Xác nhận mua hàng ?')" type="submit"  value="ĐẶT HÀNG">
                </form>
            </div>
        </div>
        @endif
        @include('template.footer')
    </div>
    
</body>
</html>
