<?php 
function get_terjawab()
{
    global $db;
    $rows = $db->get_results("SELECT kode_dataminat, jawaban FROM tb_konsultasi");
    $arr = [];
    foreach ($rows as $row) {
        $arr[$row->kode_dataminat] = $row->jawaban;
    }
    return $arr;
}

function _post($key, $val = null)
{
    global $_POST;
    return isset($_POST[$key]) ? $_POST[$key] : $val;
}

function _get($key, $val = null)
{
    global $_GET;
    return isset($_GET[$key]) ? $_GET[$key] : $val;
}
?>