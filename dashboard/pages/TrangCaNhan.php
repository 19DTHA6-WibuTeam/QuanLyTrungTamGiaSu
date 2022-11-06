<?php
$NguoiDung = new NguoiDung();

$success = false;
$msg = '';
if ($_POST) {
    if (getPOST('submit') == 'profile') {
        $file = $_FILES['Avatar'];
        if ($file['size'] > 0) {
            $_POST['avatar'] = curl_file_create($file['tmp_name'], $file['type']);
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

$profile = $NguoiDung->getProfile(getSESSION('MaNguoiDung'));
$profile = json_decode($profile, true);
$profile = $profile['data'];
['HoTen' => $HoTen, 'NgaySinh' => $NgaySinh, 'GioiTinh' => $GioiTinh, 'DiaChi' => $DiaChi, 'Avatar' => $Avatar, 'SDT' => $SDT, 'Email' => $Email, 'TenDangNhap' => $TenDangNhap] = $profile;
$NguoiDung->updateSession($profile);
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
                    <h4 class="card-title">Thông tin cá nhân</h4>
                    <div class="row">
                        <div class="col-md-3 border-right">
                            <div class="d-flex flex-column align-items-center text-center p-3 py-5">
                                <img class="rounded-circle mt-5" width="150px" src="<?php echo $Avatar; ?>" />
                                <br />
                                <span class="font-weight-bold"><?php echo $HoTen; ?></span>
                                <span class="text-black-50"><?php echo $Email; ?></span>
                            </div>
                            <!-- <input type="file" class="form-control" id="customFile" /> -->
                        </div>
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
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>