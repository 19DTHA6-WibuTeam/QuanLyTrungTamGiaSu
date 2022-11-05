<?php
$KhoaHoc = new KhoaHoc();
$list = $KhoaHoc->getKhoaHocByMaNguoiDung(getSESSION('MaNguoiDung'));
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
        <div class="col-5 align-self-center">
            <div class="customize-input float-right">
                <select class="custom-select custom-select-set form-control bg-white border-0 custom-shadow custom-radius">
                    <option selected>Aug 19</option>
                    <option value="1">July 19</option>
                    <option value="2">Jun 19</option>
                </select>
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
                        <thead>
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