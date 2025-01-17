<!DOCTYPE html>
<html dir="ltr" lang="vi">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta name="description" content="" />
  <meta name="author" content="" />
  <!-- Favicon icon -->
  <link rel="icon" type="image/png" sizes="16x16" href="assets/images/favicon.png" />
  <title>Trang thông tin</title>
  <!-- Custom CSS -->
  <link href="assets/extra-libs/c3/c3.min.css" rel="stylesheet" />
  <link href="assets/libs/chartist/dist/chartist.min.css" rel="stylesheet" />
  <link href="assets/extra-libs/jvector/jquery-jvectormap-2.0.2.css" rel="stylesheet" />
  <!-- Custom CSS -->
  <link href="dist/css/style.min.css" rel="stylesheet" />
  <link href="dist/css/another.css" rel="stylesheet" />
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css" />
  <link href='https://fonts.googleapis.com/css?family=Kaushan+Script' rel='stylesheet' type='text/css' />
  <link href='https://fonts.googleapis.com/css?family=Droid+Serif:400,700,400italic,700italic' rel='stylesheet' type='text/css' />
  <link href='https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700' rel='stylesheet' type='text/css' />
</head>

<body>
  <!-- ============================================================== -->
  <!-- Preloader - style you can find in spinners.css -->
  <!-- ============================================================== -->
  <div class="preloader">
    <div class="lds-ripple">
      <div class="lds-pos"></div>
      <div class="lds-pos"></div>
    </div>
  </div>
  <!-- ============================================================== -->
  <!-- Main wrapper - style you can find in pages.scss -->
  <!-- ============================================================== -->
  <div id="main-wrapper" data-theme="light" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed" data-boxed-layout="full">
    <!-- ============================================================== -->
    <!-- Topbar header - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <header class="topbar" data-navbarbg="skin6">
      <nav class="navbar top-navbar navbar-expand-md">
        <div class="navbar-header" data-logobg="skin6">
          <!-- This is for the sidebar toggle which is visible on mobile only -->
          <a class="nav-toggler waves-effect waves-light d-block d-md-none" href="javascript:void(0)"><i class="ti-menu ti-close"></i></a>
          <!-- ============================================================== -->
          <!-- Logo -->
          <!-- ============================================================== -->
          <div class="navbar-brand">
            <!-- Logo icon -->
            <a href="./">
              <b class="logo-icon">
                <!-- Dark Logo icon -->
                <img src="assets/images/logo-icon.png" alt="homepage" class="dark-logo" />
                <!-- Light Logo icon -->
                <img src="assets/images/logo-icon.png" alt="homepage" class="light-logo" />
              </b>
              <!--End Logo icon -->
              <!-- Logo text -->
              <span class="logo-text">
                <!-- dark Logo text -->
                <img src="assets/images/logo-text.png" alt="homepage" class="dark-logo" />
                <!-- Light Logo text -->
                <img src="assets/images/logo-light-text.png" class="light-logo" alt="homepage" />
              </span>
            </a>
          </div>
          <!-- ============================================================== -->
          <!-- End Logo -->
          <!-- ============================================================== -->
          <!-- ============================================================== -->
          <!-- Toggle which is visible on mobile only -->
          <!-- ============================================================== -->
          <a class="topbartoggler d-block d-md-none waves-effect waves-light" href="javascript:void(0)" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><i class="ti-more"></i></a>
        </div>
        <!-- ============================================================== -->
        <!-- End Logo -->
        <!-- ============================================================== -->
        <div class="navbar-collapse collapse" id="navbarSupportedContent">
          <!-- ============================================================== -->
          <!-- toggle and nav items -->
          <!-- ============================================================== -->
          <ul class="navbar-nav float-left mr-auto ml-3 pl-1">
          </ul>
          <!-- ============================================================== -->
          <!-- Right side toggle and nav items -->
          <!-- ============================================================== -->
          <ul class="navbar-nav float-right">
            <!-- <li class="nav-item d-none d-md-block">
              <a class="nav-link" href="javascript:void(0)">
                <form>
                  <div class="customize-input">
                    <input class="form-control custom-shadow custom-radius border-0 bg-white" type="search" placeholder="Search" aria-label="Search">
                    <i class="form-control-icon" data-feather="search"></i>
                  </div>
                </form>
              </a>
            </li> -->
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="javascript:void(0)" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <img src="<?php echo getSESSION('Avatar') ? getSESSION('Avatar') : 'assets/images/users/profile.jpg'; ?>" alt="user" class="rounded-circle square-img" width="40">
                <span class="ml-2 d-none d-lg-inline-block"><span>Xin chào,</span> <span class="text-dark"><?php echo getSESSION('HoTen'); ?></span> <i data-feather="chevron-down" class="svg-icon"></i></span>
              </a>
              <div class="dropdown-menu dropdown-menu-right user-dd animated flipInY">
                <a class="dropdown-item" href="TrangCaNhan.html"><i data-feather="user" class="svg-icon mr-2 ml-1"></i>Trang cá nhân</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="logout.html"><i data-feather="power" class="svg-icon mr-2 ml-1"></i>Đăng xuất</a>
              </div>
            </li>
            <!-- ============================================================== -->
            <!-- User profile and search -->
            <!-- ============================================================== -->
          </ul>
        </div>
      </nav>
    </header>
    <!-- ============================================================== -->
    <!-- End Topbar header -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Left Sidebar - style you can find in sidebar.scss  -->
    <!-- ============================================================== -->
    <aside class="left-sidebar" data-sidebarbg="skin6">
      <!-- Sidebar scroll-->
      <div class="scroll-sidebar" data-sidebarbg="skin6">
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
          <ul id="sidebarnav">
            <li class="list-divider"></li>
            <li class="nav-small-cap"><span class="hide-menu">Dashboard</span></li>
            <li class="sidebar-item"> <a class="sidebar-link" href="TrangChu.html" aria-expanded="false"><i data-feather="home" class="feather-icon"></i><span class="hide-menu">Tổng quan</span></a></li>
            <li class="list-divider"></li>
            <li class="nav-small-cap"><span class="hide-menu">Khoá học</span></li>
            <?php if (!getSESSION('LaGiaSu')) { ?>
              <li class="sidebar-item"> <a class="sidebar-link" href="DangKyKhoaHoc.html" aria-expanded="false"><i data-feather="tag" class="feather-icon"></i><span class="hide-menu">Đăng ký khoá học</span></a></li>
            <?php } else { ?>
              <li class="sidebar-item"> <a class="sidebar-link" href="DanhSachKhoaHoc.html" aria-expanded="false"><i data-feather="message-square" class="feather-icon"></i><span class="hide-menu">Đăng ký lịch dạy</span></a></li>
            <?php } ?>
            <li class="sidebar-item"> <a class="sidebar-link" href="KhoaHocDangKy.html" aria-expanded="false"><i data-feather="message-square" class="feather-icon"></i><span class="hide-menu"><?php echo getSESSION('LaGiaSu') ? 'Lịch dạy' : 'Khoá học'; ?> đã đăng ký</span></a></li>
            <li class="sidebar-item"> <a class="sidebar-link" href="ThoiKhoaBieu.html" aria-expanded="false"><i data-feather="message-square" class="feather-icon"></i><span class="hide-menu">Thời khoá biểu</span></a></li>
            <li class="list-divider"></li>
            <li class="nav-small-cap"><span class="hide-menu">Thanh toán</span></li>
            <li class="sidebar-item"> <a class="sidebar-link" href="HoaDon.html" aria-expanded="false"><i data-feather="calendar" class="feather-icon"></i><span class="hide-menu">Hoá đơn</span></a></li>
            <li class="list-divider"></li>
            <li class="nav-small-cap"><span class="hide-menu">Người dùng</span></li>
            <li class="sidebar-item"> <a class="sidebar-link" href="TrangCaNhan.html" aria-expanded="false"><i data-feather="calendar" class="feather-icon"></i><span class="hide-menu">Trang cá nhân</span></a></li>
            <?php if (getSESSION('LaGiaSu')) { ?>
              <li class="sidebar-item"> <a class="sidebar-link" href="DanhSachChuyenMon.html" aria-expanded="false"><i data-feather="message-square" class="feather-icon"></i><span class="hide-menu">Chuyên môn</span></a></li>
              <li class="sidebar-item"> <a class="sidebar-link" href="ChuyenMon.html" aria-expanded="false"><i data-feather="message-square" class="feather-icon"></i><span class="hide-menu">Thêm chuyên môn</span></a></li>
            <?php } ?>
            <li class="list-divider"></li>
            <li class="sidebar-item"> <a class="sidebar-link" href="logout.html" aria-expanded="false"><i data-feather="calendar" class="feather-icon"></i><span class="hide-menu">Đăng xuất</span></a></li>
          </ul>
        </nav>
        <!-- End Sidebar navigation -->
      </div>
      <!-- End Sidebar scroll-->
    </aside>
    <!-- ============================================================== -->
    <!-- End Left Sidebar - style you can find in sidebar.scss  -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Page wrapper  -->
    <!-- ============================================================== -->
    <div class="page-wrapper">