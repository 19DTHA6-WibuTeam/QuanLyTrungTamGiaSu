<?php
$HoaDon = new HoaDon();
$list = $HoaDon->getByUserId(getSESSION('MaNguoiDung'));
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
                                <th scope="col">Mã HĐ</th>
                                <th scope="col">Tình trạng</th>
                                <th scope="col">Số tiền</th>
                                <th scope="col">Ghi chú</th>
                                <th scope="col">Khác</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($list['data'] as $k => $v) {
                                echo '<tr><th scope="row"><strong>' . $v['MaHoaDon'] . '</strong></th>';
                                echo '<td>' . ($v['TinhTrang'] == 0 ? 'Chưa thanh toán' : 'Đã thanh toán') . '</td>';
                                echo '<td>' . formatPrice($v['SoTien']) . ' đ</td>';
                                echo '<td>' . $v['GhiChu'] . '</td>';
                                echo '<td><a type="button" class="btn waves-effect waves-light btn-primary btn-sm" href="ChiTietHoaDon.html?MaHoaDon=' . $v['MaHoaDon'] . '">Xem chi tiết</a></td>';
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