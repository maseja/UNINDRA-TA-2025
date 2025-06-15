<?php
$row = $db->get_row("SELECT * FROM tb_relasi WHERE ID='$_GET[ID]'");
?>
<div class="page-header">
    <h1>Ubah Relasi</h1>
</div>
<div class="row">
    <div class="col-sm-6">
        <?php if ($_POST) include 'aksi.php' ?>
        <form method="post">
            <div class="form-group">
                <label>pelatihan <span class="text-danger">*</span></label>
                <select class="form-control" name="kode_pelatihan">
                    <option value="">&nbsp;</option>
                    <?= CF_get_pelatihan_option(set_value('kode_pelatihan', $row->kode_pelatihan)) ?>
                </select>
            </div>
            <div class="form-group">
                <label>dataminat <span class="text-danger">*</span></label>
                <select class="form-control" name="kode_dataminat">
                    <option value="">&nbsp;</option>
                    <?= CF_get_dataminat_option(set_value('kode_dataminat', $row->kode_dataminat)) ?>
                </select>
            </div>
            <div class="form-group">
                <button class="btn btn-primary"><span class="glyphicon glyphicon-save"></span> Simpan</button>
                <a class="btn btn-danger" href="?m=relasi"><span class="glyphicon glyphicon-arrow-left"></span> Kembali</a>
            </div>
        </form>
    </div>
</div>
