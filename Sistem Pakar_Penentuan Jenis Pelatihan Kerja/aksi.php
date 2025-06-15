<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require_once 'functions.php';

$mod = _get('m');
$act = _get('act');

/** LOGIN */
if ($mod == 'login') {
    $user = esc_field($_POST['user']);
    $pass = esc_field($_POST['pass']);

    $row = $db->get_row("SELECT * FROM tb_admin WHERE user='$user' AND pass='$pass'");
    if ($row) {
        $_SESSION['login'] = $row->user;
        $_SESSION['level'] = strtolower($row->level);
        redirect_js("index.php");
        exit;
    } else {
        print_msg("Salah kombinasi username dan password.");
    }
}

/** SIGNUP */
else if ($mod == 'signup') {
    $kode = esc_field($_POST['kode']);
    $nama = esc_field($_POST['nama']);
    $user = esc_field($_POST['user']);
    $pass = esc_field($_POST['pass']);

    if ($user == '' || $pass == '' || $kode == '' || $nama == '')
        print_msg("Field bertanda * tidak boleh kosong!");
    elseif ($db->get_row("SELECT * FROM tb_admin WHERE user='$user'"))
        print_msg("Nama pengguna sudah ada!");
    else {
        $level = 'user'; // default level
        $db->query("INSERT INTO tb_admin (kode_user, nama_user, user, pass, level) VALUES ('$kode', '$nama', '$user', '$pass', '$level')");
        redirect_js("index.php?m=login");
        exit;
    }
}

/** CHANGE PASSWORD */
else if ($mod == 'password') {
    $pass1 = $_POST['pass1'];
    $pass2 = $_POST['pass2'];
    $pass3 = $_POST['pass3'];

    $row = $db->get_row("SELECT * FROM tb_admin WHERE user='$_SESSION[login]' AND pass='$pass1'");

    if ($pass1 == '' || $pass2 == '' || $pass3 == '')
        print_msg('Field bertanda * harus diisi.');
    elseif (!$row)
        print_msg('Password lama salah.');
    elseif ($pass2 != $pass3)
        print_msg('Password baru dan konfirmasi password baru tidak sama.');
    else {
        $db->query("UPDATE tb_admin SET pass='$pass2' WHERE user='$_SESSION[login]'");
        print_msg('Password berhasil diubah.', 'success');
    }
}

/** LOGOUT */
elseif ($act == 'logout') {
    unset($_SESSION['login'], $_SESSION['level']);
    header("location:index.php?m=login");
    exit;
}

/** USER DELETE */
else if ($act == 'user_hapus') {
    $db->query("DELETE FROM tb_admin WHERE kode_user='$_GET[ID]'");
    header("location:index.php?m=user");
    exit;
}

/** pelatihan TAMBAH */
elseif ($mod == 'pelatihan_tambah') {
    $kode = $_POST['kode'];
    $nama = $_POST['nama'];
    $keterangan = $_POST['keterangan'];
    if ($kode == '' || $nama == '')
        print_msg("Field yang bertanda * tidak boleh kosong!");
    elseif ($db->get_row("SELECT * FROM tb_pelatihan WHERE kode_pelatihan='$kode'"))
        print_msg("Kode sudah ada!");
    else {
        $db->query("INSERT INTO tb_pelatihan (kode_pelatihan, nama_pelatihan, keterangan) VALUES ('$kode', '$nama', '$keterangan')");
        redirect_js("index.php?m=pelatihan");
        exit;
    }
}

/** pelatihan UBAH */
else if ($mod == 'pelatihan_ubah') {
    $kode = $_POST['kode'];
    $nama = $_POST['nama'];
    $keterangan = $_POST['keterangan'];
    if ($kode == '' || $nama == '')
        print_msg("Field yang bertanda * tidak boleh kosong!");
    else {
        $db->query("UPDATE tb_pelatihan SET nama_pelatihan='$nama', keterangan='$keterangan' WHERE kode_pelatihan='$_GET[ID]'");
        redirect_js("index.php?m=pelatihan");
        exit;
    }
}

/** pelatihan HAPUS */
else if ($act == 'pelatihan_hapus') {
    $db->query("DELETE FROM tb_pelatihan WHERE kode_pelatihan='$_GET[ID]'");
    $db->query("DELETE FROM tb_relasi WHERE kode_pelatihan='$_GET[ID]'");
    header("location:index.php?m=pelatihan");
    exit;
}

