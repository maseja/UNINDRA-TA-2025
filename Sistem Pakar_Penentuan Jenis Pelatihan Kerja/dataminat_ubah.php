<?php
$row = $db->get_row("SELECT * FROM tb_dataminat WHERE kode_dataminat='$_GET[ID]'");

// Menentukan label nama berdasarkan prefix kode
$prefix = '';
if ($row) $prefix = strtoupper(substr($row->kode_dataminat, 0, 2));
switch ($prefix) {
    case 'U':
        $label_nama = 'Usia';
        break;
    case 'JK':
        $label_nama = 'Jenis Kelamin';
        break;
    case 'P':
        $label_nama = 'Pendidikan';
        break;
    case 'M':
        $label_nama = 'Jenis Minat';
        break;
    default:
        $label_nama = 'Nama Data/Minat';
}
?>
<div class="page-header">
    <h1>Ubah Data dan Minat</h1>
</div>
<div class="row">
    <div class="col-sm-6">
        <?php if ($_POST) include 'aksi.php' ?>
        <form method="post">
            <div class="form-group">
                <label>Kode <span class="text-danger">*</span></label>
                <input class="form-control" type="text" name="kode" readonly="readonly" value="<?= $row->kode_dataminat ?>" />
            </div>
            <div class="form-group">
                <label><?= $label_nama ?> <span class="text-danger">*</span></label>
                <input class="form-control" type="text" name="nama" value="<?= set_value('nama', $row->nama_dataminat) ?>" required />
            </div>
            <div class="form-group">
                <label>Keterangan</label>
                <input class="form-control" type="text" name="keterangan" value="<?= set_value('keterangan', $row->keterangan) ?>" />
            </div>
            <div class="form-group">
                <button class="btn btn-primary"><span class="glyphicon glyphicon-save"></span> Simpan</button>
                <a class="btn btn-danger" href="?m=dataminat"><span class="glyphicon glyphicon-arrow-left"></span> Kembali</a>
            </div>
        </form>
    </div>
</div>
