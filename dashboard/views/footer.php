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
      default:
        return;
    }
  }

  function XoaKhoaHoc(MaKhoaHoc, cfm = false) {
    if (cfm == true) {
      if (!MaKhoaHoc) MaKhoaHoc = $('#MKH_delete').val();
      $.ajax({
        type: "DELETE",
        headers: {
          'Authorization': 'Bearer <?php echo getSESSION('token'); ?>'
        },
        url: "<?php echo API_URL; ?>/KhoaHoc/" + MaKhoaHoc,
        success: function(result) {
          if (result.success) {
            window.location.reload();
          } else $.notify("Không thể xoá khoá học!", "error");
        }
      });
    } else {
      $('#MKH_delete').val(MaKhoaHoc);
      $('#confirm-delete-modal').modal('show');
    }
  }
</script>
</body>

</html>