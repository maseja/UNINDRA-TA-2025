<div class="page-header">
    <h1>Data dan Minat</h1>
</div>
<div class="panel panel-default">
    <div class="panel-heading">
    </div>
    <div class="table-responsive">
        <table class="table table-bordered table-hover table-striped">
            <thead>
                <tr>
                    <th>Kode</th>
                    <th>Data dan Minat</th>
                    <th>Keterangan</th>
                </tr>
            </thead>
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
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
</div>