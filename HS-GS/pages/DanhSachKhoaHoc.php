<?php
$KhoaHoc = new KhoaHoc();
$list = $KhoaHoc->getKhoaHocByMaNguoiDung('MaHocSinh', getSESSION('MaNguoiDung'));
$list = json_decode($list, true);
?>
<div class="page-breadcrumb">
    <div class="row">
        <div class="col-7 align-self-center">
            <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">Basic Table</h4>
            <div class="d-flex align-items-center">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb m-0 p-0">
                        <li class="breadcrumb-item"><a href="index.html" class="text-muted">Home</a></li>
                        <li class="breadcrumb-item text-muted active" aria-current="page">Library</li>
                    </ol>
                </nav>
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
                                <th scope="col">Trạng thái</th>
                                <th scope="col">Khác</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($list['data'] as $k => $v) {
                                echo '<tr>
                                        <th scope="row">' . $v['MaKhoaHoc'] . '</th>
                                        <td>' . $v['TenMonHoc'] . '</td>
                                        <td>' . $v['KhoiLop'] . '</td>
                                        <td>' . $v['HoTen'] . '</td>
                                        <td>' . $v['DiaChi'] . '</td>
                                        <td>' . $v['SDT'] . '</td>
                                        <td>' . $v['SoTuan'] . '</td>
                                        <td>' . formatPrice($v['SoTien']) . ' đ</td>
                                        <td>' . $v['NgayDangKy'] . '</td>
                                        <td>' . TinhTrangKhoaHoc($v['TinhTrang']) . '</td>
                                        <td>
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-info dropdown-toggle"
                                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Thêm</button>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item" href="ThoiKhoaBieu.html">Xem thời khoá biểu</a>
                                                    <a class="dropdown-item" href="' . ($v['TinhTrang'] >= 2 ? 'javascript:" onclick="showNotify(\'no-edit\')' : 'ChinhSuaKhoaHoc.html?MaKhoaHoc=' . $v['MaKhoaHoc']) . '">Chỉnh sửa</a>
                                                    <a class="dropdown-item" href="javascript:" onclick="' . ($v['TinhTrang'] >= 2 ? 'showNotify(\'no-delete\')' : 'XoaKhoaHoc(\'' . $v['MaKhoaHoc'] . '\')') . '">Xoá</a>
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