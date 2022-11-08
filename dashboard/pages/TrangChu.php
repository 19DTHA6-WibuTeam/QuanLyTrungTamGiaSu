<?php
$ThongKe = new ThongKe();
$tk = json_decode($ThongKe->getByUser((getSESSION('LaGiaSu') == 1 ? 'GiaSu' : 'HocSinh'), getSESSION('MaNguoiDung')), true)['data'];
?>
<div class="container-fluid">
    <div class="card-group">
        <div class="card border-right">
            <div class="card-body">
                <div class="d-flex d-lg-flex d-md-block align-items-center">
                    <div>
                        <div class="d-inline-flex align-items-center">
                            <h2 class="text-dark mb-1 font-weight-medium"><?php echo $tk['KhoaHoc']['TongKhoaHoc']; ?></h2>
                        </div>
                        <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate">Tổng khoá học</h6>
                    </div>
                    <div class="ml-auto mt-md-3 mt-lg-0">
                        <span class="opacity-7 text-muted"><i data-feather="file-plus"></i></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="card border-right">
            <div class="card-body">
                <div class="d-flex d-lg-flex d-md-block align-items-center">
                    <div>
                        <h2 class="text-dark mb-1 font-weight-medium"><?php echo $tk['KhoaHoc']['tt_2']; ?></h2>
                        <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate">Khoá học đang tiến hành</h6>
                    </div>
                    <div class="ml-auto mt-md-3 mt-lg-0">
                        <span class="opacity-7 text-muted"><i data-feather="file-plus"></i></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <div class="d-flex d-lg-flex d-md-block align-items-center">
                    <div>
                        <h2 class="text-dark mb-1 font-weight-medium"><?php echo $tk['KhoaHoc']['tt_3']; ?></h2>
                        <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate">Khoá học hoàn thành</h6>
                    </div>
                    <div class="ml-auto mt-md-3 mt-lg-0">
                        <span class="opacity-7 text-muted"><i data-feather="file-plus"></i></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>