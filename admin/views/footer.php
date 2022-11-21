 <footer class="footer text-center text-muted">
   © 2022 <a href="./index.html">WibuTeam</a>.
 </footer>
 </div>
 </div>
 <script src="../dashboard/assets/libs/jquery/dist/jquery.min.js"></script>
 <script src="../dashboard/assets/libs/popper.js/dist/umd/popper.min.js"></script>
 <script src="../dashboard/assets/libs/bootstrap/dist/js/bootstrap.min.js"></script>
 <!-- apps -->
 <!-- apps -->
 <script src="../dashboard/dist/js/app-style-switcher.js"></script>
 <script src="../dashboard/dist/js/feather.min.js"></script>
 <script src="../dashboard/assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js"></script>
 <script src="../dashboard/dist/js/sidebarmenu.js"></script>
 <!--Custom JavaScript -->
 <script src="../dashboard/dist/js/custom.min.js"></script>
 <!--This page JavaScript -->
 <script src="../dashboard/assets/extra-libs/c3/d3.min.js"></script>
 <script src="../dashboard/assets/extra-libs/c3/c3.min.js"></script>
 <script src="../dashboard/assets/libs/chartist/dist/chartist.min.js"></script>
 <script src="../dashboard/assets/libs/chartist-plugin-tooltips/dist/chartist-plugin-tooltip.min.js"></script>
 <script src="../dashboard/assets/extra-libs/jvector/jquery-jvectormap-2.0.2.min.js"></script>
 <script src="../dashboard/assets/extra-libs/jvector/jquery-jvectormap-world-mill-en.js"></script>
 <script src="../dashboard/dist/js/pages/dashboards/dashboard1.min.js"></script>
 <script src="//rawgit.com/notifyjs/notifyjs/master/dist/notify.js"></script>
 <script>
   $(document).ready(function() {
     $('[data-toggle="popover"]').popover({
       placement: 'top',
       trigger: 'hover'
     });
   });

   if (window.history.replaceState) {
     window.history.replaceState(null, null, window.location.href);
   }

   function redirectParams(name, value) {
     var url = new URL(window.location.href);
     url.searchParams.set(name, value);
     window.location.href = url.href;
   }

   function pagination(num) {
     redirectParams('pn', num);
   }

   function showNotify(key) {
     switch (key) {
       case 'no-edit':
         $.notify("Khoá học đang tiến hành. Không thể chỉnh sửa!", "error");
         return;
       case 'no-delete':
         $.notify("Khoá học đang tiến hành. Không thể xoá!", "error");
         return;
       case 'no-tutor':
         $.notify("Khoá học chưa có người dạy!", "error");
         return;
       case 'no-image':
         $.notify("Không có ảnh để xem!", "error");
         return;
       default:
         return;
     }
   }

   function DangKyGiaSu(MaNguoiDung, cfm = false) {
     if (cfm == true) {
       if (!MaNguoiDung) MaNguoiDung = $('#MND_giasu').val();
       $.notify("Đang thay đổi...", "warning");
       $.ajax({
         type: "POST",
         headers: {
           'Authorization': 'Bearer <?php echo getSESSION('admin_token'); ?>'
         },
         url: "<?php echo API_URL; ?>/NguoiDung/DangKyGiaSu/" + MaNguoiDung,
         success: function(result) {
           if (result.success) {
             $.notify(result.message, "success");
             setTimeout(function() {
               window.location.reload();
             }, 5000);
           } else $.notify("Không thể đăng ký gia sư!", "error");
         }
       });
     } else {
       $('#MND_giasu').val(MaNguoiDung);
       $('#confirm-giasu-modal').modal('show');
     }
   }

   function ThayDoiTinhTrangKhoaHoc(MaKhoaHoc, status, cfm = false) {
     if (cfm == true) {
       if (!MaKhoaHoc) MaKhoaHoc = $('#MKH_change').val();
       $.notify("Đang thay đổi...", "warning");
       $.ajax({
         type: "POST",
         headers: {
           'Authorization': 'Bearer <?php echo getSESSION('admin_token'); ?>'
         },
         data: 'TinhTrang=' + $('#TinhTrang_change').val(),
         url: "<?php echo API_URL; ?>/KhoaHoc/TinhTrang/" + MaKhoaHoc,
         success: function(result) {
           if (result.success) {
             $.notify(result.message, "success");
             setTimeout(function() {
               window.location.reload();
             }, 5000);
           } else {
             $.notify("Không thể thay đổi tình trạng khoá học!", "error");
           }
         }
       });
     } else {
       $('#MKH_change').val(MaKhoaHoc);
       $('#TinhTrang_change').val(status);
       $('#confirm-change-modal').modal('show');
     }
   }

   function XoaKhoaHoc(MaKhoaHoc, cfm = false) {
     if (cfm == true) {
       if (!MaKhoaHoc) MaKhoaHoc = $('#MKH_delete').val();
       $.notify("Đang xoá...", "warning");
       $.ajax({
         type: "DELETE",
         headers: {
           'Authorization': 'Bearer <?php echo getSESSION('admin_token'); ?>'
         },
         url: "<?php echo API_URL; ?>/KhoaHoc/" + MaKhoaHoc,
         success: function(result) {
           if (result.success) {
             $.notify(result.message, "success");
             setTimeout(function() {
               window.location.reload();
             }, 5000);
           } else $.notify("Không thể xoá khoá học!", "error");
         }
       });
     } else {
       $('#MKH_delete').val(MaKhoaHoc);
       $('#confirm-delete-modal').modal('show');
     }
   }

   function HuyLichDay(MaKhoaHoc, cfm = false) {
     if (cfm == true) {
       if (!MaKhoaHoc) MaKhoaHoc = $('#MKH_cancel').val();
       $.notify("Đang huỷ...", "warning");
       $.ajax({
         type: "DELETE",
         headers: {
           'Authorization': 'Bearer <?php echo getSESSION('admin_token'); ?>'
         },
         url: "<?php echo API_URL; ?>/KhoaHoc/GiangDay/" + MaKhoaHoc,
         success: function(result) {
           if (result.success) {
             $.notify(result.message, "success");
             setTimeout(function() {
               window.location.reload();
             }, 5000);
           } else $.notify("Không thể huỷ lịch dạy!", "error");
         }
       });
     } else {
       $('#MKH_cancel').val(MaKhoaHoc);
       $('#confirm-cancel-modal').modal('show');
     }
   }

   function XemAnh(src) {
     $("#xem-anh-src").attr("src", src);
     $('#xem-anh-modal').modal('show');
   }

   function XoaChuyenMon(MaChuyenMon, cfm = false) {
     if (cfm == true) {
       if (!MaChuyenMon) MaChuyenMon = $('#MCM_delete').val();
       $.notify("Đang xoá...", "warning");
       $.ajax({
         type: "DELETE",
         headers: {
           'Authorization': 'Bearer <?php echo getSESSION('admin_token'); ?>'
         },
         url: "<?php echo API_URL; ?>/ChuyenMon/" + MaChuyenMon,
         success: function(result) {
           if (result.success) {
             $.notify(result.message, "success");
             setTimeout(function() {
               window.location.reload();
             }, 5000);
           } else $.notify("Không thể xoá chuyên môn!", "error");
         }
       });
     } else {
       $('#MCM_delete').val(MaChuyenMon);
       $('#confirm-delete-modal').modal('show');
     }
   }

   function XacNhanThanhToan(MaHoaDon, cfm = false) {
     if (cfm == true) {
       if (!MaHoaDon) MaHoaDon = $('#MHD_payment').val();
       $.notify("Đang xác nhận...", "warning");
       $.ajax({
         type: "POST",
         headers: {
           'Authorization': 'Bearer <?php echo getSESSION('admin_token'); ?>'
         },
         url: "<?php echo API_URL; ?>/HoaDon/ThanhToan/" + MaHoaDon + '?TinhTrang=1',
         success: function(result) {
           if (result.success) {
             $.notify(result.message, "success");
             setTimeout(function() {
               window.location.reload();
             }, 5000);
           } else $.notify("Không thể xác nhận thanh toán!", "error");
         }
       });
     } else {
       $('#MHD_payment').val(MaHoaDon);
       $('#confirm-payment-modal').modal('show');
     }
   }
 </script>
 </body>

 </html>