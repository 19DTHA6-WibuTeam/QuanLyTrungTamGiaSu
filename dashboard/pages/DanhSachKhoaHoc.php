<?php
$KhoaHoc = new KhoaHoc();
$list = $KhoaHoc->getKhoaHocByKeyValue('TinhTrang', '1');
$list = json_decode($list, true);
?>
<div id="confirm-dangky-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <div class="form-group">
                    <label for="MKH_dangky">Bạn có muốn đăng ký dạy khoá học này?</label>
                    <input class="form-control" type="hidden" id="MKH_dangky" value="" />
                </div>
                <div class="form-group">
                    <p>Sau khi đăng ký, bạn sẽ không thể huỷ lịch dạy. Vui lòng liên hệ admin để gỡ lịch dạy.</p>
                </div>
                <div class=" form-group text-center">
                    <button class="btn btn-primary" onclick="DangKyDay(0, true)">OK</button>
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
                    <h4 class="card-title">Đăng ký lịch dạy</h4>
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
                                <th scope="col">Số tuần</th>
                                <th scope="col">Số tiền 1 buổi</th>
                                <th scope="col">Ngày đăng</th>
                                <th scope="col">Lịch dạy</th>
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
                                        <td>' . $v['SoTuan'] . '</td>
                                        <td>' . formatPrice($v['SoTien']) . ' đ</td>
                                        <td>' . $v['NgayDangKy'] . '</td>
                                        <td>' . str_replace(':00', '', $v['ThoiKhoaBieu_TomTat']['GioBatDau']) . ' - ' . str_replace(':00', '', $v['ThoiKhoaBieu_TomTat']['GioBatDau']) . '<br/>' . $v['ThoiKhoaBieu_TomTat']['TenThu'] . '</td>
                                        <td>' . $v['GhiChu'] . '</td>
                                        <td>
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-info dropdown-toggle"
                                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Thêm</button>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item" href="javascript:" onclick="DangKyDay(\'' . $v['MaKhoaHoc'] . '\')">Đăng ký dạy</a>
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