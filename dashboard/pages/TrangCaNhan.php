<?php
$NguoiDung = new NguoiDung();

$success = false;
$msg = '';
$MaNguoiDung = 0;
if (getGET('MaNguoiDung'))
    $MaNguoiDung = getGET('MaNguoiDung');
else {
    $MaNguoiDung = getSESSION('MaNguoiDung');
    if ($_POST) {
        if (getPOST('submit') == 'profile') {
            $file_avatar = $_FILES['Avatar'];
            if ($file_avatar['size'] > 0) {
                $_POST['avatar'] = curl_file_create($file_avatar['tmp_name'], $file_avatar['type']);
            }
            $file_id_card = $_FILES['id_card'];
            if ($file_id_card['size'] > 0) {
                $_POST['id_card'] = curl_file_create($file_id_card['tmp_name'], $file_id_card['type']);
            }
            $data = $NguoiDung->updateProfile(getSESSION('MaNguoiDung'), $_POST);
            $data = json_decode($data, true);
            $success = $data['success'];
        } else if (getPOST('submit') == 'password') {
            if (getPOST('MatKhauMoi') == getPOST('XacNhanMatKhauMoi')) {
                $data = $NguoiDung->DoiMatKhau(http_build_query($_POST));
                $data = json_decode($data, true);
                $success = $data['success'];
                if ($success) $msg = 'Đổi mật khẩu thành công!';
            } else $msg = 'Mật khẩu mới không trùng nhau!';
        }

        if ($success == false && $data['message']) $msg = $data['message'];
    }
}
$profile = $NguoiDung->getProfile($MaNguoiDung);
$profile = json_decode($profile, true);
if (getGET('MaNguoiDung') && $profile['success'] == false) echo '<script>window.location.href = "TrangCaNhan.html"</script>';
$profile = $profile['data'];
['HoTen' => $HoTen, 'NgaySinh' => $NgaySinh, 'GioiTinh' => $GioiTinh, 'DiaChi' => $DiaChi, 'Avatar' => $Avatar, 'SDT' => $SDT, 'Email' => $Email, 'TenDangNhap' => $TenDangNhap, 'LaGiaSu' => $LaGiaSu, 'id_card' => $id_card] = $profile;
if (!getGET('MaNguoiDung')) $NguoiDung->updateSession($profile);
?>
<style>
    ul.timeline {
        list-style-type: none;
        position: relative;
    }

    ul.timeline:before {
        content: ' ';
        background: #d4d9df;
        display: inline-block;
        position: absolute;
        left: 29px;
        width: 2px;
        height: 100%;
        z-index: 400;
    }

    ul.timeline>li {
        margin: 20px 0;
        padding-left: 20px;
    }

    ul.timeline>li:before {
        content: ' ';
        background: white;
        display: inline-block;
        position: absolute;
        border-radius: 50%;
        border: 3px solid #22c0e8;
        left: 20px;
        width: 20px;
        height: 20px;
        z-index: 400;
    }
</style>
<div id="xem-anh-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="fullWidthModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="fullWidthModalLabel">Thông tin</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <img src="" id="xem-anh-src" style="max-width: 100%;" />
            </div>
        </div>
    </div>
