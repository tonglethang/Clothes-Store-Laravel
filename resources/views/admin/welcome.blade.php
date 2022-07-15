<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
</head>
<body>
        <link href="{{ asset('css/admin.css') }}"  rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
        <!-- or -->
        <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
      
        <!-- Font-icon css-->
        <link rel="stylesheet" type="text/css"
          href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@500&display=swap" rel="stylesheet">
        <script src="https://kit.fontawesome.com/6202e56613.js" crossorigin="anonymous"></script>
      
      </head>

<body onload="time()" class="app sidebar-mini rtl">
   <!-- Navbar-->
   <header class="app-header">
    <!-- Sidebar toggle button--><a class="app-sidebar__toggle" href="#" data-toggle="sidebar"
      aria-label="Hide Sidebar"></a>
    <!-- Navbar Right Menu-->
    <ul class="app-nav">


      <!-- User Menu-->
      <li><a onclick="return confirm('Bạn có muốn đăng xuất ?')" class="app-nav__item" href="/admin/logout"><i class='bx bx-log-out bx-rotate-180'></i> </a>

      </li>
    </ul>
  </header>
  <!-- Sidebar menu-->
  <div class="app-sidebar__overlay" data-toggle="sidebar"></div>
  <aside class="app-sidebar">
    <div class="app-sidebar__user"><img class="app-sidebar__user-avatar" src="{{ asset('image/admin.jpg') }}"  width="50px"
        alt="User Image">
      <div>
        <p class="app-sidebar__user-name"><b>ADMIN</b></p>
        <p class="app-sidebar__user-designation">Chào mừng bạn trở lại</p>
      </div>
    </div>
    <hr>
    <ul class="app-menu">
      <li><button class="select" onclick="onchange_sanpham()">Quản lí sản phẩm</button></li>
      <li><button class="select" onclick="onchange_khachhang()">Quản lí khách hàng</button></li>
      <li><button class="select" onclick="onchange_comment()">Quản lí comment</button></li>
      <li><button class="select" onclick="onchange_donhang()">Quản lí đơn đặt hàng</button></li>
      <li><button class="select" onclick="onchange_giaohang()">Quản lí tài khoản giao hàng</button></li>
      <li><button class="select" onclick="onchange_thongke()">Thống kê</button></li>
    </ul>
  </aside>
    <main class="app-content" id="content1">
        <div class="app-title">
            <ul class="app-breadcrumb breadcrumb side">
                <li class="breadcrumb-item active"><a href="#"><b>Danh sách sản phẩm</b></a></li>
            </ul>
            <div id="clock"></div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="tile">
                    <div class="tile-body">
                        <div class="row element-button">
                            <div class="col-sm-2" style="float:left;">
              
                              <a class="btn btn-add btn-sm" href="/admin/create" title="Thêm"><i class="fas fa-plus"></i>
                                Tạo mới sản phẩm</a>
                            </div>
                            <div class="search">
                                <form action="/admin" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <input type="text" name="search" id="t1" placeholder="Tìm kiếm sản phẩm..." />
                                    <input type="submit" id="b1" value="Tìm kiếm" />
                                </form>
                            </div>
                          </div>
                        <table class="table table-hover table-bordered" id="sampleTable">
                            <thead>
                                <tr>
                                    <th>Mã</th>
                                    <th>Tên sản phẩm</th>
                                    <th>Hãng</th>
                                    <th>Ảnh</th>
                                    <th>Số lượng ban đầu</th>
                                    <th>Số lượng còn</th>
                                    <th>Giá tiền</th>
                                    <th>Màu</th>
                                    <th>Size</th>
                                    <th>Miêu tả </th>
                                    <th>Loại</th>
                                    <th>Danh mục</th>
                                </tr>
                            </thead>
                            @foreach($products as $product)
                            <tbody>
                                <tr>
                                    <td>{{ $product->MaSP }}</td>
                                    <td>{{ $product->TenSP }}</td>
                                    <td>{{ $product->Hang }}</td>
                                    <td><img src="{{ asset('upload/' . $product->Image) }}" alt="" width="100px;"></td>
                                    <td>{{ $product->SoLuong}}</td>
                                    <td>{{ $product->Soluongcon}}</td>
                                    <td style="color: rgb(201, 58, 58)"><?php echo number_format( $product->Gia,0,",", ".")?><u>đ</u></td>
                                    <td>{{ $product->Color}}</td>
                                    <td>{{ $product->Size }}</td>
                                    <td>{{ $product->Note }}</td>
                                    <td>{{ $product->Loai }}</td>
                                    <td>{{ $product->DanhMuc }}</td>
                                    <td><a href="/admin/delete/{{ $product->MaSP }}"><button onclick="return confirm('Bạn có chắc chắn xóa sản phẩm này ?')" class="btn btn-primary btn-sm trash" type="button" title="Xóa"
                                            onclick="myFunction(this)"><i class="fas fa-trash-alt"></i> 
                                        </button></a>
                                        <a href="/admin/update/{{ $product->MaSP }}"><button class="btn btn-primary btn-sm edit" type="button" title="Sửa" id="show-emp" data-toggle="modal"
                      data-target="#ModalUP"><i class="fas fa-edit"></i></button></a>
                                       
                                    </td>
                                </tr>
                      
                            </tbody>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <main class="app-content" id="content2">
        <div class="app-title">
            <ul class="app-breadcrumb breadcrumb side">
                <li class="breadcrumb-item active"><a href="#"><b>Danh sách khách hàng</b></a></li>
            </ul>
            <div id="clock"></div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="tile">
                    <div class="tile-body">
                        <table class="table table-hover table-bordered" id="sampleTable">
                            <thead>
                                <tr>
                                    <th>Mã KH</th>
                                    <th>Họ và tên</th>
                                    <th>Email</th>
                                    <th>Địa chỉ</th>
                                    <th>SĐT</th>
                                    <th>Tên Đăng nhập</th>
                                </tr>
                            </thead>
                            @foreach($khachhang as $khachhang)
                            <tbody>
                                <tr>
                                    <td>{{ $khachhang->MaKH}}</td>
                                    <td>{{ $khachhang->TenKH}}</td>
                                    <td>{{ $khachhang->Email}}</td>
                                    <td>{{ $khachhang->DiaChi}}</td>
                                    <td>{{ $khachhang->SDT}}</td>
                                    <td>{{ $khachhang->TenDN}}</td>
                                    <td><a href="/admin/khachhang/delete/{{ $khachhang->MaKH }}"><button onclick="return confirm('Bạn có chắc chắn xóa người dùng này ?')" class="btn btn-primary btn-sm trash" type="button" title="Xóa"
                                            onclick="myFunction(this)"><i class="fas fa-trash-alt"></i> 
                                        </button></a>
                                       
                                    </td>
                                </tr>
                      
                            </tbody>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <main class="app-content" id="content3">
        <div class="app-title">
            <ul class="app-breadcrumb breadcrumb side">
                <li class="breadcrumb-item active"><a href="#"><b>Danh sách Commnent</b></a></li>
            </ul>
            <div id="clock"></div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="tile">
                    <div class="tile-body">
                        <table class="table table-hover table-bordered" id="sampleTable">
                            <thead>
                                <tr>
                                    <th>Mã KH</th>
                                    <th>Họ và tên</th>
                                    <th>Tên sản phẩm</th>
                                    <th>Nội dung</th>
                                    <th>Thời gian</th>
                                </tr>
                            </thead>
                            @foreach($comment as $comment)
                            <tbody>
                                <tr>
                                    <td>{{ $comment->MaKH}}</td>
                                    <td>{{ $comment->TenKH}}</td>
                                    <td>{{ $comment->TenSP}}</td>
                                    <td>{{ $comment->content}}</td>
                                    <td>{{ $comment->time_create}}</td>
                                    <td><a href="/admin/comment/delete/{{ $comment->MaCMT }}"><button onclick="return confirm('Bạn có chắc chắn xóa comment ?')" class="btn btn-primary btn-sm trash" type="button" title="Xóa"
                                            onclick="myFunction(this)"><i class="fas fa-trash-alt"></i> 
                                        </button></a>
                                       
                                    </td>
                                </tr>
                      
                            </tbody>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <main class="app-content" id="content4">
        <div class="app-title">
            <ul class="app-breadcrumb breadcrumb side">
                <li class="breadcrumb-item active"><a href="#"><b>Danh sách đơn đặt hàng</b></a></li>
            </ul>
            <div id="clock"></div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="tile">
                    <div class="tile-body">
                        <h4>Đang giao hàng</h4>
                        <table class="table table-hover table-bordered" id="sampleTable">
                            <thead>
                                <tr>
                                    <th>Mã Đơn</th>
                                    <th>Họ và tên</th>
                                    <th>Tên sản phẩm</th>
                                    <th>Số lượng</th>
                                    <th>Tổng tiền</th>
                                    <th>Phương thức thanh toán</th>
                                    <th>Thời gian đặt hàng</th>
                                    <th>Tình trạng</th>
                                </tr>
                            </thead>
                            @foreach($dondathang1 as $dondathang1)
                            <tbody>
                                <tr>
                                    <td>{{ $dondathang1->MaDon}}</td>
                                    <td>{{ $dondathang1->TenKH}}</td>
                                    <td>{{ $dondathang1->TenSP}}</td>
                                    <td>{{ $dondathang1->SoLuongDH}}</td>
                                    <td style="color: rgb(201, 58, 58)">{{$dondathang1->Gia}}<u>đ</u></td>
                                    <td>{{ $dondathang1->Phuongthuc}}</td>
                                    <td>{{ $dondathang1->ThoiGianDH}}</td>
                                    <td>{{ $dondathang1->status}}</td>
                                </tr>
                            </tbody>
                            @endforeach
                        </table>
                        <br><br>
                        <h4>Đã nhận hàng</h4>
                        <table class="table table-hover table-bordered" id="sampleTable">
                            <thead>
                                <tr>
                                    <th>Mã Đơn</th>
                                    <th>Họ và tên</th>
                                    <th>Tên sản phẩm</th>
                                    <th>Số lượng</th>
                                    <th>Tổng tiền</th>
                                    <th>Phương thức thanh toán</th>
                                    <th>Thời gian đặt hàng</th>
                                    <th>Tình trạng</th>
                                    <th>Thời gian nhận hàng</th>
                                </tr>
                            </thead>
                            @foreach($dondathang2 as $dondathang2)
                            <tbody>
                                <tr>
                                    <td>{{ $dondathang2->MaDon}}</td>
                                    <td>{{ $dondathang2->TenKH}}</td>
                                    <td>{{ $dondathang2->TenSP}}</td>
                                    <td>{{ $dondathang2->SoLuongDH}}</td>
                                    <td style="color: rgb(201, 58, 58)">{{$dondathang2->Gia}}<u>đ</u></td>
                                    <td>{{ $dondathang2->Phuongthuc}}</td>
                                    <td>{{ $dondathang2->ThoiGianDH}}</td>
                                    <td>{{ $dondathang2->status}}</td>
                                    <td>{{ $dondathang2->ThoiGianNH}}</td>
                                </tr>
                            </tbody>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <main class="app-content" id="content6">
        <div class="app-title">
            <ul class="app-breadcrumb breadcrumb side">
                <li class="breadcrumb-item active"><a href="#"><b>Danh sách người giao hàng</b></a></li>
            </ul>
            <div id="clock"></div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="tile">
                    <div class="tile-body">
                    <div class="col-sm-2" style="float:left;">
              
                        <a class="btn btn-add btn-sm" href="/admin/giaohang/create" title="Thêm"><i class="fas fa-plus"></i>
                            Tạo mới tài khoản giao hàng</a>
                    </div>
                        <table class="table table-hover table-bordered" id="sampleTable">
                            <thead>
                                <tr>
                                    <th>Mã GH</th>
                                    <th>Họ và tên</th>
                                    <th>Địa chỉ</th>
                                    <th>SĐT</th>
                                    <th>Tên ĐN</th>
                                </tr>
                            </thead>
                            @foreach($giaohang as $giaohang)
                            <tbody>
                                <tr>
                                    <td>{{ $giaohang->MaGH}}</td>
                                    <td>{{ $giaohang->TenGH}}</td>
                                    <td>{{ $giaohang->DiaChi}}</td>
                                    <td>{{ $giaohang->SDT}}</td>
                                    <td>{{ $giaohang->TenDN}}</td>
                                </tr>
                            </tbody>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <main class="app-content" id="content5">
        <div class="app-title">
            <ul class="app-breadcrumb breadcrumb side">
                <li class="breadcrumb-item active"><a href="#"><b>Thống kê</b></a></li>
            </ul>
            <div id="clock"></div>
        </div>
        <div class="content" style="padding: 20px 100px 50px 100px">
            <div class="doanhthu">
                <i class="fa-solid fa-arrow-trend-up"></i>
                <div class="info">
                    <h4>Doanh thu của cửa hàng<h4>
                    <p style="font-weight: normal; font-size: 20px; padding-top: 20px">Tổng doanh thu:<span style="margin-left: 10px; color: rgb(201, 58, 58)"><?php echo number_format( $doanhthu,0,",", ".")?><u>đ</u></span></p>
                </div>
            </div>
            <div class="sanpham">
                <i class="fa-solid fa-database"></i>
                <div class="info">
                    <h4>Sản phẩm bán chạy nhất<h4>
                    <p style="font-weight: normal; font-size: 20px; padding-top: 20px">{{$sanphambanchay}}</p>
                </div>
            </div>
            <div class="khachhang">
            <i class="fa-solid fa-address-book"></i>
                <div class="info">
                    <h4>Số lượng khách hàng<h4>
                    <p style="font-weight: normal; font-size: 20px; padding-top: 20px">Số lượng khách hàng đã đăng ký: <span style="margin-left: 10px; color: rgb(201, 58, 58)">{{$soluongkh}}</p></span>
                </div>
            </div>
            <div class="donhang">
                <i class="fa-solid fa-wallet"></i>
                <div class="info">
                    <h4>Đơn hàng <h4>
                    <p style="font-weight: normal; font-size: 20px; padding-top: 20px">Tổng số lượng đơn hàng: <span style="margin-left: 10px; color: rgb(201, 58, 58)">{{$soluongdh}}</p></span>
                </div>
            </div>
            <div class="donhangmoi"></div>
        </div>
    </main>
