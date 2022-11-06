<?php
$KhoaHoc = new KhoaHoc();

$detail = [];

$ThongTinDangKy = $KhoaHoc->getThongTinDangKy();
// var_dump($ThongTinDangKy);
$ThongTinDangKy_parse = json_decode($ThongTinDangKy, true);
$ttdk = $ThongTinDangKy_parse['data'];
['CaHoc' => $CaHoc, 'MonHoc' => $MonHoc, 'ThuTrongTuan' => $ThuTrongTuan, 'SoTienBuoiHoc' => $SoTienBuoiHoc] = $ttdk;

$success = false;
$msg = '';
if ($_POST) {
    // var_dump($_POST);
    if ($_POST['MaThu'] && count($_POST['MaThu']) > 0) {
        $_POST['MaThu'] = implode(',', $_POST['MaThu']);
        if (getPOST('submit') == 'post') $data = $KhoaHoc->postKhoaHoc(http_build_query($_POST));
        else if (getPOST('submit') == 'update') $data = $KhoaHoc->updateKhoaHoc(getGET('MaKhoaHoc'), http_build_query($_POST));
        $data = json_decode($data, true);
        if ($data['success']) {
            $success = true;
            $msg = 'Đăng ký khoá học thành công.';
            $detail = [];
        } else $msg = $data['message'];
    } else {
        $msg = 'Vui lòng chọn ngày học.';
        $detail = $_POST;
    }
}

$MaCaHoc = 0;
$MaThu = '';
if (getGET('act') == 'edit') {
    if (getGET('MaKhoaHoc')) {
        $detail = $KhoaHoc->getKhoaHocById(getGET('MaKhoaHoc'));
        $detail = json_decode($detail, true)['data'];
        foreach ($detail['ThoiKhoaBieu'] as $k => $v) {
            $MaCaHoc = $v['MaCaHoc'];
            $MaThu .= $v['MaThu'] . ',';
        }
    } else echo '<script>window.location.href = "DanhSachKhoaHoc.html"</script>';
} else {
    $NguoiDung = new NguoiDung();
    $detail = $NguoiDung->getProfile(getSESSION('MaNguoiDung'));
    $detail = json_decode($detail, true)['data'];
}

['MaKhoaHoc' => $MaKhoaHoc, 'MaMonHoc' => $MaMonHoc, 'KhoiLop' => $KhoiLop, 'HoTen' => $HoTen, 'DiaChi' => $DiaChi, 'SDT' => $SDT, 'SoTuan' => $SoTuan, 'SoTien' => $SoTien, 'GhiChu' => $GhiChu] = $detail;
?>
<div class="container-fluid">
    <?php if ($msg) { ?>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="alert alert-<?php echo $success ? 'success' : 'danger'; ?>" role="alert">
                            <?php echo $msg; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Nhập thông tin khoá học <?php echo $MaKhoaHoc ? ('#' . $MaKhoaHoc) : ''; ?></h4>
                    <form method="POST" action="">
                        <div class="form-body">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group mb-4">
                                        <label for="MaCaHoc">Chọn ca học</label>
                                        <select class="form-control" id="MaCaHoc" name="MaCaHoc">
                                            <?php
                                            foreach ($CaHoc as $k => $v) {
                                                echo '<option value="' . $v['MaCaHoc'] . '" ' . ($MaCaHoc == $v['MaCaHoc'] ? 'selected' : '') . '>' . $v['GioBatDau'] . ' - ' . $v['GioKetThuc'] . ' (' . $v['ThoiGian'] . ' phút)</option>';
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group mb-4">
                                        <label for="MaMonHoc">Chọn môn học</label>
                                        <select class="form-control" id="MaMonHoc" name="MaMonHoc">
                                            <?php
                                            foreach ($MonHoc as $k => $v) {
                                                echo '<option value="' . $v['MaMonHoc'] . '" ' . ($MaMonHoc == $v['MaMonHoc'] ? 'selected' : '') . '>' . $v['TenMonHoc'] . '</option>';
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group mb-4">
                                        <label for="SoTien">Chọn giá tiền 1 buổi học</label>
                                        <select class="form-control" id="SoTien" name="SoTien">
                                            <?php
                                            foreach ($SoTienBuoiHoc as $k => $v) {
                                                if ($v['HienThi'] == 1)
                                                    echo '<option value="' . $v['SoTien'] . '" ' . ($SoTien == $v['SoTien'] ? 'selected' : '') . '>' . formatPrice($v['SoTien']) . ' đ</option>';
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group mb-4">
                                        <label for="KhoiLop">Chọn khối lớp</label>
                                        <select class="form-control" id="KhoiLop" name="KhoiLop">
                                            <option value="0">- Không chọn -</option>
                                            <?php
                                            for ($i = 1; $i <= 12; $i++) {
                                                echo '<option value="' . $i . '" ' . ($KhoiLop == $i ? 'selected' : '') . '>' . $i . '</option>';
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group mb-4">
                                        <p>Chọn ngày học</p>
                                        <!-- <select class="form-control" id="ThuTrongTuan" multiple>
                                            <?php
                                            foreach ($ThuTrongTuan as $k => $v) {
                                                echo '<option value="' . $v['MaThu'] . '">' . $v['TenThu'] . '</option>';
                                            }
                                            ?>
                                        </select> -->
                                        <?php
                                        foreach ($ThuTrongTuan as $k => $v) {
                                            echo '<div class="form-check form-check-inline">
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input" id="MaThu_' . $v['MaThu'] . '" name="MaThu[]" value="' . $v['MaThu'] . '" ' . (strpos($MaThu, (string)$v['MaThu']) !== false ? 'checked' : '') . '>
                                                    <label class="custom-control-label" for="MaThu_' . $v['MaThu'] . '">' . $v['TenThu'] . '</label>
                                                </div>
                                            </div>';
                                        }
                                        ?>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="HoTen">Họ tên HS</label>
                                        <input type="text" class="form-control" id="HoTen" name="HoTen" value="<?php echo $HoTen; ?>" required />
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="DiaChi">Địa chỉ nơi học</label>
                                        <input type="text" class="form-control" id="DiaChi" name="DiaChi" value="<?php echo $DiaChi; ?>" required />
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="SDT">SĐT</label>
                                        <input type="text" class="form-control" id="SDT" name="SDT" value="<?php echo $SDT; ?>" required />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="SoTuan">Số tuần học (tối thiểu 4 tuần)</label>
                                        <input type="number" class="form-control" id="SoTuan" name="SoTuan" min="4" max="500" value="<?php echo $SoTuan; ?>" required />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="GhiChu">Ghi chú</label>
                                        <textarea class="form-control" id="GhiChu" name="GhiChu" rows="3"><?php echo $GhiChu; ?></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-actions">
                            <div class="text-right">
                                <button type="submit" class="btn btn-info" name="submit" value="<?php echo $MaKhoaHoc ? 'update' : 'post'; ?>"><?php echo $MaKhoaHoc ? 'Cập nhật' : 'Đăng ký'; ?></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>