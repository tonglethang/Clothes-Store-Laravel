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
      <li><button class="select">Quản lí đơn đặt hàng</button></li>
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
                            <div class="col-sm-2">
              
                              <a class="btn btn-add btn-sm" href="/admin/create" title="Thêm"><i class="fas fa-plus"></i>
                                Tạo mới sản phẩm</a>
                            </div>
                            
                          </div>
                        <table class="table table-hover table-bordered" id="sampleTable">
                            <thead>
                                <tr>
                                    <th>Mã</th>
                                    <th>Tên sản phẩm</th>
                                    <th>Hãng</th>
                                    <th>Ảnh</th>
                                    <th>Số lượng</th>
                                    <th>Tình trạng</th>
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
                                    <td><span class="badge bg-success">Còn hàng</span></td>
                                    <td>{{ $product->Gia }}</td>
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
      a.style.opacity = 0;
      a.style.visibility = "hidden";
      b.style.opacity = 1;
      b.style.visibility = "visible"  
      c.style.opacity = 0;
      c.style.visibility = "hidden";
    }
    function onchange_sanpham(){
      var a = document.getElementById("content1");
      var b = document.getElementById("content2");
      var c = document.getElementById("content3");
      a.style.opacity = 1;
      a.style.visibility = "visible";
      b.style.opacity = 0;
      b.style.visibility = "hidden"  
      c.style.opacity = 0;
      c.style.visibility = "hidden";
    }
    function onchange_comment(){
      var a = document.getElementById("content1");
      var b = document.getElementById("content2");
      var c = document.getElementById("content3");
      a.style.opacity = 0;
      a.style.visibility = "hidden"
      b.style.opacity = 0;
      b.style.visibility = "hidden"  
      c.style.opacity = 1;
      c.style.visibility = "visible";
      
    }
    </script>

</body>
</html>
