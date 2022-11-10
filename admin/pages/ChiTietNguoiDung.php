<?php
$NguoiDung = new NguoiDung();
$profile = $NguoiDung->getProfile(getGET('MaNguoiDung'));
$profile = json_decode($profile, true);
['MaNguoiDung' => $MaNguoiDung, 'HoTen' => $HoTen, 'NgaySinh' => $NgaySinh, 'GioiTinh' => $GioiTinh, 'DiaChi' => $DiaChi, 'Avatar' => $Avatar, 'SDT' => $SDT, 'Email' => $Email, 'TenDangNhap' => $TenDangNhap, 'LaGiaSu' => $LaGiaSu] = $profile['data'];

$cm = [];
if ($LaGiaSu) {
    $ChuyenMon = $NguoiDung->getChuyenMonByUserId($MaNguoiDung);
    $cm = json_decode($ChuyenMon, true);
}
?>
<div id="xem-anh-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="fullWidthModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="fullWidthModalLabel">Title.</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <img src="" id="xem-anh-src" style="max-width: 100%;" />
            </div>
        </div>
    </div>
</div>
<div id="confirm-giasu-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <div class="form-group">
                    <label for="MND_giasu">Bạn có muốn đăng ký gia sư cho người dùng này? Sau khi đăng ký không thể chuyển thành tài khoản học sinh.</label>
                    <input class="form-control" type="hidden" id="MND_giasu" value="" />
                </div>
                <div class=" form-group text-center">
                    <button class="btn btn-primary" onclick="DangKyGiaSu(0, true)">Đăng ký</button>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="confirm-delete-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <div class="form-group">
                    <label for="MCM_delete">Bạn có muốn xoá chuyên môn này?</label>
                    <input class="form-control" type="hidden" id="MCM_delete" value="" />
                </div>
                <div class=" form-group text-center">
                    <button class="btn btn-primary" onclick="XoaChuyenMon(0, true)">Xoá</button>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Thông tin <?php echo $LaGiaSu ? 'Gia sư' : 'Học sinh'; ?></h4>
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped mb-0">
                            <tbody>
                                <tr>
                                    <img src="<?php echo $Avatar ? $Avatar : '../dashboard/assets/images/users/profile.jpg'; ?>" alt="image" class="img-thumbnail" width="290">
                                    <p class="mt-3 mb-0">
                                </tr>
                                <tr>
                                    <th class="text-nowrap" scope="row">ID</th>
                                    <td colspan="5">#<?php echo $MaNguoiDung; ?></td>
                                </tr>
                                <tr>
                                    <th class="text-nowrap" scope="row">Họ và tên</th>
                                    <td colspan="5"><?php echo $HoTen; ?></td>
                                </tr>
                                <tr>
                                    <th class="text-nowrap" scope="row">Ngày tháng năm sinh</th>
                                    <td colspan="5"><?php echo $NgaySinh; ?></td>
                                </tr>
                                <tr>
                                    <th class="text-nowrap" scope="row">Giới tính</th>
                                    <td colspan="5"><?php echo $GioiTinh == 1 ? 'Nam' : 'Nữ'; ?></td>
                                </tr>
                                <tr>
                                    <th class="text-nowrap" scope="row">Số điện thoại</th>
                                    <td colspan="5"><?php echo $SDT; ?></td>
                                </tr>
                                <tr>
                                    <th class="text-nowrap" scope="row">Email</th>
                                    <td colspan="5"><?php echo $Email; ?></td>
                                </tr>
                                <tr>
                                    <th class="text-nowrap" scope="row">Địa chỉ</th>
                                    <td colspan="5"><?php echo $DiaChi; ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <?php if ($LaGiaSu == 0) { ?>
                        <button class="btn btn-primary" onclick="DangKyGiaSu('<?php echo $MaNguoiDung; ?>')">Đăng ký gia sư</button>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
    <?php
    if ($LaGiaSu) {
    ?>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Thông tin chuyên môn</h4>
                        <div class="table-responsive">
                            <table id="zero_config" class="table table-striped table-bordered no-wrap">
                                <thead>
                                    <tr>
                                        <th>Môn học</th>
                                        <th>Nội dung</th>
                                        <th>Hình ảnh</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($cm['data'] as $k => $v) {
                                        echo '<tr>
                                                <td>' . $v['TenMonHoc'] . '</td>
                                                <td>' . $v['NoiDung'] . '</td>
                                                <td>
                                                    <a class="btn waves-effect waves-light btn-info" href="javascript:" onclick="' . ($v['HinhAnh'] ? 'XemAnh(\'' . $v['HinhAnh'] . '\')' : 'showNotify(\'no-image\')') . '">Xem ảnh</a>
                                                    <a class="btn waves-effect waves-light btn-danger" href="javascript:" onclick="XoaChuyenMon(\'' . $v['MaChuyenMon'] . '\')">Xoá chuyên môn</a>
                                                </td>
                                            </tr>';
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>
</div>