</div>
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
                    <h4 class="card-title">Thông tin cá nhân</h4>
                    <div class="row">
                        <div class="col-md-3 border-right">
                            <div class="d-flex flex-column align-items-center text-center p-3 py-5">
                                <img class="rounded-circle mt-5 square-img" width="69%" src="<?php echo $Avatar ? $Avatar : 'assets/images/users/profile.jpg'; ?>" />
                                <br />
                                <?php echo $LaGiaSu == 1 ? '<span class="badge badge-primary">Gia sư</span>' : '<span class="badge badge-success">Học sinh</span>'; ?>
                                <span class="font-weight-bold"><?php echo $HoTen; ?></span>
                                <span class="text-black-50"><?php echo $Email; ?></span>
                            </div>
                        </div>
                        <?php if (getGET('MaNguoiDung')) { ?>
                            <div class="col-md-5 border-right">
                                <div class="p-3 py-5">
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <h4 class="text-right" style="font-size: 18px;font-weight: bold;">Trang cá nhân</h4>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="labels" for="HoTen">Họ tên</label>
                                                <input type="text" class="form-control" id="HoTen" name="HoTen" value="<?php echo $HoTen; ?>" disabled />
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="mr-sm-2" for="GioiTinh">Giới tính</label>
                                            <select class="custom-select mr-sm-2" id="GioiTinh" name="GioiTinh" disabled>
                                                <option value="0"><?php echo $GioiTinh == 1 ? 'Nam' : 'Nữ'; ?></option>
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="labels" for="NgaySinh">Ngày sinh</label>
                                                <input type="date" class="form-control" id="NgaySinh" name="NgaySinh" value="<?php echo $NgaySinh; ?>" disabled />
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="labels" for="SDT">Số điện thoại</label>
                                                <input type="text" class="form-control" id="SDT" name="SDT" value="<?php echo $SDT; ?>" disabled />
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="labels" for="Email">Email</label>
                                                <input type="email" class="form-control" id="Email" name="Email" value="<?php echo $Email; ?>" disabled />
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="labels" for="DiaChi">Địa chỉ</label>
                                                <input type="text" class="form-control" id="DiaChi" name="DiaChi" value="<?php echo $DiaChi; ?>" disabled />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <?php
                                if ($LaGiaSu) {
                                    $ChuyenMon = $NguoiDung->getChuyenMonByUserId(getGET('MaNguoiDung'));
                                    $cm = json_decode($ChuyenMon, true);
                                ?>
                                    <div class="p-3 py-5">
                                        <div class="d-flex justify-content-between align-items-center experience">
                                            <span style="font-size: 18px;font-weight: bold;">Chuyên môn</span>
                                        </div>
                                        <br>
                                        <div class="col-md-12">
                                            <ul class="timeline">
                                                <?php
                                                foreach ($cm['data'] as $k => $v) {
                                                    echo '<li>
                                                            <a href="javascript:void()">' . $v['TenMonHoc'] . '</a>
                                                            ' . ($v['HinhAnh'] ? '<a href="javascript:" onclick="XemAnh(\'' . $v['HinhAnh'] . '\')" class="float-right">Xem ảnh</a>' : '') . '
                                                            <p>' . $v['NoiDung'] . '</p>
                                                        </li>';
                                                }
                                                ?>
                                            </ul>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                        <?php } else { ?>
                            <div class="col-md-5 border-right">
                                <form method="POST" action="" enctype="multipart/form-data">
                                    <div class="form-body">
                                        <div class="p-3 py-5">
                                            <div class="d-flex justify-content-between align-items-center mb-3">
                                                <h4 class="text-right" style="font-size: 18px;font-weight: bold;">Trang cá nhân</h4>
                                            </div>
                                            <div class="row mt-2">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="labels" for="HoTen">Họ tên</label>
                                                        <input type="text" class="form-control" id="HoTen" name="HoTen" value="<?php echo $HoTen; ?>" required />
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="mr-sm-2" for="GioiTinh">Giới tính</label>
                                                    <select class="custom-select mr-sm-2" id="GioiTinh" name="GioiTinh">
                                                        <option value="1" <?php echo $GioiTinh == 1 ? 'selected' : ''; ?>>Nam</option>
                                                        <option value="2" <?php echo $GioiTinh == 2 ? 'selected' : ''; ?>>Nữ</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="labels" for="NgaySinh">Ngày sinh</label>
                                                        <input type="date" class="form-control" id="NgaySinh" name="NgaySinh" value="<?php echo $NgaySinh; ?>" required />
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="labels" for="SDT">Số điện thoại</label>
                                                        <input type="text" class="form-control" id="SDT" name="SDT" value="<?php echo $SDT; ?>" required />
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="labels" for="Email">Email</label>
                                                        <input type="email" class="form-control" id="Email" name="Email" value="<?php echo $Email; ?>" required />
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <fieldset class="form-group">
                                                        <label class="labels">Chọn avatar</label>
                                                        <input type="file" class="form-control-file" id="Avatar" name="Avatar" />
                                                    </fieldset>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="labels" for="DiaChi">Địa chỉ</label>
                                                        <input type="text" class="form-control" id="DiaChi" name="DiaChi" value="<?php echo $DiaChi; ?>" required />
                                                    </div>
                                                </div>
                                                <?php if ($LaGiaSu) { ?>
                                                    <div class="col-md-6">
                                                        <fieldset class="form-group">
                                                            <label class="labels">Upload mặt trước CCCD (xác nhận danh tính)</label>
                                                            <input type="file" class="form-control-file" id="Avatar" name="id_card" />
                                                        </fieldset>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <code>
                                                            <?php
                                                            if ($id_card) {
                                                                try {
                                                                    $info_id_card = json_decode($id_card, true);
                                                                    echo 'Link ảnh: ' . $info_id_card['image'] . '</br>';
                                                                    $info_id_card = $info_id_card['data'];
                                                                    echo 'ID: ' . $info_id_card['id'] . '</br>';
                                                                    echo 'Họ tên: ' . $info_id_card['name'] . '</br>';
                                                                    echo 'Ngày sinh: ' . $info_id_card['birth_date'] . '</br>';
                                                                    echo 'Giới tính: ' . $info_id_card['gender'] . '</br>';
                                                                    echo 'Địa chỉ: ' . $info_id_card['address'] . '</br>';
                                                                    echo 'Quên quán: ' . $info_id_card['place_birth'] . '</br>';
                                                                    echo 'Ngày hết hạn: ' . $info_id_card['date_expire'] . '</br>';
                                                                } catch (\Throwable $th) {
                                                                }
                                                            }
                                                            ?>
                                                        </code>
                                                    </div>
                                                <?php } ?>
                                            </div>
                                            <div class="mt-5 text-center">
                                                <button class="btn btn-primary profile-button" type="submit" name="submit" value="profile">Lưu</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="col-md-4">
                                <form method="POST" action="">
                                    <div class="form-body">
                                        <div class="p-3 py-5">
                                            <div class="d-flex justify-content-between align-items-center experience">
                                                <span style="font-size: 18px;font-weight: bold;">Thay đổi mật khẩu</span>
                                            </div>
                                            <br>
                                            <div class="col-md-12">
                                                <label class="labels">Mật khẩu cũ</label>
                                                <input type="password" class="form-control" placeholder="Mật khẩu cũ" name="MatKhauCu" required />
                                            </div> <br>
                                            <div class="col-md-12">
                                                <label class="labels">Mật khẩu mới</label>
                                                <input type="password" class="form-control" placeholder="Mật khẩu mới" name="MatKhauMoi" required />
                                            </div> <br>
                                            <div class="col-md-12">
                                                <label class="labels">Nhập lại mật khẩu mới</label>
                                                <input type="password" class="form-control" placeholder="Mật khẩu mới" name="XacNhanMatKhauMoi" required />
                                            </div>
                                            <div class="mt-5 text-center">
                                                <button class="btn btn-primary profile-button" type="submit" name="submit" value="password">Thay đổi</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>