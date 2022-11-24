<?php
$KhoaHoc = new KhoaHoc();
$MonHoc = $KhoaHoc->getThongTinDangKy();
$MonHoc = json_decode($MonHoc, true)['data']['MonHoc'];

$detail = [];

$NguoiDung = new NguoiDung();

$success = false;
$msg = '';
if ($_POST) {
    $file = $_FILES['HinhAnh'];
    if ($file['size'] > 0) {
        $_POST['HinhAnh'] = curl_file_create($file['tmp_name'], $file['type']);
    }
    if (getPOST('submit') == 'post')
        $data = $NguoiDung->postChuyenMon($_POST);
    else if (getPOST('submit') == 'update')
        $data = $NguoiDung->updateChuyenMon(getGET('MaChuyenMon'), $_POST);
    $data = json_decode($data, true);
    $success = $data['success'];
    $msg = $data['message'];
}

if (getGET('MaChuyenMon')) {
    $ChuyenMon = $NguoiDung->getChuyenMonById(getGET('MaChuyenMon'));
    $ChuyenMon = json_decode($ChuyenMon, true)['data'];
    if ($ChuyenMon && $ChuyenMon['MaNguoiDung'] == getSESSION('MaNguoiDung')) $detail = $ChuyenMon;
}

['MaChuyenMon' => $MaChuyenMon, 'MaMonHoc' => $MaMonHoc, 'NoiDung' => $NoiDung, 'HinhAnh' => $HinhAnh] = $detail;
?>
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
                    <h4 class="card-title">Nhập thông tin chuyên môn <?php echo $MaChuyenMon ? ('#' . $MaChuyenMon) : ''; ?></h4>
                    <form method="POST" action="" enctype="multipart/form-data">
                        <div class="form-body">
                            <div class="row">
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
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="NoiDung">Nội dung</label>
                                        <textarea class="form-control" id="NoiDung" name="NoiDung" rows="3"><?php echo $NoiDung; ?></textarea>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <fieldset class="form-group">
                                        <label class="labels">Chọn ảnh</label>
                                        <input type="file" class="form-control-file" id="HinhAnh" name="HinhAnh" />
                                    </fieldset>
                                </div>
                            </div>
                        </div>
                        <div class="form-actions">
                            <div class="text-right">
                                <?php echo $HinhAnh ? '<button class="btn btn-warning" href="javascript:" onclick="XemAnh(\'' . $HinhAnh . '\'); return false;">Xem ảnh</button>' : ''; ?>
                                <button type="submit" class="btn btn-info" name="submit" value="<?php echo $MaChuyenMon ? 'update' : 'post'; ?>"><?php echo $MaChuyenMon ? 'Cập nhật' : 'Thêm'; ?></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>