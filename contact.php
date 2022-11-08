<?php
include 'views/header.php';
?>
<!-- Breadcrumbs Start -->
<div class="rs-breadcrumbs breadcrumbs-overlay">
    <div class="breadcrumbs-img">
        <img src="assets/images/breadcrumbs/6.jpg" alt="Breadcrumbs Image">
    </div>
    <div class="breadcrumbs-text white-color padding">
        <h1 class="page-title">Liên hệ</h1>
        <ul>
            <li>
                <a class="active" href="./">Trang chủ</a>
            </li>
            <li>Liên hệ</li>
        </ul>
    </div>
</div>
<!-- Breadcrumbs End -->

<!-- Contact Section Start -->
<div class="contact-page-section pt-100 pb-100 md-pt-70 md-pb-70">
    <div class="container">
        <div class="row contact-address-section">
            <div class=" col-lg-4 col-md-12 lg-pl-0 md-mb-30">
                <div class="contact-info contact-address">
                    <div class="icon-part">
                        <i class="fa fa-map-marker"></i>
                    </div>
                    <div class="content-part">
                        <h5 class="info-subtitle">Địa chỉ</h5>
                        <h4 class="info-title">Khu công nghệ cao, quận 9, TP. HCM</h4>
                    </div>
                </div>
            </div>
            <div class=" col-lg-4 col-md-12 md-mb-30">
                <div class="contact-info contact-mail">
                    <div class="icon-part">
                        <i class="fa fa-envelope-o"></i>
                    </div>
                    <div class="content-part">
                        <h5 class="info-subtitle">Email</h5>
                        <h4 class="info-title">contact@wibuteam<br />.edu.vn</h4>
                    </div>
                </div>
            </div>
            <div class=" col-lg-4 col-md-12 lg-pr-0">
                <div class="contact-info contact-phone">
                    <div class="icon-part">
                        <i class="fa fa-user-o"></i>
                    </div>
                    <div class="content-part">
                        <h5 class="info-subtitle">Số điện thoại</h5>
                        <h4 class="info-title">(028)-0000-1111</h4>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-5 md-mb-30">
                <div class="contact-map2">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3918.420594896602!2d106.78291401526066!3d10.855580060694948!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3175276e7ea103df%3A0xb6cf10bb7d719327!2zSHV0ZWNoIEtodSBFIC0gVHJ1bmcgVMOibSDEkMOgbyBU4bqhbyBOaMOibiBM4buxYyBDaOG6pXQgTMaw4bujbmcgQ2Fv!5e0!3m2!1svi!2s!4v1667884540005!5m2!1svi!2s"></iframe>
                </div>
            </div>
            <div class="col-lg-7 pl-30 lg-pl-15">
                <div class="rs-quick-contact new-style">
                    <div class="inner-part mb-50">
                        <h2 class="title mb-15">Liên hệ</h2>
                        <p>Bạn muốn hỏi đáp? Vui lòng gửi thông tin cho chúng tôi.</p>
                    </div>
                    <div id="form-messages"></div>
                    <form id="contact-form" method="post" action="mailer.php">
                        <div class="row">
                            <div class="col-lg-6 mb-35 col-md-12">
                                <input class="from-control" type="text" id="name" name="name" placeholder="Họ tên" required="">
                            </div>
                            <div class="col-lg-6 mb-35 col-md-12">
                                <input class="from-control" type="text" id="email" name="email" placeholder="Email" required="">
                            </div>
                            <div class="col-lg-6 mb-35 col-md-12">
                                <input class="from-control" type="text" id="phone" name="phone" placeholder="Số điện thoại" required="">
                            </div>
                            <div class="col-lg-6 mb-35 col-md-12">
                                <input class="from-control" type="text" id="subject" name="subject" placeholder="Tiêu đề" required="">
                            </div>
                            <div class="col-lg-12 mb-50">
                                <textarea class="from-control" id="message" name="message" placeholder=" Nội dung" required=""></textarea>
                            </div>
                        </div>
                        <div class="form-group mb-0">
                            <input class="btn-send" type="submit" value="Gửi" />
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Contact Section End -->
<?php
include 'views/footer.php';
?>