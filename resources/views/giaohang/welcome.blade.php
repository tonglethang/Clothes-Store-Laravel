<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giao hàng</title>
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
      <li><a onclick="return confirm('Bạn có muốn đăng xuất ?')" class="app-nav__item" href="/giaohang/logout"><i class='bx bx-log-out bx-rotate-180'></i> </a>

      </li>
    </ul>
  </header>
  <!-- Sidebar menu-->
  <div class="app-sidebar__overlay" data-toggle="sidebar"></div>
  <aside class="app-sidebar">
    <div class="app-sidebar__user"><img class="app-sidebar__user-avatar" src="{{ asset('image/admin.jpg') }}"  width="50px"
        alt="User Image">
      <div>
        <p class="app-sidebar__user-name"><b>Giao hàng</b></p>
        <br>
        <p class="app-sidebar__user-designation">{{session('TenGH')}}</p>
      </div>
    </div>
    <hr>
    <ul class="app-menu">
      <li><button class="select" onclick="onchange_sanpham()">Quản lí đơn đặt hàng</button></li>
    </ul>
  </aside>
  <main class="app-content">
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
                                    <th>Xác nhận đã giao</th>
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
                                    <td><a href="/giaohang/xacnhan/{{ $dondathang1->MaDon}}"><button onclick="return confirm('Xác nhận đã giao hàng thành công ?')" class="btn btn-primary btn-sm edit" type="button" title="Xác nhận" id="show-emp" data-toggle="modal"
                      data-target="#ModalUP">  Xác nhận  </button></a></td>
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

</body>
</html>
