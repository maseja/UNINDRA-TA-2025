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

    .btn-print {
        background-color: #007BFF; /* Blue */
        color: white;
    }

    .btn-print:hover {
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
    <h1>Data dan Minat</h1>
</div>
<div class="panel panel-default">
    <div class="panel-heading">
        <form class="form-inline">
            <div class="form-group">
                <a class="custom-btn btn-add" href="?m=dataminat_tambah"><span class="glyphicon glyphicon-plus"></span> Tambah</a>
            </div>
            <div class="form-group">
                <a class="custom-btn btn-print" href="cetak.php?m=dataminat" target="_blank"><span class="glyphicon glyphicon-print"></span> Cetak</a>
            </div>
        </form>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered table-hover table-striped">
            <thead>
                <tr>
                    <th>Kode</th>
                    <th>Nama Data/Minat</th>
                    <th>Keterangan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $q = esc_field(_get('q'));
                $rows = $db->get_results("SELECT * FROM tb_dataminat 
                WHERE kode_dataminat LIKE '%$q%' OR nama_dataminat LIKE '%$q%' OR keterangan LIKE '%$q%' 
                ORDER BY kode_dataminat");
                $no = 0;
                foreach ($rows as $row) : ?>
                    <tr>
                        <td><?= $row->kode_dataminat ?></td>
                        <td><?= $row->nama_dataminat ?></td>
                        <td><?= $row->keterangan ?></td>
                        <td class="nw">
                            <a class="custom-btn btn-edit btn-xs" href="?m=dataminat_ubah&ID=<?= $row->kode_dataminat ?>"><span class="glyphicon glyphicon-edit"></span> Ubah</a>
                            <a class="custom-btn btn-delete btn-xs" href="aksi.php?act=dataminat_hapus&ID=<?= $row->kode_dataminat ?>" onclick="return confirm('Hapus data?')"><span class="glyphicon glyphicon-trash"></span> Hapus</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
