<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\KhachHang;
use App\Models\Comment;
use App\Models\DonDatHang;
use App\Models\GiaoHang;
use Illuminate\Support\Facades\DB;
use Session;
use Carbon\Carbon;

class ProductController extends Controller
{

    public function index( Request  $request){
        // lấy ra toàn bộ dl
        $tmp1 = DB::table('sanpham')
                ->orderBy('MaSP', 'desc')
                ->get();
        $products1 = $tmp1->take(8);
        $products1->all();
        
        $tmp2 = DB::table('sanpham')
                ->orderBy('Gia', 'desc')
                ->get();
        $products2 = $tmp2->take(8);
        $products2->all();


        // trả về view hiển thị danh sách 
        return view('welcome', compact('products1', 'products2'));
    }
    //goi y timkiem
    public function action(Request $request)
    {
        return Product::select('TenSP')
            ->where('TenSP', 'like', "%{$request->term}%")
            ->pluck('TenSP');
    }

    //ham chi tiet san pham
    public function chitiet($MaSP){
        $products = DB::table('sanpham')->where('MaSP', $MaSP)->get();
        $tmp = Product::select('Loai')->where('MaSP', $MaSP)->get();
        
        $comment = DB::table('comment')->join('sanpham', 'comment.MaSP', 'sanpham.MaSP')
                                        ->join('khachhang', 'comment.MaKH', 'khachhang.MaKH')
                                        ->where('comment.MaSP', $MaSP)
                                        ->get();

        $product2 = Product::where('Loai', $tmp[0]['Loai'])->get();
        return view('chitiet', compact('products', 'product2', 'comment'));

    }
    // ham cua hang
    public function shop( Request  $request){
        $tmp = $request->txtSearch; 
        if($tmp != null){
            $products = Product::where('TenSP', 'like', "%{$tmp}%")->paginate(12);
            $tmp3 = DB::table('sanpham')
            ->orderBy('MaSP', 'desc')
            ->get();
            $product2 = $tmp3->take(8);
            $product2->all();
            return view('cuahang', compact('products', 'product2'));
        }
        else{
            $products = DB::table('sanpham')->paginate(12);
            $tmp3 = DB::table('sanpham')
            ->orderBy('MaSP', 'desc')
            ->get();
            $product2 = $tmp3->take(8);
            $product2->all();
            return view('cuahang', compact('products', 'product2'));
        }
    }
    public function shop2($key){
        $products = Product::where('Loai', $key)->orWhere('DanhMuc','like', "%{$key}%")->orWhere('Hang', $key)->paginate(12);
        $tmp3 = DB::table('sanpham')
        ->orderBy('MaSP', 'desc')
        ->get();
        $product2 = $tmp3->take(8);
        $product2->all();
        return view('cuahang', compact('products', 'product2'));
    }

