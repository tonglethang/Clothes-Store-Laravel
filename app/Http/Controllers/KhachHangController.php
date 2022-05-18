<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KhachHang;
use App\Models\Product;
use App\Models\Comment;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Session;
use Carbon\Carbon;

class KhachHangController extends Controller
{   
    public function kiemtra($email, $sdt, $tendangnhap, $pass, $re_pass){
        $message[0] = null;
        $message[1] = null;
        $message[2] = null;
        $message[3] = null;
        $message[4] = null;
        $message[5] = null;
        //kiêm tra email
        $check = "/([a-z0-9_]+|[a-z0-9_]+\.[a-z0-9_]+)@(([a-z0-9]|[a-z0-9]+\.[a-z0-9]+)+\.([a-z]{2,4}))/i"; 
        if(!preg_match($check, $email)){
            $message[0] = "-Email không đúng định dạng";
        }
        $email_check = KhachHang::select('Email')->where('Email', $email)->count();
        if($email_check > 0){
            $message[1] = "-Email đã tồn tại";
        }
        //kiem tra tên đăng nhập
        $username = KhachHang::select('TenDN')->where('TenDN', $tendangnhap)->count();
        if ($username > 0){
            $message[2] = "-Tên đăng nhập đã tồn tại";
        }        
        if(strlen($tendangnhap) > 12){
            $message[3] = "-Tên đăng nhập chỉ tối đa 12 kí tự";
        }
        //kiểm tra số điện thoại
        $tmp = $sdt;
        $sdt_check = KhachHang::select('SDT')->where('SDT', $sdt)->count();
        if(strlen($tmp) < 9 || strlen($tmp)> 12 || $sdt_check > 0){
            $message[4] = "-Số điện thoại không hợp lệ hoặc đã tồn tại";
        }
        
        //kiểm tra nhập lại pass
        if($re_pass != $pass){
            $message[5] = "-Mật khẩu nhập lại không trùng khớp";
        }
        return $message;
    }
    public function dangky( Request $request){
        $data['TenKH'] = $request->name;
        Session::put('TenKH', $data['TenKH']);
        $data['DiaChi'] = $request->diachi;
        Session::put('DiaChi', $data['DiaChi']);
        $data['Email'] = $request->email;
        Session::put('Email', $data['Email']);
        $data['SDT'] = $request->SDT;
        Session::put('SDT', $data['SDT']);
        $data['TenDN'] = $request->user_name;
        Session::put('TenDN', $data['TenDN']);
        $data['Pass'] = $request->pass;
        Session::put('Pass', $data['Pass']);
        $re_pass = $request->re_pass;
        $message = null;
        $message = $this->kiemtra($data['Email'], $data['SDT'], $data['TenDN'], $data['Pass'],$re_pass);
        //kiểm tra
        if($message[0] != null || $message[1] != null || $message[2] != null || $message[3] != null || $message[4] != null || $message[5] != null){
            return redirect()->back()->with(['message1'=>$message[0], 'message2'=>$message[1], 'message3'=>$message[2], 'message4'=>$message[3], 'message5'=>$message[4], 'message6'=>$message[5]])->withInput();
        }
        else{
            $maxacnhan = rand(10000, 99999);
            Session::put('maxacnhan', $maxacnhan);
            $content = 'Mã xác nhận email của bạn là: '.$maxacnhan;
            $mail_data = [
                'recipient'=> $request->email,
                'fromEmail'=> 'tsdstoredau@gmail.com',
                'fromName'=> "TDS store",
                'subject'=>"Xác nhận tài khoản email",
                'body'=>$content,
            ];
            Mail::send('email-template', $mail_data, function($message_email) use ($mail_data){
                $message_email->to($mail_data['recipient'])
                                ->from($mail_data['fromEmail'], $mail_data['fromName'])
                                ->subject($mail_data['subject']);
            });
            // KhachHang::create($data);
            // Session::put('user_name', $data['TenDN']);
            // Session::put('password', $data['Pass']);
            return redirect('/khachhang/xacnhan');
        }
    }
    public function xacnhan(Request $request){
            if(Session::get('maxacnhan') != $request->maxacnhan){
                return redirect('/khachhang/xacnhan')->with('message',"Mã xác nhận không trùng khớp !");
            }
            else{
                $data['TenKH'] = Session::get('TenKH');
                Session::put('TenKH', null);
                $data['DiaChi'] = Session::get('DiaChi');
                Session::put('DiaChi', null);
                $data['Email']= Session::get('Email');
                Session::put('Email', null);
                $data['SDT']  = Session::get('SDT');
                Session::put('SDT', null);
                $data['TenDN']  = Session::get('TenDN');
                Session::put('TenDN', null);
                $data['Pass'] = Session::get('Pass');
                Session::put('Pass', null);
                KhachHang::create($data);
                $MaKH =  KhachHang::select('MaKH')->where('TenDN', $data['TenDN'])->get();
                Session::put('MaKH', $MaKH[0]['MaKH']);
                Session::put('username', $data['TenDN']);
                Session::put('password', $data['Pass']);

                return redirect('/');
            }
    }
    public function dangnhap(Request $request){
        $tendangnhap = $request->username;
        $pass = $request->password;
        $tmp1 = KhachHang::select('TenDN')->get();
        $tmp2 = KhachHang::select('Pass')->get();
        $MaKH =  KhachHang::select('MaKH')->where('TenDN', $tendangnhap)->get();
        $message1 = null;
        for($i = 0; $i < $tmp1->count(); $i++){
            if( $tendangnhap == $tmp1[$i]['TenDN'] && $pass == $tmp2[$i]['Pass']){
                Session::put('username', $tendangnhap);
                Session::put('password', $pass);
                Session::put('MaKH', $MaKH[0]['MaKH']);
                $this->AuthDangnhap();
                return redirect('/');
            }
        }
        return redirect('/')->with('message1','Tên đăng nhập hoặc mật khẩu không chính xác');
    }
    public function AuthDangnhap(){
        $username = Session::get('username');
        $MaKH = Session::get('MaKH');
        if($username){
            return redirect('/')->with([$username, $MaKH]);
        }
        else{
            return redirect('/')->send();
        }
    }
    public function forgetpass(Request $request){
        $email= $request->Email;
        $count =  KhachHang::select('Email')->where('Email', $email)->count();
        if($count != 0){
            $pass =  KhachHang::select('Pass')->where('Email', $email)->get();
            $content = 'Mật khẩu của bạn là: '.$pass[0]['Pass'];
            $mail_data = [
                'recipient'=> $email,
                'fromEmail'=> 'tsdstoredau@gmail.com',
                'fromName'=> "TDS store",
                'subject'=>"Lấy lại mật khẩu",
                'body'=>$content,
            ];
            Mail::send('email-template', $mail_data, function($message_email) use ($mail_data){
                $message_email->to($mail_data['recipient'])
                                ->from($mail_data['fromEmail'], $mail_data['fromName'])
                                ->subject($mail_data['subject']);
            });
            return redirect()->back()->withInput()->with('message2','Đã gửi mật khẩu về Email của bạn');
        }
        else{
            return redirect()->back()->withInput()->with('message1','Email không tồn tại');
        }
    }
    public function dangxuat(){
        Session::put('username', null);
        Session::put('password', null);
        Session::put('display', null);
        return redirect('/');
    }

