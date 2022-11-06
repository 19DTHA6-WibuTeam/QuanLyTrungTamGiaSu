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
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Danh sách hoá đơn</h4>
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
                                            echo '<td data-toggle="popover" data-html="true" title="Mã: #' . $vvv['MaKhoaHoc'] . '" data-content="Ngày bắt đầu: ' . $vvv['NgayBatDau'] . '<br/>Số tuần: ' . $vvv['SoTuan'] . '<br/>Ngày kết thúc: ' . $vvv['NgayKetThuc'] . '<br/>Họ tên: ' . $vvv['HoTen'] . '<br/>Địa chỉ: ' . $vvv['DiaChi'] . '<br/>SĐT: ' . $vvv['SDT'] . '">' . $vvv['TenMonHoc'] . '<br/></td>';
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
                </div>
            </div>
        </div>

    </div>
</div>