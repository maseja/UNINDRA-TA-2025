<?php
$row = $db->get_row("SELECT * FROM tb_pelatihan WHERE kode_pelatihan='$_GET[ID]'");
?>
<div class="page-header">
    <h1>Ubah Jenis Pelatihan</h1>
</div>
<div class="row">
    <div class="col-sm-6">
        <?php if ($_POST) include 'aksi.php' ?>
        <form method="post">
            <div class="form-group">
                <label>Kode <span class="text-danger">*</span></label>
                <input class="form-control" type="text" name="kode" readonly="readonly" value="<?= $row->kode_pelatihan ?>" />
            </div>
            <div class="form-group">
                <label>Nama Jenis Pelatihan <span class="text-danger">*</span></label>
                <input class="form-control" type="text" name="nama" value="<?= set_value('nama', $row->nama_pelatihan) ?>" required />
            </div>
            <div class="form-group">
                <label>Keterangan <span class="text-danger">*</span></label>
                <textarea class="form-control" name="keterangan" required><?= set_value('keterangan', $row->keterangan) ?></textarea>
            </div>
            <div class="form-group">
                <button class="btn btn-primary"><span class="glyphicon glyphicon-save"></span> Simpan</button>
                <a class="btn btn-danger" href="?m=pelatihan"><span class="glyphicon glyphicon-arrow-left"></span> Kembali</a>
            </div>
        </form>
    </div>
</div>
