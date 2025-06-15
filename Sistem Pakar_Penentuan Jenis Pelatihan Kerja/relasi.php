<style>
    .custom-btn {
        border: none;
        color: white;
        padding: 10px 20px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 14px;
        margin: 4px 2px;
        transition-duration: 0.4s;
        cursor: pointer;
        border-radius: 12px;
    }

    .btn-refresh {
        background-color: #007BFF; /* Blue */
        color: white;
    }

    .btn-refresh:hover {
        background-color: #0056b3; /* Darker Blue */
        color: white;
        border: 2px solid #0056b3;
    }

    .btn-add {
        background-color: #007BFF; /* Blue */
        color: white;
    }

    .btn-add:hover {
        background-color: #0056b3; /* Darker Blue */
        color: white;
        border: 2px solid #0056b3;
    }

    .btn-action {
        background-color: #6c757d; /* Gray */
        color: white;
    }

    .btn-action:hover {
        background-color: #5a6268; /* Darker Gray */
        color: white;
        border: 2px solid #5a6268;
    }

    .btn-edit {
        background-color: #28a745; /* Green */
        color: white;
    }

    .btn-edit:hover {
        background-color: #218838; /* Darker Green */
        color: white;
        border: 2px solid #218838;
    }

    .btn-delete {
        background-color: #dc3545; /* Red */
        color: white;
    }

    .btn-delete:hover {
        background-color: #c82333; /* Darker Red */
        color: white;
        border: 2px solid #c82333;
    }

    .table thead {
        background-color: #007BFF; /* Blue */
        color: white;
    }

    .table tbody {
        background-color: #f8f9fa; /* Light Gray */
    }

    .page-header h1 {
        font-size: 24px;
        color: #333;
        text-align: center;
        margin-bottom: 20px;
    }

    .panel {
        border: 1px solid #ddd;
        border-radius: 8px;
    }

    .panel-heading {
        background-color: #f8f9fa; /* Light Gray */
        border-bottom: 1px solid #ddd;
        padding: 15px;
        border-radius: 8px 8px 0 0;
    }

    .form-control {
        border-radius: 4px;
        border: 1px solid #ddd;
        box-shadow: none;
    }

    .form-inline .form-group {
        margin-right: 10px;
    }
</style>

<div class="page-header">
    <h1>Relasi Jenis Pelatihan & Data/Minat</h1>
</div>
<div class="panel panel-default">
    <div class="panel-heading">
        <form class="form-inline">
            <input type="hidden" name="m" value="relasi" />
            <div class="form-group">
                <input class="form-control" type="text" placeholder="Pencarian relasi..." name="q" value="<?= _get('q') ?>" />
            </div>
            <div class="form-group">
                <button class="custom-btn btn-refresh"><span class="glyphicon glyphicon-refresh"></span> Refresh</button>
            </div>
            <div class="form-group">
                <a class="custom-btn btn-add" href="?m=relasi_tambah"><span class="glyphicon glyphicon-plus"></span> Tambah</a>
            </div>
        </form>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered table-hover table-striped">
            <thead>
                <tr class="nw">
                    <th>No</th>
                    <th>Jenis Pelatihan</th>
                    <th>Data / Minat</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $q = esc_field(_get('q'));
                $rows = $db->get_results("SELECT r.ID, r.kode_dataminat, d.kode_pelatihan, g.nama_dataminat, d.nama_pelatihan 
                    FROM tb_relasi r 
                    INNER JOIN tb_pelatihan d ON d.kode_pelatihan = r.kode_pelatihan 
                    INNER JOIN tb_dataminat g ON g.kode_dataminat = r.kode_dataminat
                    WHERE r.kode_dataminat LIKE '%$q%'
                        OR r.kode_pelatihan LIKE '%$q%'
                        OR g.nama_dataminat LIKE '%$q%'
                        OR d.nama_pelatihan LIKE '%$q%' 
                    ORDER BY r.kode_pelatihan, r.kode_dataminat");
                $no = 0;
                foreach ($rows as $row) : ?>
                    <tr>
                        <td><?= ++$no ?></td>
                        <td>[<?= $row->kode_pelatihan . '] ' . $row->nama_pelatihan ?></td>
                        <td>[<?= $row->kode_dataminat . '] ' . $row->nama_dataminat ?></td>
                        <td class="nw">
                            <a class="custom-btn btn-edit btn-xs" href="?m=relasi_ubah&ID=<?= $row->ID ?>"><span class="glyphicon glyphicon-edit"></span> Ubah</a>
                            <a class="custom-btn btn-delete btn-xs" href="aksi.php?act=relasi_hapus&ID=<?= $row->ID ?>" onclick="return confirm('Hapus data?')"><span class="glyphicon glyphicon-trash"></span> Hapus</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
