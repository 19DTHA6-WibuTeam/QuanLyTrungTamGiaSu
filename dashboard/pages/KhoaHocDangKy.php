<?php
$KhoaHoc = new KhoaHoc();
$list = $KhoaHoc->getKhoaHocByKeyValue((getSESSION('LaGiaSu') ? 'MaGiaSu' : 'MaHocSinh'), getSESSION('MaNguoiDung'));
$list = json_decode($list, true);
?>
<div id="confirm-delete-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <div class="form-group">
                    <label for="MKH_delete">Bạn có muốn xoá khoá học này?</label>
                    <input class="form-control" type="hidden" id="MKH_delete" value="" />
                </div>
                <div class=" form-group text-center">
                    <button class="btn btn-primary" onclick="XoaKhoaHoc(0, true)">Xoá</button>
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
                    <h4 class="card-title">Khoá học đã đăng ký</h4>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead class="bg-success text-white">
                            <tr>
                                <th scope="col">Mã khoá học</th>
                                <th scope="col">Môn học</th>
                                <th scope="col">Khối lớp</th>
                                <th scope="col">Họ tên</th>
                                <th scope="col">Địa chỉ</th>
                                <th scope="col">SDT</th>
                                <th scope="col">Số tuần</th>
                                <th scope="col">Số tiền 1 buổi</th>
                                <th scope="col">Ngày đăng ký</th>
                                <th scope="col">Tình trạng</th>
                                <th scope="col">Ghi chú</th>
                                <th scope="col">Khác</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($list['data'] as $k => $v) {
                                echo '<tr>
                                        <th scope="row">' . $v['MaKhoaHoc'] . '</th>
                                        <td>' . $v['TenMonHoc'] . '</td>
                                        <td>' . ($v['KhoiLop'] > 0 ? $v['KhoiLop'] : 'Tự do') . '</td>
                                        <td>' . $v['HoTen'] . '</td>
                                        <td>' . $v['DiaChi'] . '</td>
                                        <td>' . $v['SDT'] . '</td>
                                        <td>' . $v['SoTuan'] . '</td>
                                        <td>' . formatPrice($v['SoTien']) . ' đ</td>
                                        <td>' . $v['NgayDangKy'] . '</td>
                                        <td>' . TinhTrangKhoaHoc($v['TinhTrang']) . '</td>
                                        <td>' . $v['GhiChu'] . '</td>
                                        <td>
                                            ' . (getSESSION('LaGiaSu') ? '' : '
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-info dropdown-toggle"
                                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Thêm</button>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item" href="' . ($v['TinhTrang'] < 2 ? 'javascript:" onclick="showNotify(\'no-tutor\')' : 'TrangCaNhan.html?MaNguoiDung=' . $v['MaGiaSu']) . '">Xem gia sư</a>
                                                    <a class="dropdown-item" href="' . ($v['TinhTrang'] >= 2 ? 'javascript:" onclick="showNotify(\'no-edit\')' : 'ChinhSuaKhoaHoc.html?MaKhoaHoc=' . $v['MaKhoaHoc']) . '">Chỉnh sửa</a>
                                                    <a class="dropdown-item" href="javascript:" onclick="' . ($v['TinhTrang'] >= 2 ? 'showNotify(\'no-delete\')' : 'XoaKhoaHoc(\'' . $v['MaKhoaHoc'] . '\')') . '">Xoá</a>
                                                </div>
                                            </div>
                                            ') . '
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