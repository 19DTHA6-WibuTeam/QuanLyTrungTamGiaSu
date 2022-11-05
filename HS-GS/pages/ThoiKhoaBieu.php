<?php
$KhoaHoc = new KhoaHoc();
$ThongTinDangKy = $KhoaHoc->getThongTinDangKy();
// var_dump($ThongTinDangKy);
$ttdk = json_decode($ThongTinDangKy, true);
$ttdk = $ttdk['data'];

$KhoaHocTKB = $KhoaHoc->getKhoaHocTKB('MaHocSinh', getSESSION('MaNguoiDung'));
$KhoaHocTKB = json_decode($KhoaHocTKB, true);
$list = $KhoaHoc->getThoiKhoaBieu('MaHocSinh', getSESSION('MaNguoiDung'));
$list = json_decode($list, true);
?>
<div class="page-breadcrumb">
    <div class="row">
        <div class="col-7 align-self-center">
            <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">Calendar</h4>
            <div class="d-flex align-items-center">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb m-0 p-0">
                        <li class="breadcrumb-item text-muted active" aria-current="page">Apps</li>
                        <li class="breadcrumb-item text-muted" aria-current="page">Calendar</li>
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
                    <h4 class="card-title">Thời khoá biểu</h4>
                </div>
                <div class="table-responsive">
                    <style>
                        th,
                        td {
                            text-align: center;
                        }
                    </style>
                    <table class="table table-bordered table-hover">
                        <thead class="bg-info text-white">
                            <tr>
                                <th scope="col">Lịch học</th>
                                <?php
                                foreach ($ttdk['ThuTrongTuan'] as $v) {
                                    echo '<th scope="col"><strong>' . $v['TenThu'] . '</strong></th>';
                                }
                                ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($ttdk['CaHoc'] as $k => $v) {
                                echo '<tr><th scope="row"><strong>' . str_replace(':00', '', $v['GioBatDau']) . ' - ' . str_replace(':00', '', $v['GioKetThuc']) . '</strong></th>';
                                $desc = '';
                                foreach ($ttdk['ThuTrongTuan'] as $kk => $vv) {
                                    $flag = false;
                                    foreach ($list['data'] as $kkk => $vvv)
                                        if ($v['MaCaHoc'] == $vvv['MaCaHoc'] && $vv['MaThu'] == $vvv['MaThu']) {
                                            $flag = true;
                                            echo '<td>' . $vvv['TenMonHoc'] . '<br/>#' . $vvv['MaKhoaHoc'] . '</td>';
                                            break;
                                        }

                                    if (!$flag)
                                        echo '<td></td>';
                                }
                                echo '</tr>';
                            }
                            ?>
                        </tbody>
                    </table>
                    <table class="table table-bordered table-hover">
                        <thead class="bg-danger text-white">
                            <tr>
                                <th scope="col">Mã khoá học</th>
                                <th scope="col">Tên môn học</th>
                                <th scope="col">Ngày bắt đầu</th>
                                <th scope="col">Số tuần</th>
                                <th scope="col">Ngày kết thúc</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($KhoaHocTKB['data'] as $k => $v) {
                                echo '<tr>
                                        <td>#' . $v['MaKhoaHoc'] . '</td>
                                        <td>' . $v['TenMonHoc'] . '</td>
                                        <td>' . $v['NgayBatDau'] . '</td>
                                        <td>' . $v['SoTuan'] . '</td>
                                        <td>' . $v['NgayKetThuc'] . '</td>
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