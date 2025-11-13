<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, maximum-scale=1.0">
        <title>HOME</title>
        <link rel="stylesheet" type="text/css" href="<?= base_url('navbar.css') ?>">
        <script src="https://cdn.jsdelivr.net/npm/@phosphor-icons/web@latest"></script>

    </head>

    <body>
    <nav>
            <div class="Judul">
                <img src="<?= base_url('image/logocapkaki3.png') ?>" alt="3Rental"><label>3RENTAL.COM</label>
            </div>
            <div id="icon-Menu" class="icon-Menu">
                <i class="ph ph-list"></i>
            </div>
            <ul class="nav-links hidden">
                <li class="nav-link"><a href="<?= base_url('admin/home') ?>">Home</a></li>
                <li class="nav-link dropdown-toggle"><a href="<?= base_url('admin/listMobil') ?>">Kategori</a>
                    <i id="dropdown-Arrow" class="ph ph-caret-down"></i>
                    <ul class="dropdown-fullscreen services">
                        <li><a href="#" data-href="<?= base_url('admin/listMobil') ?>">Mobil</a></li>
                        <li><a href="#" data-href="<?= base_url('admin/listMotor') ?>">Motor</a></li>
                    </ul>
                </li>
                <li class="nav-link"><a href="<?= base_url('admin/history') ?>">History</a></li>
                <li class="nav-link"><a href="<?= base_url('auth/logout') ?>">Log Out</a></li>
                <li class="nav-link"><a href="<?= base_url('admin/contact') ?>">Contact</a></li>
            </ul>
            <div id="dropdown-Menu" class="dropdown-menu open">
                <li><a href="<?= base_url('admin/home') ?>">Home</a></li>
                <li class="dropdown-toggle-responsive">
                    <a href="<?= base_url('admin/home') ?>">Kategori</a>
                    <i  class="ph ph-caret-down"></i>
                    <div class="dropdown-responsive">
                        <ul>
                        <li><a href="#" data-href="<?= base_url('admin/listMobil') ?>">Mobil</a></li>
                        <li><a href="#" data-href="<?= base_url('admin/listMotor') ?>">Motor</a></li>
                        </ul>
                    </div>
                </li>
                <li><a href="<?= base_url('admin/history') ?>">History</a></li>
                <li><a href="<?= base_url('auth/logout') ?>">Log Out</a></li>
                <li><a href="<?= base_url('admin/contact') ?>">Contact</a></li>
            </div>
        </nav>
        <script src="<?= base_url('navbar.js') ?>"></script>
    </body>
</html>