    public function changepass($MaKH){
        $this->AuthDangnhap();
        $datas = DB::table('khachhang')->where('MaKH', $MaKH)->get();
        return view('khachhang.changepass', compact('datas'));
    }
    public function update_pass(Request $request, $MaKH){
        $pass_old = $request->pass_old;
        $pass_new = $request->pass_new;
        $re_pass = $request->re_pass;
        $message[0] = null;
        $message[1] = null;
        $khachhang = KhachHang::select('Pass')->where('MaKH', $MaKH)->get();
        if($khachhang[0]['Pass'] != $pass_old){
            $message[0] = "-Mật khẩu không chính xác";
        }
        else if($pass_new != $re_pass){
            $message[1] = "-Mật khẩu nhập lại không trùng khớp";
        }
        else{
            KhachHang::where('MaKH', $MaKH)->update(['Pass'=>$pass_new]);
            return redirect('/');
        }
        return redirect()->back()->with(['message1'=>$message[0], 'message2'=>$message[1]]);
    }
    //change information
    public function info($MaKH){
        $this->AuthDangnhap();
        $khachhang= DB::table('khachhang')->where('MaKH', $MaKH)->get();
        return view('khachhang.info', compact('khachhang'));
    }
    public function update_info(Request $request, $MaKH){
        $name = $request->name;
        $sdt = $request->sdt;
        $diachi = $request->diachi;
        KhachHang::where('MaKH', $MaKH)->update(['TenKH'=>$name, 'Diachi'=>$diachi, 'SDT'=>$sdt]);
        return redirect()->back()->with('message1', 'Đã cập nhật thành công !');
    }


    //gio hang
    public function giohang(){
        $this->AuthDangnhap();
        $data = DB::table('dondathang')->join('sanpham', 'dondathang.MaSP', '=', 'sanpham.MaSP')->get();  

        return view('khachhang.giohang', compact('data'));
    }
    public function muahang(Request $request, $MaSP){
        $soluong = $request->soluong;
        // $data2 = DB::table('dondathang')->join('sanpham', 'dondathang.MaSP', '=', 'sanpham.MaSP')->get();
        Session::put('Soluong', $soluong);
        Session::put('MaSP', $MaSP);
        
        $data = Product::where('MaSP', $MaSP)->get();
        Session::put('Image', $data[0]['Image']);
        Session::put('TenSP', $data[0]['TenSP']);
        Session::put('Gia', $data[0]['Gia']);
        $tongtien = $soluong * $data[0]['Gia'];
        Session::put('Tongtien', $tongtien);
        
        // $query = DB::table('dondathang')->insert(['MaKH'=>Session::get('MaKH'),
        //                                         'MaSP'=> $MaSP,
        //                                         'TongTien'=> $MaSP,
        //                                         'SoLuongDH'=>$data,
        //                                         'ThoiGianDH'=>Carbon::now()]);
        return redirect('/khachhang/giohang');
    }
    public function delete(){
        Session::put('Soluong', null);
        Session::put('MaSP', null);
        Session::put('Image', null);
        Session::put('TenSP', null);
        Session::put('Gia', null);
        Session::put('Tongtien', null);
        return redirect('/khachhang/giohang');
    }
    public function add_cmt(Request $request, $MaSP, $MaKH){
        $comment = $request->comment;
        $data['MaSP'] = $MaSP;
        $data['MaKH'] = $MaKH;
        $data['content'] = $comment;
        $data['time_create'] =  Carbon::now('Asia/Ho_Chi_Minh');
        Comment::create($data);
        return redirect("/chitiet/$MaSP");
    }
}