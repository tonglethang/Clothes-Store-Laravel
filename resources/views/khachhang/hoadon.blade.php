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
                <form action="/khachhang/giohang?tongtien={{$tongtien}}&tongsoluong={{$tongsoluong}}" method="post" >
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