<!--
MODAL
-->

    <!-- Essential javascripts for application to work-->
    <script src="js/jquery-3.2.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="src/jquery.table2excel.js"></script>
    <script src="js/main.js"></script>
    <!-- The javascript plugin to display page loading on top-->
    <script src="js/plugins/pace.min.js"></script>
    <!-- Page specific javascripts-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
    <!-- Data table plugin-->
    <script type="text/javascript" src="js/plugins/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="js/plugins/dataTables.bootstrap.min.js"></script>
    <script type="text/javascript">
        $('#sampleTable').DataTable();
        //Thời Gian
    function time() {
      var today = new Date();
      var weekday = new Array(7);
      weekday[0] = "Chủ Nhật";
      weekday[1] = "Thứ Hai";
      weekday[2] = "Thứ Ba";
      weekday[3] = "Thứ Tư";
      weekday[4] = "Thứ Năm";
      weekday[5] = "Thứ Sáu";
      weekday[6] = "Thứ Bảy";
      var day = weekday[today.getDay()];
      var dd = today.getDate();
      var mm = today.getMonth() + 1;
      var yyyy = today.getFullYear();
      var h = today.getHours();
      var m = today.getMinutes();
      var s = today.getSeconds();
      m = checkTime(m);
      s = checkTime(s);
      nowTime = h + " giờ " + m + " phút " + s + " giây";
      if (dd < 10) {
        dd = '0' + dd
      }
      if (mm < 10) {
        mm = '0' + mm
      }
      today = day + ', ' + dd + '/' + mm + '/' + yyyy;
      tmp = '<span class="date"> ' + today + ' - ' + nowTime +
        '</span>';
      document.getElementById("clock").innerHTML = tmp;
      clocktime = setTimeout("time()", "1000", "Javascript");

      function checkTime(i) {
        if (i < 10) {
          i = "0" + i;
        }
        return i;
      }
    }
    function onchange_khachhang(){
      var a = document.getElementById("content1");
      var b = document.getElementById("content2");
      var c = document.getElementById("content3");
      var d = document.getElementById("content4");
      var e = document.getElementById("content5");
      var f = document.getElementById("content6");
      a.style.opacity = 0;
      a.style.visibility = "hidden";
      b.style.opacity = 1;
      b.style.visibility = "visible"  
      c.style.opacity = 0;
      c.style.visibility = "hidden";
      d.style.opacity = 0;
      d.style.visibility = "hidden";
      e.style.opacity = 0;
      e.style.visibility = "hidden";
      f.style.opacity = 0;
      f.style.visibility = "hidden";
    }
    function onchange_sanpham(){
      var a = document.getElementById("content1");
      var b = document.getElementById("content2");
      var c = document.getElementById("content3");
      var d = document.getElementById("content4");
      var e = document.getElementById("content5");
      var f = document.getElementById("content6");
      a.style.opacity = 1;
      a.style.visibility = "visible";
      b.style.opacity = 0;
      b.style.visibility = "hidden"  
      c.style.opacity = 0;
      c.style.visibility = "hidden";
      d.style.opacity = 0;
      d.style.visibility = "hidden";
      e.style.opacity = 0;
      e.style.visibility = "hidden";
      f.style.opacity = 0;
      f.style.visibility = "hidden";
    }
    function onchange_comment(){
      var a = document.getElementById("content1");
      var b = document.getElementById("content2");
      var c = document.getElementById("content3");
      var d = document.getElementById("content4");
      var e = document.getElementById("content5");
      var f = document.getElementById("content6");
      a.style.opacity = 0;
      a.style.visibility = "hidden"
      b.style.opacity = 0;
      b.style.visibility = "hidden"  
      c.style.opacity = 1;
      c.style.visibility = "visible";
      d.style.opacity = 0;
      d.style.visibility = "hidden";
      e.style.opacity = 0;
      e.style.visibility = "hidden";
      f.style.opacity = 0;
      f.style.visibility = "hidden";
    }
    function onchange_donhang(){
      var a = document.getElementById("content1");
      var b = document.getElementById("content2");
      var c = document.getElementById("content3");
      var d = document.getElementById("content4");
      var e = document.getElementById("content5");
      var f = document.getElementById("content6");
      a.style.opacity = 0;
      a.style.visibility = "hidden"
      b.style.opacity = 0;
      b.style.visibility = "hidden"  
      c.style.opacity = 0;
      c.style.visibility = "hidden";
      d.style.opacity = 1;
      d.style.visibility = "visible";
      e.style.opacity = 0;
      e.style.visibility = "hidden";
      f.style.opacity = 0;
      f.style.visibility = "hidden";
    }
    function onchange_thongke(){
      var a = document.getElementById("content1");
      var b = document.getElementById("content2");
      var c = document.getElementById("content3");
      var d = document.getElementById("content4");
      var e = document.getElementById("content5");
      var f = document.getElementById("content6");
      a.style.opacity = 0;
      a.style.visibility = "hidden"
      b.style.opacity = 0;
      b.style.visibility = "hidden"  
      c.style.opacity = 0;
      c.style.visibility = "hidden";
      d.style.opacity = 0;
      d.style.visibility = "hidden";
      e.style.opacity = 1;
      e.style.visibility = "visible";
      f.style.opacity = 0;
      f.style.visibility = "hidden";
    }
    function onchange_giaohang(){
      var a = document.getElementById("content1");
      var b = document.getElementById("content2");
      var c = document.getElementById("content3");
      var d = document.getElementById("content4");
      var e = document.getElementById("content5");
      var f = document.getElementById("content6");
      a.style.opacity = 0;
      a.style.visibility = "hidden"
      b.style.opacity = 0;
      b.style.visibility = "hidden"  
      c.style.opacity = 0;
      c.style.visibility = "hidden";
      d.style.opacity = 0;
      d.style.visibility = "hidden";
      e.style.opacity = 0;
      e.style.visibility = "hidden";
      f.style.opacity = 1;
      f.style.visibility = "visible";
    }
    </script>

</body>
</html>
