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
        background-color: #4CAF50; /* Green */
        color: white;
    }

    .btn-refresh:hover {
        background-color: white;
        color: #4CAF50;
        border: 2px solid #4CAF50;
    }

    .btn-add {
        background-color: #008CBA; /* Blue */
        color: white;
    }

    .btn-add:hover {
        background-color: white;
        color: #008CBA;
        border: 2px solid #008CBA;
    }

    .btn-print {
        background-color: #f44336; /* Red */
        color: white;
    }

    .btn-print:hover {
        background-color: white;
        color: #f44336;
        border: 2px solid #f44336;
    }

    .btn-action {
        background-color: #555555; /* Gray */
        color: white;
    }

    .btn-action:hover {
        background-color: white;
        color: #555555;
        border: 2px solid #555555;
    }

    .btn-edit {
        background-color: #28a745; /* Green */
        color: white;
    }

    .btn-edit:hover {
        background-color: white;
        color: #28a745;
        border: 2px solid #28a745;
    }

    .btn-delete {
        background-color: #dc3545; /* Red */
        color: white;
    }

    .btn-delete:hover {
        background-color: white;
        color: #dc3545;
        border: 2px solid #dc3545;
    }

    .table thead {
        background-color: #007BFF; /* Blue */
        color: white;
    }

    .table tbody {
        background-color: #F8F0FF; /* Light Lavender */
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
    <h1>Jenis Pelatihan</h1>
</div>
<div class="panel panel-default">
    <div class="panel-heading">
        <form class="form-inline">
            <div class="form-group">
                <a class="custom-btn btn-add" href="?m=pelatihan_tambah"><span class="glyphicon glyphicon-plus"></span> Tambah</a>
            </div>
            <div class="form-group">
                <a class="custom-btn btn-print" href="cetak.php?m=pelatihan" target="_blank"><span class="glyphicon glyphicon-print"></span> Cetak</a>
            </div>
        </form>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered table-hover table-striped">
            <thead>
                <tr class="nw">
                    <th>No</th>
                    <th>Kode</th>
                    <th>Nama Jenis Pelatihan</th>
                    <th>Keterangan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $q = esc_field(_get('q'));
                $rows = $db->get_results("SELECT * FROM tb_pelatihan 
                    WHERE kode_pelatihan LIKE '%$q%' OR nama_pelatihan LIKE '%$q%' OR keterangan LIKE '%$q%' 
                    ORDER BY kode_pelatihan");
                $no = 0;
                foreach ($rows as $row) : ?>
                    <tr>
                        <td><?= ++$no ?></td>
                        <td><?= $row->kode_pelatihan ?></td>
                        <td><?= $row->nama_pelatihan ?></td>
                        <td><?= $row->keterangan ?></td>
                        <td class="nw">
                            <a class="custom-btn btn-edit btn-xs" href="?m=pelatihan_ubah&ID=<?= $row->kode_pelatihan ?>"><span class="glyphicon glyphicon-edit"></span> Ubah</a>
                            <a class="custom-btn btn-delete btn-xs" href="aksi.php?act=pelatihan_hapus&ID=<?= $row->kode_pelatihan ?>" onclick="return confirm('Hapus data?')"><span class="glyphicon glyphicon-trash"></span> Hapus</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
