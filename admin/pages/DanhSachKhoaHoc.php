<?php
$KhoaHoc = new KhoaHoc();
$list = $KhoaHoc->getKhoaHocAll();
$list = json_decode($list, true);
// $list = $list['data'];
?>
<div class="container-fluid">
    <!-- ============================================================== -->
    <!-- Start Page Content -->
    <!-- ============================================================== -->
    <!-- basic table -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <!-- Column -->
                        <div class="col-md-6 col-lg-3 col-xlg-3">
                            <div class="card card-hover">
                                <div class="p-2 bg-primary text-center">
                                    <h1 class="font-light text-white">2,064</h1>
                                    <h6 class="text-white">Tổng khóa học</h6>
                                </div>
                            </div>
                        </div>
                        <!-- Column -->
                        <div class="col-md-6 col-lg-3 col-xlg-3">
                            <div class="card card-hover">
                                <div class="p-2 bg-cyan text-center">
                                    <h1 class="font-light text-white">1,738</h1>
                                    <h6 class="text-white">Khóa học chưa thanh toán</h6>
                                </div>
                            </div>
                        </div>
                        <!-- Column -->
                        <div class="col-md-6 col-lg-3 col-xlg-3">
                            <div class="card card-hover">
                                <div class="p-2 bg-success text-center">
                                    <h1 class="font-light text-white">1100</h1>
                                    <h6 class="text-white">Khóa học đã duyệt</h6>
                                </div>
                            </div>
                        </div>
                        <!-- Column -->
                        <div class="col-md-6 col-lg-3 col-xlg-3">
                            <div class="card card-hover">
                                <div class="p-2 bg-danger text-center">
                                    <h1 class="font-light text-white">964</h1>
                                    <h6 class="text-white">Khóa học chưa duyệt</h6>
                                </div>
                            </div>
                        </div>
                        <!-- Column -->
                    </div>
                    <div class="table-responsive">
                        <table id="zero_config" class="table table-striped table-bordered no-wrap">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Họ tên</th>
                                    <th>Địa chỉ</th>
                                    <th>SĐT</th>
                                    <th>Ngày đăng ký</th>
                                    <th>Số tuần</th>
                                    <th>Số tiền</th>
                                    <th>Tổng tiền</th>
                                    <th>Lịch</th>
                                    <th>Ghi chú</th>
                                    <th>Tình trạng</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($list['data'] as $k => $v) {
                                    $ThoiKhoaBieu_TomTat = $v['ThoiKhoaBieu_TomTat'];
                                    $TongTien = $v['SoTien'] * $v['SoTuan'] * count(explode(',', $ThoiKhoaBieu_TomTat['MaThu']));
                                    echo '<tr>
                                            <td>' . $v['MaKhoaHoc'] . '</td>
                                            <td><a href="./detail-student.html" class="font-weight-medium link">' . $v['HoTen'] . '</a></td>
                                            <td>' . $v['DiaChi'] . '</td>
                                            <td>' . $v['SDT'] . '</td>
                                            <td>' . $v['NgayDangKy'] . '</td>
                                            <td>' . $v['SoTuan'] . '</td>
                                            <td>' . formatPrice($v['SoTien']) . ' đ</td>
                                            <td>' . formatPrice($TongTien) . ' đ</td>
                                            <td>' . str_replace(':00', '', $ThoiKhoaBieu_TomTat['GioBatDau']) . ' - ' . str_replace(':00', '', $ThoiKhoaBieu_TomTat['GioKetThuc']) . '<br/>' . $ThoiKhoaBieu_TomTat['TenThu'] . '</td>
                                            <td>' . $v['GhiChu'] . '</td>
                                            <td>' . TinhTrangKhoaHoc($v['TinhTrang']) . '</td>
                                            <td>
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-info dropdown-toggle"
                                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Thêm</button>
                                                    <div class="dropdown-menu">
                                                        <a class="dropdown-item" href="HoaDon.html?MaKhoaHoc=' . $v['MaKhoaHoc'] . '">Xem hoá đơn</a>
                                                        <a class="dropdown-item" href="javascript:" onclick="">Huỷ lịch dạy</a>
                                                        <a class="dropdown-item" href="javascript:" onclick="">Duyệt</a>
                                                        <a class="dropdown-item" href="javascript:" onclick="">Xoá</a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>';
                                }
                                ?>
                            </tbody>
                            <!-- <tfoot>
                                <tr>
                                    <th>ID</th>
                                    <th>Họ Tên</th>
                                    <th>Địa Chỉ</th>
                                    <th>SĐT</th>
                                    <th>Tuần Bắt Đầu</th>
                                    <th>Số Tuần</th>
                                    <th>Số Tiền</th>
                                    <th>Ghi Chú</th>
                                    <th>Tình Trạng</th>
                                </tr>
                            </tfoot> -->
                        </table>
                        <ul class="pagination float-right">
                            <li class="page-item disabled">
                                <a class="page-link" href="#" tabindex="-1">Previous</a>
                            </li>
                            <li class="page-item active"><a class="page-link" href="#">1</a></li>
                            <li class="page-item">
                                <a class="page-link" href="#">2 <span class="sr-only">(current)</span></a>
                            </li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item">
                                <a class="page-link" href="#">Next</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>