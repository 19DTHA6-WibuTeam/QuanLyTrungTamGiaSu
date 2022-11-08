<?php
$NguoiDung = new NguoiDung();
$list = $NguoiDung->getList('1');
$list = json_decode($list, true);
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="zero_config" class="table table-striped table-bordered no-wrap">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Họ tên</th>
                                    <th>DOB</th>
                                    <th>Giới tính</th>
                                    <th>Số Điện Thoại</th>
                                    <th>Email</th>
                                    <th>Chi Tiết</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($list['data'] as $k => $v) {
                                    echo '<tr>
                                            <td>#' . $v['MaNguoiDung'] . '</td>
                                            <td>' . $v['HoTen'] . '</td>
                                            <td>' . $v['NgaySinh'] . '</td>
                                            <td>' . ($v['GioiTinh'] == 1 ? 'Nam' : 'Nữ') . '</td>
                                            <td>' . $v['SDT'] . '</td>
                                            <td>' . $v['Email'] . '</td>
                                            <td>
                                                <a href="ChiTietNguoiDung.html?MaNguoiDung=' . $v['MaNguoiDung'] . '"><i class="fa fa-eye"></i></a>
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
</div>