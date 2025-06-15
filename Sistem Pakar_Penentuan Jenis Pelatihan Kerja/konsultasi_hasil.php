<?php
$user_name = isset($_SESSION['login']) ? $_SESSION['login'] : 'Pengguna';

$dataminat_terpilih = $db->get_results("SELECT kode_dataminat FROM tb_konsultasi WHERE jawaban='Ya'");
$jumlah_dataminat_terpilih = count($dataminat_terpilih);

if ($jumlah_dataminat_terpilih == 0) :
    print_msg('Belum ada pilihan kriteria yang dipilih!', 'warning');
    echo '<p><a class="btn btn-primary" href="aksi.php?m=konsultasi&act=new">Mulai Konsultasi</a></p>';
else :
    // Ambil relasi pelatihan dan dataminat yang cocok
    $rows = $db->get_results("SELECT r.kode_pelatihan AS kode_pelatihan, COUNT(DISTINCT r.kode_dataminat) as match_count
        FROM tb_relasi r 
        INNER JOIN tb_konsultasi k ON r.kode_dataminat = k.kode_dataminat
        WHERE k.jawaban = 'Ya'
        GROUP BY r.kode_pelatihan");

    $pelatihan = [];
    foreach ($rows as $row) {
        $total_dataminat = $db->get_var("SELECT COUNT(DISTINCT kode_dataminat) FROM tb_relasi WHERE kode_pelatihan = '{$row->kode_pelatihan}'");
        $match_count = $row->match_count;
        $confidence_level = ($match_count / $total_dataminat) * 100;
        $pelatihan[$row->kode_pelatihan] = $confidence_level;
    }

    arsort($pelatihan);
    $top_pelatihan = key($pelatihan);
    $top_confidence = reset($pelatihan);

    $pelatihan_info = $db->get_row("SELECT * FROM tb_pelatihan WHERE kode_pelatihan='$top_pelatihan'");
?>
    <div class="panel panel-primary card card-body shadow mt-lg-3">
        <div class="panel-heading mt-lg-3">
            <h3 class="panel-title">Hasil Rekomendasi Pelatihan untuk: <?= htmlspecialchars($user_name) ?></h3>
        </div>
        <table class="table table-bordered table-hover table-striped">
            <thead>
                <tr>
                    <th>Jenis Pelatihan</th>
                    <th>Level Kecocokan</th>
                </tr>
            </thead>
            <tr>
                <td><?= htmlspecialchars($pelatihan_info->nama_pelatihan) ?></td>
                <td><?= round($top_confidence, 2) ?>%</td>
            </tr>
        </table>
        <div class="panel-body">
            <table class="table table-bordered">
                <tr>
                    <td>Jenis Pelatihan</td>
                    <td><?= htmlspecialchars($pelatihan_info->nama_pelatihan) ?></td>
                </tr>
                <tr>
                    <td>Deskripsi</td>
                    <td><?= htmlspecialchars($pelatihan_info->keterangan) ?></td>
                </tr>
            </table>

            <p>
                <a class="btn btn-primary" href="aksi.php?m=konsultasi&act=new">Konsultasi Ulang</a>
                <a class="btn btn-success" href="cetak.php?m=konsultasi" target="_blank">Cetak Rekomendasi</a>
            </p>
        </div>
    </div>
<?php endif; ?>
