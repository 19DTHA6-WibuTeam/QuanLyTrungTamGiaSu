<?php
$HoaDon = new HoaDon();
$cthd = $HoaDon->getByMKH(getGET('MaKhoaHoc'));
$cthd = json_decode($cthd, true);

$hd1 = $cthd['data'][0];
$hd2 = $cthd['data'][1];
?>
<div id="confirm-payment-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <div class="form-group">
                    <label for="MHD_payment">Bạn có muốn xác nhận thanh toán không? Sau khi xác nhận không thể thay đổi.</label>
                    <input class="form-control" type="hidden" id="MHD_payment" value="" />
                </div>
                <div class=" form-group text-center">
                    <button class="btn btn-primary" onclick="XacNhanThanhToan(0, true)">Xác nhận</button>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid">
    <div class="card-group">
        <div class="col-md-6">
            <div class="card border-info">
                <div class="card-header bg-info">
                    <h3 class="mb-0 text-white">PHIẾU THU</h3>
                </div>
                <div class="card-body">
                    <!-- Từ học sinh -->
                    <p class="card-text">Từ: </p>
                    <p class="card-text"><?php echo $hd1['HoTen']; ?></p>
                    <p class="card-text"><?php echo $hd1['Email']; ?></p>
                    <p class="card-text"><?php echo $hd1['DiaChi']; ?></p>
                    <p class="card-text">SĐT: <?php echo $hd1['SDT']; ?></p>
                    <hr width="90%" color="gray" align="center">
                    <!-- Đến trung tâm -->
                    <p class="card-text">Đến: </p>
                    <p class="card-text">Trung tâm gia sư Wibu</p>
                    <p class="card-text">wibuteam.edu.vn</p>
                    <p class="card-text">VQ4P+249, Phường Tân Phú, Quận 9, Thành phố Hồ Chí Minh</p>
                    <p class="card-text">028.0000.1111</p>
                    <hr width="90%" color="gray" align="center">
                    <h4 class=" card-title"><?php echo $hd1['GhiChu']; ?></h4>
                    <p class="card-text">Số tiền: <?php echo formatPrice($hd1['SoTien']); ?> đ</p>
                    <?php
                    if ($hd1['NgayThanhToan']) {
                        echo '<p class="card-text">Đã thanh toán ngày ' . $hd1['NgayThanhToan'] . '</p>';
                        if ($hd1['MaGiaoDich']) echo '<p class="card-text">Mã giao dịch: ' . $hd1['MaGiaoDich'] . '</p>';
                    } else
                        echo '<button type="button" class="btn waves-effect waves-light btn-success" onclick="XacNhanThanhToan(\'' . $hd1['MaHoaDon'] . '\')">Xác nhận thanh toán</button>';
                    ?>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card border-info">
                <div class="card-header bg-info">
                    <h3 class="mb-0 text-white">PHIẾU CHI</h3>
                </div>
                <div class="card-body">
                    <!-- Từ trung tâm -->
                    <p class="card-text">Từ: </p>
                    <p class="card-text">Trung tâm gia sư Wibu</p>
                    <p class="card-text">wibuteam.edu.vn</p>
                    <p class="card-text">VQ4P+249, Phường Tân Phú, Quận 9, Thành phố Hồ Chí Minh</p>
                    <p class="card-text">028.0000.1111</p>
                    <hr width="90%" color="gray" align="center">
                    <!-- Đến học sinh -->
                    <p class=" card-text">Đến: </p>
                    <p class="card-text"><?php echo $hd2['HoTen']; ?></p>
                    <p class="card-text"><?php echo $hd2['Email']; ?></p>
                    <p class="card-text"><?php echo $hd2['DiaChi']; ?></p>
                    <p class="card-text">SĐT: <?php echo $hd2['SDT']; ?></p>
                    <hr width="90%" color="gray" align="center">
                    <h4 class=" card-title"><?php echo $hd2['GhiChu']; ?></h4>
                    <p class="card-text">Số tiền: <?php echo formatPrice($hd2['SoTien']); ?> đ</p>
                    <?php
                    if ($hd2['NgayThanhToan']) {
                        echo '<p class="card-text">Đã thanh toán ngày ' . $hd2['NgayThanhToan'] . '</p>';
                        if ($hd2['MaGiaoDich'])  echo '<p class="card-text">Mã giao dịch: ' . $hd2['MaGiaoDich'] . '</p>';
                    } else
                        echo '<button type="button" class="btn waves-effect waves-light btn-success" onclick="XacNhanThanhToan(\'' . $hd2['MaHoaDon'] . '\')">Xác nhận thanh toán</button>';
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>