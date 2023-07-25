<nav class="hk-nav hk-nav-light">
    <a href="javascript:void(0);" id="hk_nav_close" class="hk-nav-close"><span class="feather-icon"><i data-feather="x"></i></span></a>
    <div class="nicescroll-bar">
        <div class="navbar-nav-wrap">
            <ul class="navbar-nav flex-column">
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url() ?>cms/dashboard">
                        <span class="feather-icon"><i data-feather="activity"></i></span>
                        <span class="nav-link-text">Dashboard</span>
                    </a>
                </li>
            </ul>
            <hr class="nav-separator">
            <div class="nav-header">
                <span>Administrator</span>
                <span>NV</span>
            </div>
            <ul class="navbar-nav flex-column">
                <li class="nav-item <?php if (isset($menu)) {
                                        if ($menu == 'user') {
                                            echo 'active';
                                        }
                                    } ?>">
                    <a class="nav-link" href="<?= base_url() ?>cms/pengguna">
                        <span class="feather-icon"><i data-feather="user"></i></span>
                        <span class="nav-link-text">Data Rekrutmen</span>
                    </a>
                </li>
                <!-- <li class="nav-item">
                    <a class="nav-link" href="javascript:void(0);" data-toggle="collapse" data-target="#Components_drp">
                        <span class="feather-icon"><i data-feather="layout"></i></span>
                        <span class="nav-link-text">Master Data</span>
                    </a>
                    <ul id="Components_drp" class="nav flex-column collapse collapse-level-1">
                        <li class="nav-item">
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                    <a class="nav-link" href="<?= base_url() ?>cms/pengguna">Pengguna</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li> -->
            </ul>
        </div>
    </div>
</nav>
<div id="hk_nav_backdrop" class="hk-nav-backdrop"></div>