<?php
$HoaDon = new HoaDon();

$vnp = [];
$isVnp = false;
if ($_GET) {
    foreach ($_GET as $k => $v) {
        // var_dump($k, $v);
        $isVnp = true;
        if (strpos($k, 'vnp_') !== false) $vnp[$k] = $v;
    }
}
if ($isVnp) {
    $XacNhanThanhToan =  $HoaDon->XacNhanThanhToan(getGET('MaHoaDon'), http_build_query($vnp));
    // var_dump($XacNhanThanhToan);
}
// var_dump(http_build_query($vnp));

$cthd = $HoaDon->getById(getGET('MaHoaDon'), getUrl());
$cthd = json_decode($cthd, true);
$cthd = $cthd['data'];

if ($cthd['MaNguoiDung'] != getSESSION('MaNguoiDung')) echo '<script>window.location.href = "HoaDon.html"</script>';
?>
<style>
    .signature {
        font-family: 'Kaushan Script', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol', 'Noto Color Emoji';
        color: #0099D5;
    }

    .table thead th {
        vertical-align: bottom;
        border-bottom: 2px solid transparent;
        background: #0099D5;
        color: #fff;
    }

    .font-weight-lighter {
        font-weight: 300;
        background: #0099D5;
        color: #fff;
    }

    .inv {
        background: #E6E4E7;
    }

    .my-3 {
        margin-bottom: 1rem !important;
        margin-top: 1rem !important;
    }

    .my-5 {
        margin-bottom: 3rem !important;
        margin-top: 3rem !important;
    }

    .py-5 {
        padding-bottom: 3rem !important;
        padding-top: 3rem !important;
    }

    .px-3 {
        padding-left: 1rem !important;
        padding-right: 1rem !important;
    }

    .border-bottom {
        border-bottom: 2px solid #000 !important;
        /*width: 35%;*/
        padding: 0px 0px 5px 0px;
    }
</style>
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-6"></div>
        <div class="col-lg-6">
            <h1 class="font-weight-lighter py-1 px-3">HOÁ ĐƠN</h1>
        </div>
    </div>
    <div class="row my-3">
        <div class="col-lg-6">
            <p class="mb-0"><?php echo getSESSION('LaGiaSu') == 0 ? 'ĐẾN' : 'TỪ'; ?></p>
            <h5 class="mb-0"><b>Trung tâm gia sư WibuEdu</b></h5>
            <p class="mb-0"></p>
            <p class="mb-0">028.0000.1111</p>
            <p class="mb-0">wibuteam.edu.vn</p>
        </div>
        <div class="col-lg-6">
            <div class="row">
                <div class="col-lg-12">
                    <table>
                        <tbody>
                            <tr>
                                <td>Mã hoá đơn</td>
                                <td class="px-3">:</td>
                                <td><?php echo $cthd['MaHoaDon']; ?></td>
                            </tr>
                            <tr>
                                <td>Ngày tạo</td>
                                <td class="px-3">:</td>
                                <td><?php echo $cthd['NgayTao']; ?></td>
                            </tr>
                            <tr>
                                <td>Ngày thanh toán</td>
                                <td class="px-3">:</td>
                                <td><?php echo $cthd['NgayThanhToan'] == null ? 'Đang cập nhật' : $cthd['NgayThanhToan']; ?></td>
                            </tr>
                            <tr>
                                <td>Mã người dùng</td>
                                <td class="px-3">:</td>
                                <td><?php echo $cthd['MaNguoiDung']; ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">Mã khoá học</th>
                        <th scope="col">Môn học</th>
                        <th scope="col">Số tiền / buổi</th>
                        <th scope="col">Số buổi</th>
                        <th scope="col">Số tuần</th>
                        <th scope="col">Tổng tiền</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><?php echo $cthd['KhoaHoc']['MaKhoaHoc']; ?></td>
                        <td><?php echo $cthd['KhoaHoc']['TenMonHoc']; ?></td>
                        <td><?php echo formatPrice($cthd['KhoaHoc']['SoTien']); ?> đ</td>
                        <td><?php echo count(explode(',', $cthd['KhoaHoc']['ThoiKhoaBieu_TomTat']['MaThu'])); ?></td>
                        <td><?php echo $cthd['KhoaHoc']['SoTuan']; ?></td>
                        <td><?php echo formatPrice($cthd['SoTien']); ?> đ</td>
                    </tr>
                    <!-- <tr>
                        <td colspan="4"></td>
                        <td><b>Tạm tính</b></td>
                        <td><b><?php echo formatPrice($cthd['SoTien']); ?> đ</b></td>
                    </tr> -->
                    <?php if (getSESSION('LaGiaSu') == 1) { ?>
                        <tr>
                            <td colspan="4"></td>
                            <td><b>PHÍ 20%</b></td>
                            <td><b>(đã trừ)</b></td>
                        </tr>
                    <?php } ?>
                    <tr style="background: #E6E4E7; color: #0099D5;">
                        <td colspan="4"></td>
                        <td><b>TỔNG CỘNG</b></td>
                        <td><b><?php echo formatPrice($cthd['SoTien']); ?> đ</b></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-3">
            <h5 class="ml-5 border-bottom">Phương Thức Thanh Toán</h5>
            <h6 class="text-center">Chuyển khoản</h6>
            <!-- <p></p> -->
        </div>
        <div class="col-lg-6"></div>
    </div>
    <div class="row mt-5">
        <div class="col-lg-6">
            <h5 class="ml-5">Ghi chú</h5>
            <p class="ml-5"><?php echo $cthd['GhiChu']; ?></p>
            <?php if (getSESSION('LaGiaSu') == 0 && $cthd['TinhTrang'] == 0) { ?>
                <p class="ml-5">Để thanh toán khoá học, vui lòng chuyển khoản đến ngân hàng ABC, số tài khoản XXX với nội dung: TTKH #<?php echo $cthd['MaKhoaHoc']; ?></p>
                <p class="ml-5">hoặc ấn <a target="_blank" href="<?php echo $cthd['LinkThanhToan']; ?>">vào đây</a> để thanh toán trực tuyến với VN-PAY.</p>
            <?php } ?>
        </div>
        <div class="col-lg-3"></div>
        <div class="col-lg-3 text-center">
            <h3 class="signature">WibuTeam</h3>
            <p>Kế toán viên</p>
        </div>
    </div>
</div>