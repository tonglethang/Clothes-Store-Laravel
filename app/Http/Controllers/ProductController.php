<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\KhachHang;
use App\Models\Comment;
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

        $tmp3 = DB::table('sanpham')
                ->orderBy('Gia', 'desc')
                ->get();
        $products3 = $tmp3->take(8);
        $products3->all();
        // trả về view hiển thị danh sách 
        return view('welcome', compact('products1', 'products2', 'products3'));
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
            return view('cuahang', compact('products'));
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
    public function admin(){
        $this->Authlogin();
        $products = DB::table('sanpham')->get();
        $products->all();
        $khachhang = DB::table('khachhang')->get();
        $khachhang->all();
        $comment = DB::table('comment')->join('khachhang', 'comment.MaKH', 'khachhang.MaKH')
                                       ->join('sanpham', 'comment.MaSP', 'sanpham.MaSP')
                                       ->get();
        $comment->all();
        // trả về view hiển thị danh sách 
        return view('admin.welcome', compact('products', 'khachhang', 'comment'));
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
}