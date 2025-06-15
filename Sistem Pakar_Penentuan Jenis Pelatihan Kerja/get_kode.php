<?php
require_once 'functions.php'; // include $db object

function generate_kode_data_minat($field, $table, $prefix, $length) {
    global $db;
    $row = $db->get_row("SELECT MAX($field) as kode FROM $table WHERE $field LIKE '{$prefix}%'");
    $kode = ($row && isset($row->kode) && $row->kode) ? $row->kode : null;
    $last = $kode ? substr($kode, strlen($prefix)) : 0;
    $next = str_pad((int)$last + 1, $length, '0', STR_PAD_LEFT);
    return $prefix . $next;
}

$kategori = $_GET['kategori'];
switch($kategori){
    case 'usia': $prefix = 'U'; break;
    case 'jk': $prefix = 'JK'; break;
    case 'pendidikan': $prefix = 'P'; break;
    case 'minat': $prefix = 'M'; break;
    default: $prefix = '';
}
$kode = $prefix ? generate_kode_data_minat('kode_dataminat', 'tb_dataminat', $prefix, 3) : '';
echo $kode;
