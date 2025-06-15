<div class="page-header">
    <h1>Jenis Pelatihan</h1>
</div>
<div class="panel panel-default">
    <div class="panel-heading">
    </div>
    <div class="table-responsive">
        <table class="table table-bordered table-hover table-striped">
            <thead>
                <tr class="nw">
                    <th>No</th>
                    <th>Kode</th>
                    <th>Nama Pelatihan</th>
                    <th>Keterangan</th>
                </tr>
            </thead>
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
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
</div>