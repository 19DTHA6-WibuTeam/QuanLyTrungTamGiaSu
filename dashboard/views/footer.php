<!-- ============================================================== -->
<!-- footer -->
<!-- ============================================================== -->
<footer class="footer text-center text-muted">
  All Rights Reserved 2022. Developed by <a href="#">WibuTeam</a>.
</footer>
<!-- ============================================================== -->
<!-- End footer -->
<!-- ============================================================== -->
</div>
<!-- ============================================================== -->
<!-- End Page wrapper  -->
<!-- ============================================================== -->
</div>
<!-- ============================================================== -->
<!-- End Wrapper -->
<!-- ============================================================== -->
<!-- End Wrapper -->
<!-- ============================================================== -->
<!-- All Jquery -->
<!-- ============================================================== -->
<script src="assets/libs/jquery/dist/jquery.min.js"></script>
<script src="assets/libs/popper.js/dist/umd/popper.min.js"></script>
<script src="assets/libs/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- apps -->
<script src="dist/js/app-style-switcher.js"></script>
<script src="dist/js/feather.min.js"></script>
<script src="assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js"></script>
<script src="dist/js/sidebarmenu.js"></script>
<!--Custom JavaScript -->
<script src="dist/js/custom.min.js"></script>
<!--This page JavaScript -->
<script src="assets/extra-libs/c3/d3.min.js"></script>
<script src="assets/libs/chartist/dist/chartist.min.js"></script>
<script src="assets/libs/chartist-plugin-tooltips/dist/chartist-plugin-tooltip.min.js"></script>
<script src="assets/extra-libs/jvector/jquery-jvectormap-2.0.2.min.js"></script>
<script src="assets/extra-libs/jvector/jquery-jvectormap-world-mill-en.js"></script>
<script src="dist/js/pages/dashboards/dashboard1.min.js"></script>
<script src="//rawgit.com/notifyjs/notifyjs/master/dist/notify.js"></script>
<script>
  $(document).ready(function() {
    $('[data-toggle="popover"]').popover({
      placement: 'top',
      trigger: 'hover'
    });
  });
  // if (window.history.replaceState) {
  //   window.history.replaceState(null, null, window.location.href);
  // }
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

  function XemAnh(src) {
    $("#xem-anh-src").attr("src", src);
    $('#xem-anh-modal').modal('show');
  }

  function XoaKhoaHoc(MaKhoaHoc, cfm = false) {
    if (cfm == true) {
      if (!MaKhoaHoc) MaKhoaHoc = $('#MKH_delete').val();
      $.notify("Đang xoá...", "warning");
      $.ajax({
        type: "DELETE",
        headers: {
          'Authorization': 'Bearer <?php echo getSESSION('token'); ?>'
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

  function XoaChuyenMon(MaChuyenMon, cfm = false) {
    if (cfm == true) {
      if (!MaChuyenMon) MaChuyenMon = $('#MCM_delete').val();
      $.notify("Đang xoá...", "warning");
      $.ajax({
        type: "DELETE",
        headers: {
          'Authorization': 'Bearer <?php echo getSESSION('token'); ?>'
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

  function DangKyDay(MaKhoaHoc, cfm = false) {
    if (cfm == true) {
      if (!MaKhoaHoc) MaKhoaHoc = $('#MKH_dangky').val();
      $.notify("Đang đăng ký...", "warning");
      $.ajax({
        type: "POST",
        headers: {
          'Authorization': 'Bearer <?php echo getSESSION('token'); ?>'
        },
        url: "<?php echo API_URL; ?>/KhoaHoc/GiangDay/" + MaKhoaHoc,
        success: function(result) {
          if (result.success) {
            $.notify(result.message, "success");
            setTimeout(function() {
              window.location.reload();
            }, 5000);
          } else $.notify("Không thể đăng ký dạy khoá học!", "error");
        }
      });
    } else {
      $('#MKH_dangky').val(MaKhoaHoc);
      $('#confirm-dangky-modal').modal('show');
    }
  }
</script>
</body>

</html>