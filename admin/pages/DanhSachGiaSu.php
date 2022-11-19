<?php
$NguoiDung = new NguoiDung();
if (getGET('HoTen') || getGET('SDT'))
    $list = $NguoiDung->getList('1', getGET('HoTen'), getGET('SDT'));
else
    $list = $NguoiDung->getList('1');
$list = json_decode($list, true);
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Tìm kiếm</h4>
                    <form method="GET" action="">
                        <div class="form-body">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group mb-4">
                                        <label for="HoTen">Theo họ tên</label>
                                        <input type="text" class="form-control" id="HoTen" name="HoTen" value="<?php echo htmlentities(getGET('HoTen')); ?>" />
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group mb-4">
                                        <label for="HoTen">Theo SDT</label>
                                        <input type="text" class="form-control" id="SDT" name="SDT" value="<?php echo htmlentities(getGET('SDT')); ?>" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-actions">
                            <div class="text-right">
                                <button type="submit" class="btn btn-info">Tìm</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
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