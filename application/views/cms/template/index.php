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

    <!-- Data Table CSS -->
    <link href="<?= base_url() ?>public/cms/vendors/datatables.net-dt/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url() ?>public/cms/vendors/datatables.net-responsive-dt/css/responsive.dataTables.min.css" rel="stylesheet" type="text/css" />

    <!-- vector map CSS -->
    <link href="<?= base_url() ?>public/cms/vendors/vectormap/jquery-jvectormap-2.0.3.css" rel="stylesheet" type="text/css" />

    <!-- Toggles CSS -->
    <link href="<?= base_url() ?>public/cms/vendors/jquery-toggles/css/toggles.css" rel="stylesheet" type="text/css">
    <link href="<?= base_url() ?>public/cms/vendors/jquery-toggles/css/themes/toggles-light.css" rel="stylesheet" type="text/css">

    <!-- Toastr CSS -->
    <link href="<?= base_url() ?>public/cms/vendors/jquery-toast-plugin/dist/jquery.toast.min.css" rel="stylesheet" type="text/css">

    <!-- Custom CSS -->
    <link href="<?= base_url() ?>public/cms/dist/css/style.css" rel="stylesheet" type="text/css">

    <!-- Addons CSS Global + Custom Per Pages-->
    <?php $this->load->view('cms/css/index'); ?>
    <?php $css ?  $this->load->view('cms/css/' . $css)  : '' ?>
</head>

<body>
    <!-- Preloader -->
    <div class="preloader-it">
        <div class="loader-pendulums"></div>
    </div>
    <!-- /Preloader -->

    <!-- HK Wrapper -->
    <div class="hk-wrapper hk-vertical-nav">

        <!-- Top Navbar -->
        <?php $this->load->view('cms/template/topnav'); ?>
        <!-- /Top Navbar -->

        <!-- Vertical Nav -->
        <?php $this->load->view('cms/template/sidenav'); ?>
        <!-- /Vertical Nav -->

        <!-- Setting Panel -->
        <?php $this->load->view('cms/template/settingsnav'); ?>
        <!-- /Setting Panel -->

        <!-- Main Content -->
        <div class="hk-pg-wrapper">
            <!-- Bagian Isi -->
            <?php $isi ?  $this->load->view('cms/pages/' . $isi)  : '' ?>
            <!-- /Container -->

            <!-- Footer -->
            <?php $this->load->view('cms/template/footer'); ?>
            <!-- /Footer -->
        </div>
        <!-- /Main Content -->

    </div>
    <!-- /HK Wrapper -->

    <!-- jQuery -->
    <script src="<?= base_url() ?>public/cms/vendors/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="<?= base_url() ?>public/cms/vendors/popper.js/dist/umd/popper.min.js"></script>
    <script src="<?= base_url() ?>public/cms/vendors/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Slimscroll JavaScript -->
    <script src="<?= base_url() ?>public/cms/dist/js/jquery.slimscroll.js"></script>

    <!-- Data Table JavaScript -->
    <script src="<?= base_url() ?>public/cms/vendors/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="<?= base_url() ?>public/cms/vendors/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="<?= base_url() ?>public/cms/vendors/datatables.net-dt/js/dataTables.dataTables.min.js"></script>
    <script src="<?= base_url() ?>public/cms/vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="<?= base_url() ?>public/cms/vendors/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js"></script>
    <script src="<?= base_url() ?>public/cms/vendors/datatables.net-buttons/js/buttons.flash.min.js"></script>
    <script src="<?= base_url() ?>public/cms/vendors/jszip/dist/jszip.min.js"></script>
    <script src="<?= base_url() ?>public/cms/vendors/pdfmake/build/pdfmake.min.js"></script>
    <script src="<?= base_url() ?>public/cms/vendors/pdfmake/build/vfs_fonts.js"></script>
    <script src="<?= base_url() ?>public/cms/vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <script src="<?= base_url() ?>public/cms/vendors/datatables.net-buttons/js/buttons.print.min.js"></script>
    <script src="<?= base_url() ?>public/cms/vendors/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="<?= base_url() ?>public/cms/dist/js/dataTables-data.js"></script>

    <!-- Fancy Dropdown JS -->
    <script src="<?= base_url() ?>public/cms/dist/js/dropdown-bootstrap-extended.js"></script>

    <!-- FeatherIcons JavaScript -->
    <script src="<?= base_url() ?>public/cms/dist/js/feather.min.js"></script>

    <!-- Toggles JavaScript -->
    <script src="<?= base_url() ?>public/cms/vendors/jquery-toggles/toggles.min.js"></script>
    <script src="<?= base_url() ?>public/cms/dist/js/toggle-data.js"></script>

    <!-- Counter Animation JavaScript -->
    <script src="<?= base_url() ?>public/cms/vendors/waypoints/lib/jquery.waypoints.min.js"></script>
    <script src="<?= base_url() ?>public/cms/vendors/jquery.counterup/jquery.counterup.min.js"></script>

    <!-- EChartJS JavaScript -->
    <script src="<?= base_url() ?>public/cms/vendors/echarts/dist/echarts-en.min.js"></script>


    <!-- Vector Maps JavaScript -->
    <script src="<?= base_url() ?>public/cms/vendors/vectormap/jquery-jvectormap-2.0.3.min.js"></script>
    <script src="<?= base_url() ?>public/cms/vendors/vectormap/jquery-jvectormap-world-mill-en.js"></script>
    <script src="<?= base_url() ?>public/cms/dist/js/vectormap-data.js"></script>

    <!-- Owl JavaScript -->
    <script src="<?= base_url() ?>public/cms/vendors/owl.carousel/dist/owl.carousel.min.js"></script>

    <!-- Toastr JS -->
    <script src="<?= base_url() ?>public/cms/vendors/jquery-toast-plugin/dist/jquery.toast.min.js"></script>

    <!-- Init JavaScript -->
    <script src="<?= base_url() ?>public/cms/dist/js/init.js"></script>
    <!-- Addons js Global + Custom Per Pages-->

    <?php $this->load->view('cms/js/index'); ?>
    <?php $js ?  $this->load->view('cms/js/' . $js)  : '' ?>

</body>

</html>