/** dataminat TAMBAH */
elseif ($mod == 'dataminat_tambah') {
    $kode = $_POST['kode'];
    $nama = $_POST['nama'];
    $keterangan = $_POST['keterangan'];

    if ($kode == '' || $nama == '')
        print_msg("Field bertanda * tidak boleh kosong!");
    elseif ($db->get_row("SELECT * FROM tb_dataminat WHERE kode_dataminat='$kode'"))
        print_msg("Kode sudah ada!");
    else {
        $db->query("INSERT INTO tb_dataminat (kode_dataminat, nama_dataminat, keterangan) VALUES ('$kode', '$nama', '$keterangan')");
        redirect_js("index.php?m=dataminat");
        exit;
    }
}

/** dataminat UBAH */
else if ($mod == 'dataminat_ubah') {
    $kode = $_POST['kode'];
    $nama = $_POST['nama'];
    $keterangan = $_POST['keterangan'];

    if ($kode == '' || $nama == '')
        print_msg("Field bertanda * tidak boleh kosong!");
    else {
        $db->query("UPDATE tb_dataminat SET nama_dataminat='$nama', keterangan='$keterangan' WHERE kode_dataminat='$_GET[ID]'");
        redirect_js("index.php?m=dataminat");
        exit;
    }
}

/** dataminat HAPUS */
else if ($act == 'dataminat_hapus') {
    $db->query("DELETE FROM tb_dataminat WHERE kode_dataminat='$_GET[ID]'");
    $db->query("DELETE FROM tb_relasi WHERE kode_dataminat='$_GET[ID]'");
    header("location:index.php?m=dataminat");
    exit;
}

/** RELASI TAMBAH */
else if ($mod == 'relasi_tambah') {
    $kode_pelatihan = $_POST['kode_pelatihan'];
    $kode_dataminat = $_POST['kode_dataminat'];

    $kombinasi_ada = $db->get_row("SELECT * FROM tb_relasi WHERE kode_pelatihan='$kode_pelatihan' AND kode_dataminat='$kode_dataminat'");

    if ($kode_pelatihan == '' || $kode_dataminat == '')
        print_msg("Field bertanda * tidak boleh kosong!");
    elseif ($kombinasi_ada)
        print_msg("Kombinasi sudah ada!");
    else {
        $db->query("INSERT INTO tb_relasi (kode_pelatihan, kode_dataminat) VALUES ('$kode_pelatihan', '$kode_dataminat')");
        redirect_js("index.php?m=relasi");
        exit;
    }
}

/** RELASI UBAH */
else if ($mod == 'relasi_ubah') {
    $kode_pelatihan = $_POST['kode_pelatihan'];
    $kode_dataminat = $_POST['kode_dataminat'];

    $kombinasi_ada = $db->get_row("SELECT * FROM tb_relasi WHERE kode_pelatihan='$kode_pelatihan' AND kode_dataminat='$kode_dataminat' AND ID<>'$_GET[ID]'");

    if ($kode_pelatihan == '' || $kode_dataminat == '')
        print_msg("Field bertanda * tidak boleh kosong!");
    elseif ($kombinasi_ada)
        print_msg("Kombinasi pelatihan dan dataminat sudah ada!");
    else {
        $db->query("UPDATE tb_relasi SET kode_pelatihan='$kode_pelatihan', kode_dataminat='$kode_dataminat' WHERE ID='$_GET[ID]'");
        redirect_js("index.php?m=relasi");
        exit;
    }
}

/** RELASI HAPUS */
else if ($act == 'relasi_hapus') {
    $db->query("DELETE FROM tb_relasi WHERE ID='$_GET[ID]'");
    header("location:index.php?m=relasi");
    exit;
}

/** KONSULTASI */
else if ($mod == 'konsultasi') {
    if ($act == 'new') {
        // Reset konsultasi
        $db->query("TRUNCATE TABLE tb_konsultasi");
        header("location:index.php?m=konsultasi");
        exit;
    } else {
        $kode_dataminat = $_POST['kode_dataminat'] ?? '';
        $jawaban = null;
        if (isset($_POST['yes'])) $jawaban = 'Ya';
        elseif (isset($_POST['no'])) $jawaban = 'Tidak';

        if ($kode_dataminat && $jawaban) {
            $exists = $db->get_var("SELECT COUNT(*) FROM tb_konsultasi WHERE kode_dataminat = '$kode_dataminat'");
            if ($exists) {
                $db->query("UPDATE tb_konsultasi SET jawaban = '$jawaban' WHERE kode_dataminat = '$kode_dataminat'");
            } else {
                $db->query("INSERT INTO tb_konsultasi (kode_dataminat, jawaban) VALUES ('$kode_dataminat', '$jawaban')");
            }
        }
        header("location:index.php?m=konsultasi");
        exit;
    }
}
