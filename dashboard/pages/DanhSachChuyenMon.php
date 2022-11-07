<?php
$NguoiDung = new NguoiDung();
$list = $NguoiDung->getChuyenMonByUserId(getSESSION('MaNguoiDung'));
$list = json_decode($list, true);
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
                    <h4 class="card-title">Danh sách chuyên môn của bạn</h4>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead class="bg-danger text-white">
                            <tr>
                                <th scope="col">Mã</th>
                                <th scope="col">Môn học</th>
                                <th scope="col">Nội dung</th>
                                <th scope="col">Khác</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($list['data'] as $k => $v) {
                                echo '<tr>
                                        <th scope="row">#' . $v['MaChuyenMon'] . '</th>
                                        <td>' . $v['TenMonHoc'] . '</td>
                                        <td>' . $v['NoiDung'] . '</td>
                                        <td>
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-info dropdown-toggle"
                                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Thêm</button>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item" href="ChinhSuaChuyenMon.html?MaChuyenMon=' . $v['MaChuyenMon'] . '">Chỉnh sửa</a>
                                                    <a class="dropdown-item" href="javascript:" onclick="' . ($v['HinhAnh'] ? 'XemAnh(\'' . $v['HinhAnh'] . '\')' : 'showNotify(\'no-image\')') . '">Xem ảnh</a>
                                                    <a class="dropdown-item" href="javascript:" onclick="XoaChuyenMon(\'' . $v['MaChuyenMon'] . '\')">Xoá</a>
                                                </div>
                                            </div>
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