    // login admin 
    public function Authlogin(){
        $admin_name = Session::get('name');
        if($admin_name){
            return redirect('admin');
        }
        else{
            return redirect('/admin/login')->send();
        }
    }
    public function login(Request $request){
        $data['name'] = $request->name;
        $data['pass'] = $request->pass;
        $message = null;
        if($data['name'] == "admin" && $data['pass'] == "123"){
            Session::put('name', $data['name']);
            Session::put('pass', $data['pass']);
            return redirect('/admin');
        }
        else{
            $message = "Tên đăng nhập hoặc mật khẩu không đúng";
            return view('admin.login', compact('message'));
        }
    }
    //logout admin
    public function logout(){
        Session::put('name', null);
        Session::put('pass', null);
        return redirect('/');
    }
    public function admin(Request $request){
        $this->Authlogin();
        if($request->search){
            $products = DB::table('sanpham')->where('TenSP','like', "%{$request->search}%")->get();
            $products->all();
        }
        else{
            $products = DB::table('sanpham')->get();
            $products->all();
        }
        $khachhang = DB::table('khachhang')->get();
        $khachhang->all();

        $dondathang1 = DB::table('dondathang')->join('khachhang', 'dondathang.MaKH', 'khachhang.MaKH')
                                            ->join('sanpham', 'dondathang.MaSP', 'sanpham.MaSP')
                                            ->where('status', 'Đang giao hàng')
                                            ->get();
        $dondathang1->all();
        $dondathang2 = DB::table('dondathang')->join('khachhang', 'dondathang.MaKH', 'khachhang.MaKH')
                                            ->join('sanpham', 'dondathang.MaSP', 'sanpham.MaSP')
                                            ->where('status', 'Đã nhận hàng')
                                            ->get();
        $dondathang2->all();


        $comment = DB::table('comment')->join('khachhang', 'comment.MaKH', 'khachhang.MaKH')
                                       ->join('sanpham', 'comment.MaSP', 'sanpham.MaSP')
                                       ->get();
        $comment->all();

        //thống kê doanh thu
        $tmp1 = DonDatHang::select('Tongtien')->get();
        $doanhthu = null;
        for($i = 0; $i < $tmp1->count(); $i++){
            $doanhthu += $tmp1[$i]['Tongtien'];
        }
        //sản phẩm bán chạy nhất
        $tmp2 = Product::select('TenSP','SoLuong', 'Soluongcon')->get();
        $soluongbanra = 0;
        $max = 0;
        $vitri = null;
        for($i = 0; $i < $tmp2->count(); $i++){
            $soluongbanra = $tmp2[$i]['SoLuong'] - $tmp2[$i]['Soluongcon'];
            if($soluongbanra > $max){
                $max = $soluongbanra;
                $vitri = $i;
            }
        }
        $sanphambanchay = $tmp2[$vitri]['TenSP'];
        //số lượng khách hàng
        $soluongkh = DB::table('khachhang')->count();
        //số lượng đơn hàng đang giao
        $soluongdh = DB::table('dondathang')->count();
        //giao hang
        $giaohang = DB::table('giaohang')->get();
        $giaohang->all();


        // // trả về view hiển thị danh sách 
        return view('admin.welcome', compact('products', 'khachhang', 'comment', 'dondathang1','dondathang2', 'doanhthu', 'sanphambanchay', 'soluongkh', 'soluongdh', 'giaohang'));
    }
    public function deleteKH($MaKH){
    // Tìm đến đối tượng muốn xóa
        $this->Authlogin();
        KhachHang::where('MaKH', $MaKH )->delete();
        return redirect('/admin');
    }
    public function deleteCMT($MaCMT){
        // Tìm đến đối tượng muốn xóa
        $this->Authlogin();
        Comment::where('MaCMT', $MaCMT )->delete();
        return redirect('/admin');
    }
    // tao product
    public function create(){
        $this->Authlogin();
        return view('admin.create');
    }

    //luu product
    public function store(Request $request){
        // Kiểm tra xem dữ liệu từ client gửi lên bao gốm những gì
        //  dd($request);
        $this->Authlogin();
        if($request->has('image_upload')){                             
            $file = $request->image_upload;    
            $ext = $request->image_upload->extension();     
            $file_name = time().'.'.$ext;
            // dd($file_name);
            $file->move(public_path('upload'), $file_name);
        }
        $data['TenSP'] = $request->TenSP;
        $data['Hang'] = $request->Hang;
        $data['SoLuong'] = $request->SoLuong;
        $data['Soluongcon'] =  $request->SoLuong;
        $data['Color'] = $request->Color;
        $data['Gia'] = $request->Gia;
        $data['Image'] = $file_name;
        $data['Size'] = $request->Size;
        $data['Note'] = $request->Note;
        $data['Loai'] = $request->Loai;
        $data['DanhMuc'] = $request->DanhMuc;
        // // // Tạo mới  với các dữ liệu tương ứng với dữ liệu được gán trong $data
        Product::create($data);
        return redirect('/admin');
    }


    public function edit($MaSP){
        $this->Authlogin();

        $products = DB::table('sanpham')->where('MaSP', $MaSP)->get();

        return view('admin.edit', compact('products'));
    }

