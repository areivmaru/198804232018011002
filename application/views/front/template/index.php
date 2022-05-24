<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title><?php if ($judul != 'Home') {
                echo (isset($judul) ? $judul . ' | ' : '');
            } ?> Codeigniter Project PDSI</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="Project Trial Pusat Data dan Sistem Informasi" />
    <meta name="keywords" content="Project, Trial, PDSI, Kementerian Perdagangan, Kemendag, Ministry of Trade, Indonesia" />
    <meta name="author" content="Pusat Data dan Sistem Informasi Kementerian Perdagangan Republik Indonesia" />

    <!-- App favicon -->
    <link rel="shortcut icon" href="<?= base_url() ?>public/front/images/favicon.png">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i,900,900i&display=swap" rel="stylesheet">

    <!-- Stylesheets -->
    <link href="<?= base_url() ?>public/front/css/font-awesome-all.css" rel="stylesheet">
    <link href="<?= base_url() ?>public/front/css/flaticon.css" rel="stylesheet">
    <link href="<?= base_url() ?>public/front/css/owl.css" rel="stylesheet">
    <link href="<?= base_url() ?>public/front/css/bootstrap.css" rel="stylesheet">
    <link href="<?= base_url() ?>public/front/css/jquery.fancybox.min.css" rel="stylesheet">
    <link href="<?= base_url() ?>public/front/css/animate.css" rel="stylesheet">
    <link href="<?= base_url() ?>public/front/css/imagebg.css" rel="stylesheet">
    <link href="<?= base_url() ?>public/front/css/color/theme-color.css" id="jssDefault" rel="stylesheet">
    <link href="<?= base_url() ?>public/front/css/switcher-style.css" rel="stylesheet">
    <link href="<?= base_url() ?>public/front/css/rtl.css" rel="stylesheet">
    <link href="<?= base_url() ?>public/front/css/style.css" rel="stylesheet">
    <link href="<?= base_url() ?>public/front/css/responsive.css" rel="stylesheet">

    <!-- Addons CSS Global + Custom Per Pages-->
    <?php $this->load->view('front/css/index'); ?>
    <?php $css ?  $this->load->view('front/css/' . $css)  : '' ?>
</head>


<!-- page wrapper -->

<body class="boxed_wrapper ltr">

    <!-- preloader -->
    <div class="preloader"></div>
    <!-- preloader -->

    <!-- page-direction -->
    <div class="page_direction">
        <div class="demo-rtl direction_switch"><button class="rtl">RTL</button></div>
        <div class="demo-ltr direction_switch"><button class="ltr">LTR</button></div>
    </div>
    <!-- page-direction end -->

    <!-- switcher menu -->
    <div class="switcher">
        <div class="switch_btn">
            <button><i class="fas fa-palette"></i></button>
        </div>
        <div class="switch_menu">
            <!-- color changer -->
            <div class="switcher_container">
                <ul id="styleOptions" title="switch styling">
                    <li>
                        <a href="javascript: void(0)" data-theme="blue" class="blue-color"></a>
                    </li>
                    <li>
                        <a href="javascript: void(0)" data-theme="pink" class="pink-color"></a>
                    </li>
                    <li>
                        <a href="javascript: void(0)" data-theme="violet" class="violet-color"></a>
                    </li>
                    <li>
                        <a href="javascript: void(0)" data-theme="crimson" class="crimson-color"></a>
                    </li>
                    <li>
                        <a href="javascript: void(0)" data-theme="orange" class="orange-color"></a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!-- end switcher menu -->

    <!-- Bagian Header -->
    <?php $this->load->view('front/template/header'); ?>

    <!-- Bagian Isi Konten -->
    <?php $isi ?  $this->load->view('front/pages/' . $isi)  : '' ?>

    <!-- Bagian Footer -->
    <?php $this->load->view('front/template/footer'); ?>

    <!--Scroll to top-->
    <button class="scroll-top scroll-to-target" data-target="html">
        <span class="fa fa-arrow-up"></span>
    </button>


    <!-- jequery plugins -->
    <script src="<?= base_url() ?>public/front/js/jquery.js"></script>
    <script src="<?= base_url() ?>public/front/js/popper.min.js"></script>
    <script src="<?= base_url() ?>public/front/js/bootstrap.min.js"></script>
    <script src="<?= base_url() ?>public/front/js/owl.js"></script>
    <script src="<?= base_url() ?>public/front/js/wow.js"></script>
    <script src="<?= base_url() ?>public/front/js/validation.js"></script>
    <script src="<?= base_url() ?>public/front/js/jquery.fancybox.js"></script>
    <script src="<?= base_url() ?>public/front/js/appear.js"></script>
    <script src="<?= base_url() ?>public/front/js/scrollbar.js"></script>
    <script src="<?= base_url() ?>public/front/js/tilt.jquery.js"></script>
    <script src="<?= base_url() ?>public/front/js/jQuery.style.switcher.min.js"></script>
    <script src="<?= base_url() ?>public/front/js/plugins.js"></script>
    <script src="<?= base_url() ?>public/front/js/text_animation.js"></script>

    <!-- main-js -->
    <script src="<?= base_url() ?>public/front/js/script.js"></script>

    <!-- Addons JS Global + Custom Per Pages-->
    <?php $this->load->view('front/js/index'); ?>
    <?php $js ?  $this->load->view('front/js/' . $js)  : '' ?>

</body><!-- End of .page_wrapper -->

</html>