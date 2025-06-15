<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$config["server"] = 'localhost';
$config["username"] = 'root';
$config["password"] = '';
$config["database_name"] = 'sp_fc_pelatihankerja';

include 'includes/db.php';
$db = new DB($config['server'], $config['username'], $config['password'], $config['database_name']);

function _post($key, $val = null)
{
    global $_POST;
    if (isset($_POST[$key]))
        return $_POST[$key];
    else
        return $val;
}

function _get($key, $val = null)
{
    global $_GET;
    if (isset($_GET[$key]))
        return $_GET[$key];
    else
        return $val;
}

function _session($key, $val = null)
{
    global $_SESSION;
    if (isset($_SESSION[$key]))
        return $_SESSION[$key];
    else
        return $val;
}

$mod = _get('m');
$act = _get('act');
$rows = $db->get_results("SELECT kode_dataminat, nama_dataminat FROM tb_dataminat ORDER BY kode_dataminat");
$dataminat = array();
foreach ($rows as $row) {
    $dataminat[$row->kode_dataminat] = $row->nama_dataminat;
}

$rows = $db->get_results("SELECT * FROM tb_pelatihan ORDER BY kode_pelatihan");
$pelatihan = array();
foreach ($rows as $row) {
    $pelatihan[$row->kode_pelatihan] = $row;
}

function get_terjawab()
{
    global $db;
    $rows = $db->get_results("SELECT kode_dataminat, jawaban FROM tb_konsultasi");
    $arr = array();
    foreach ($rows as $row) {
        $arr[$row->kode_dataminat] = $row->jawaban;
    }
    return $arr;
}

function get_next_dataminat($relasi)
{
    eliminate_relasi($relasi);
    foreach ($relasi as $key => $val) {
        foreach ($val as $k => $v) {
            if ($v == '')
                return $k;
        }
    }
    return false;
}

function get_relasi($terjawab)
{
    global $db;
    $rows = $db->get_results("SELECT kode_pelatihan, r.kode_dataminat 
        FROM tb_relasi r
        ORDER BY kode_pelatihan, r.kode_dataminat");
    $arr = array();
    foreach ($rows as $row) {
        $arr[$row->kode_pelatihan][$row->kode_dataminat] = isset($terjawab[$row->kode_dataminat]) ? $terjawab[$row->kode_dataminat] : null;
    }
    return $arr;
}

function CF_get_pelatihan_option($selected = '')
{
    global $db;
    $rows = $db->get_results("SELECT kode_pelatihan, nama_pelatihan FROM tb_pelatihan ORDER BY kode_pelatihan");
    $a = '';
    foreach ($rows as $row) {
        if ($row->kode_pelatihan == $selected)
            $a .= "<option value='$row->kode_pelatihan' selected>[$row->kode_pelatihan] $row->nama_pelatihan</option>";
        else
            $a .= "<option value='$row->kode_pelatihan'>[$row->kode_pelatihan] $row->nama_pelatihan</option>";
    }
    return $a;
}

function get_level_option($selected = '')
{
    $arr = array(
        'admin' => 'Admin',
        'user' => 'User',
    );
    $a = '';
    foreach ($arr as $key => $val) {
        if ($selected == $key)
            $a .= "<option value='$key' selected>$val</option>";
        else
            $a .= "<option value='$key'>$val</option>";
    }
    return $a;
}

function CF_get_dataminat_option($selected = '')
{
    global $db;
    $rows = $db->get_results("SELECT kode_dataminat, nama_dataminat FROM tb_dataminat ORDER BY kode_dataminat");
    $a = '';
    foreach ($rows as $row) {
        if ($row->kode_dataminat == $selected)
            $a .= "<option value='$row->kode_dataminat' selected>[$row->kode_dataminat] $row->nama_dataminat</option>";
        else
            $a .= "<option value='$row->kode_dataminat'>[$row->kode_dataminat] $row->nama_dataminat</option>";
    }
    return $a;
}

function set_value($key = null, $default = null)
{
    global $_POST;
    if (isset($_POST[$key]))
        return $_POST[$key];

    if (isset($_GET[$key]))
        return $_GET[$key];

    return $default;
}

function kode_oto($field, $table, $prefix, $length){
    global $db;
    // Pastikan hanya mengambil kode yang prefix-nya JP
    $row = $db->get_row("SELECT MAX($field) as kode FROM $table WHERE $field LIKE '{$prefix}%'");
    $kode = ($row && isset($row->kode) && $row->kode) ? $row->kode : null;
    $last = $kode ? substr($kode, strlen($prefix)) : 0;
    $next = str_pad((int)$last + 1, $length, '0', STR_PAD_LEFT);
    return $prefix . $next;
}


function esc_field($str)
{
    if ($str)
        return addslashes($str);
}

function redirect_js($url)
{
    echo '<script type="text/javascript">window.location.replace("' . $url . '");</script>';
}

function alert($url)
{
    echo '<script type="text/javascript">alert("' . $url . '");</script>';
}

function print_msg($msg, $type = 'danger')
{
    echo ('<div class="alert alert-' . $type . ' alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' . $msg . '</div>');
}

function eliminate_relasi(&$relasi)
{
    foreach ($relasi as $key => $val) {
        $tidak = 0;
        foreach ($val as $k => $v) {
            if ($v == 'Tidak')
                $tidak++;
        }
        if ($tidak >= 2 || $tidak >= count($val) / 2)
            unset($relasi[$key]);
    }
}
