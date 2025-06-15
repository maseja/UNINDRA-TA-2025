<?php
include 'functions.php';
//if(empty(_session('login')))
//header("location:login.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />	
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="icon" href="assets/ico.png" />

    <title>SISTEM PAKAR Penentuan Jenis Pelatihan Kerja yang Sesuai dengan Profile Pencari Kerja Menggunakan Metode Forward Chaining pada Kementerian Ketenagakerjaan RI</title>
    <link href="assets/css/yeti-bootstrap.min.css" rel="stylesheet" />
    <link href="assets/css/general.css" rel="stylesheet" />
    <link href="assets/css/select2.min.css" rel="stylesheet" />

    <!-- override navbar colors sesuai logo -->
    <style>
      :root {
        --logo-dark: #003366;   /* biru gelap logo Kemnaker */
        --logo-light: #CCE6F2;  /* biru cerah navbar */
      }
      .navbar-default {
        background-color: var(--logo-light);
        border-color: var(--logo-dark);
      }
      /* Brand & link warna */
      .navbar-default .navbar-brand,
      .navbar-default .navbar-nav > li > a {
        color: var(--logo-dark);
      }
      /* Hover & active */
      .navbar-default .navbar-brand:hover,
      .navbar-default .navbar-nav > li > a:hover,
      .navbar-default .navbar-nav > .active > a {
        color: #000;
        background-color: transparent;
      }
      /* Toggler icon */
      .navbar-default .navbar-toggle .icon-bar {
        background-color: var(--logo-dark);
      }
      /* Mobile dropdown bg */
      .navbar-default .navbar-nav .open .dropdown-menu {
        background-color: var(--logo-light);
      }
      .navbar-default .navbar-nav .open .dropdown-menu > li > a {
        color: var(--logo-dark);
      }
      .navbar-default .navbar-nav .open .dropdown-menu > li > a:hover {
        background-color: rgba(0, 51, 102, 0.1);
      }
    </style>

    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/select2.min.js"></script>
    <script type="text/javascript">
        $(function() {
            $("select:not(.default)").select2();
        })
    </script>
</head>

<body>
    <nav class="navbar navbar-default navbar-static-top">
        <div class="container">
<div class="navbar-header">
    <button 
      type="button" 
      class="navbar-toggle collapsed" 
      data-toggle="collapse" 
      data-target="#navbar" 
      aria-expanded="false" 
      aria-controls="navbar">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
    </button>
    <a class="navbar-brand" href="?" style="padding:5px 10px 5px 0;">
        <img src="assets/images/KEMNAKERRI.PNG" alt="Logo Kemnaker" style="height:47px; display:inline-block; vertical-align:middle; margin-top:-5px;">
    </a>
</div>

            <div id="navbar" class="navbar-collapse collapse">
                <ul class="nav navbar-nav">
                    <?php if (_session('level') == 'admin') : ?>
                        <li><a href="?m=pelatihan"><span class="glyphicon glyphicon-pushpin"></span> Jenis Pelatihan</a></li>
                        <li><a href="?m=dataminat"><span class="glyphicon glyphicon-flash"></span> Data dan Minat</a></li>
                        <li><a href="?m=relasi"><span class="glyphicon glyphicon-star"></span> Relasi</a></li>
                        <li><a href="?m=rule"><span class="glyphicon glyphicon-star"></span> Rule</a></li>
                        <li><a href="aksi.php?act=logout"><span class="glyphicon glyphicon-log-out"></span> Logout (<?= _session('login') ?>)</a></li>
                    <?php elseif (_session('level') == 'user') : ?>
                        <li><a href="?m=pelatihan_user"><span class="glyphicon glyphicon-pushpin"></span> Jenis Pelatihan</a></li>
                        <li><a href="?m=dataminat_user"><span class="glyphicon glyphicon-flash"></span> Data dan Minat</a></li>
                        <li><a href="aksi.php?m=konsultasi&act=new"><span class="glyphicon glyphicon-stats"></span> Konsultasi</a></li>
                        <li><a href="aksi.php?act=logout"><span class="glyphicon glyphicon-log-out"></span> Logout (<?= _session('login') ?>)</a></li>
                    <?php else : ?>
                        <li><a href="?m=login"><span class="glyphicon glyphicon-log-in"></span> Masuk</a></li>
                        <li><a href="?m=signup"><span class="glyphicon glyphicon-log-in"></span> Daftar</a></li>
                        <li><a href="?m=bantuan"><span class="glyphicon glyphicon-lock"></span> Tentang</a></li>
                    <?php endif ?>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        <?php
        if (!_session('login') && in_array($mod, ['pelatihan','dataminat','relasi','rule','password']))
            $mod = 'home';

        if (file_exists($mod . '.php'))
            include $mod . '.php';
        else
            include 'home.php';
        ?>
    </div>

    <footer class="footer" style="background:#f9f9f9; padding:12px 0; margin-top:40px;">
        <div class="container text-center">
            <p>Copyright &copy; <?= date('Y') ?> Reza Aldiansyah <em class="pull-right">UNINDRA</em></p>
        </div>
    </footer>
</body>

</html>