    public function update(Request $request, $MaSP){
        $this->Authlogin();
        if($request->has('image_upload')){                             
            $file = $request->image_upload;    
            $ext = $request->image_upload->extension();     
            $file_name = time().'.'.$ext;
            // dd($file_name);
            $file->move(public_path('upload'), $file_name);
        }
        else{
            $file_name = $request->Image;
        }
        // gán dữ liệu gửi lên vào biến data
        $data['TenSP'] = $request->TenSP;
        $data['Hang'] = $request->Hang;
        $data['SoLuong'] = $request->SoLuong;
        $data['Soluongcon'] = $request->Soluongcon;
        $data['Color'] = $request->Color;
        $data['Gia'] = $request->Gia;
        $data['Image'] = $file_name;
        $data['Size'] = $request->Size;
        $data['Note'] = $request->Note;
        $data['Loai'] = $request->Loai;
        $data['DanhMuc'] = $request->DanhMuc;

        // Update product
        Product::where('MaSP', $MaSP )->update(['TenSP' => $data['TenSP'],
                            'Hang'=> $data['Hang'],
                            'Soluong'=> $data['SoLuong'],
                            'Soluongcon'=> $data['Soluongcon'],
                            'Color'=> $data['Color'],
                            'Gia'=> $data['Gia'],
                            'Image'=> $data['Image'],
                            'Size'=> $data['Size'],
                            'Note'=> $data['Note'],
                            'Loai'=> $data['Loai'],
                            'DanhMuc'=> $data['DanhMuc']
                        ]);
        return redirect('/admin');
    }
    public function delete($MaSP){
        // Tìm đến đối tượng muốn xóa
        $this->Authlogin();
        Product::where('MaSP', $MaSP )->delete();
        return redirect('/admin');
    }

    //Giao hang
    public function create_gh(Request $request){
        $data['TenGH'] = $request->TenGH;
        $data['DiaChi'] = $request->DiaChi;
        $data['SDT'] = $request->SDT;
        $data['TenDN'] = $request->TenDN;
        $data['Pass'] = $request->Pass;
        GiaoHang::create($data);
        return redirect('/admin');
    }
    public function giaohang(){        
        $dondathang1 = DB::table('dondathang')->join('khachhang', 'dondathang.MaKH', 'khachhang.MaKH')
                                                ->join('sanpham', 'dondathang.MaSP', 'sanpham.MaSP')
                                                ->where('status', 'Đang giao hàng')
                                                ->get();
        $dondathang1->all();
        $dondathang2 = DB::table('dondathang')->join('khachhang', 'dondathang.MaKH', 'khachhang.MaKH')
                                                ->join('sanpham', 'dondathang.MaSP', 'sanpham.MaSP')
                                                ->where('status', 'Đã nhận hàng')
                                                ->get();
        $dondathang2->all();

        return view('giaohang.welcome', compact('dondathang1', 'dondathang2'));
    }
    public function xacnhan_gh($MaDon){
        DonDatHang::where('MaDon', $MaDon)->update(['status'=> 'Đã nhận hàng',
        'ThoiGianNH'=>Carbon::now('Asia/Ho_Chi_Minh')]);
        return redirect()->back();
    }
    public function AuthloginGH(){
        $admin_name = Session::get('TenGH');
        if($admin_name){
            return redirect('/giaohang');
        }
        else{
            return redirect('/giaohang/login')->send();
        }
    }
    public function login_gh(Request $request){
        $tendangnhap = $request->name;
        $pass = $request->pass;
        $tmp1 = GiaoHang::select('TenDN')->get();
        $tmp2 = GiaoHang::select('Pass')->get();
        $message = "Tên đăng nhập hoặc mật khẩu không đúng";
        for($i = 0; $i < $tmp1->count(); $i++){
            if( $tendangnhap == $tmp1[$i]['TenDN'] && $pass == $tmp2[$i]['Pass']){
                Session::put('TenGH', $tendangnhap);
                $this-> AuthloginGH();
                return redirect('/giaohang');
            }
        }
        return view('giaohang.login', compact('message'));
    }
}