    <style>
        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }

        @keyframes fadeOut {
            from {
                opacity: 1;
            }
            to {
                opacity: 0;
            }
        }

        .fade-in {
            animation: fadeIn 0.5s ease-in-out forwards;
        }

        .fade-out {
            animation: fadeOut 0.5s ease-in-out forwards;
        }

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

        .btn-primary {
            background-color: #007bff;
            color: white;
        }

        .btn-primary:hover {
            background-color: white;
            color: #007bff;
            border: 2px solid #007bff;
        }

        .btn-danger {
            background-color: #dc3545;
            color: white;
        }

        .btn-danger:hover {
            background-color: white;
            color: #dc3545;
            border: 2px solid #dc3545;
        }

        .btn-success {
            background-color: #28a745;
            color: white;
        }

        .btn-success:hover {
            background-color: white;
            color: #28a745;
            border: 2px solid #28a745;
        }

        .page-header h1 {
            font-size: 24px;
            color: #333;
            text-align: center;
            margin-bottom: 20px;
        }

        .panel-primary .panel-heading {
            background-color: #007bff;
            color: white;
        }

        .panel-primary .panel-title {
            font-size: 18px;
        }

        .list-group-item {
            font-size: 16px;
        }

        .panel-body h3 {
            font-size: 20px;
            margin-bottom: 20px;
        }

        .header-image {
            width: 50%;
            height: auto;
            margin-bottom: 20px;
        }

        .question-row {
            display: flex;
            align-items: center;
        }

        .question-text {
            flex: 1;
        }

        .question-image {
            margin-left: 20px;
        }
    </style>

    
<div class="page-header">
    <h1>Konsultasi</h1>
</div>

<?php

// Ambil jawaban user yang sudah ada
$terjawab = get_terjawab();

// Cari kode dataminat pertanyaan berikutnya berdasarkan jawaban dan rule
$kode_dataminat = get_next_dataminat_from_rules($terjawab);

$success = _get('success');
$row = null;
$count = $db->get_var("SELECT COUNT(*) FROM tb_konsultasi");

if ($kode_dataminat) {
    $row = $db->get_row("SELECT * FROM tb_dataminat WHERE kode_dataminat='$kode_dataminat'");
} else {
    // Jika tidak ada dataminat yang harus ditanya lagi, anggap konsultasi selesai
    $success = true;
}
?>

<?php if ($success) : ?>
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title">Riwayat Pertanyaan</h3>
        </div>
        <div class="list-group">
            <?php
            $rows = $db->get_results("SELECT * FROM tb_konsultasi k INNER JOIN tb_dataminat g ON g.kode_dataminat=k.kode_dataminat ORDER BY k.ID");
            foreach ($rows as $row) : ?>
                <div class="list-group-item"><?= $row->ID ?>. Apakah <?= strtolower($row->nama_dataminat) ?>? <strong><?= $row->jawaban ?></strong></div>
            <?php endforeach ?>
        </div>
    </div>
    <?php include 'konsultasi_hasil.php'; ?>
<?php else : ?>
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title">Jawablah pertanyaan berikut ini [<?= $row->kode_dataminat ?>]</h3>
        </div>
        <div class="panel-body">
            <div class="question-row">
                <div class="question-text">
                    <h3>Apakah <?= strtolower($row->nama_dataminat) ?>?</h3>
                    <form action="aksi.php?m=konsultasi" method="post">
                        <input type="hidden" name="kode_dataminat" value="<?= $row->kode_dataminat ?>" />
                        <p>&nbsp;</p>
                        <p>
                            <button name="yes" class="custom-btn btn-primary" value="Ya">Ya</button>
                            <button name="no" class="custom-btn btn-danger" value="Tidak">Tidak</button>

                            <?php if ($count) : ?>
                                <a class="custom-btn btn-success" href="?m=konsultasi&success=1">Lihat Hasil</a>
                                <a class="custom-btn btn-primary pull-right" href="aksi.php?m=konsultasi&act=new">Batal</a>
                            <?php endif ?>
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php endif ?>

<script src="assets/js/bootstrap.min.js"></script>

<?php
// Fungsi utama untuk mendapatkan dataminat berikutnya berdasarkan rule dan jawaban user
function get_next_dataminat_from_rules($answers)
{
    global $db;

    // Jika jawaban kosong, berarti awal konsultasi
    if (empty($answers)) {
        // Ambil dataminat dari rule pertama untuk mulai
        $first_rule = $db->get_row("SELECT kode_pelatihan FROM tb_relasi ORDER BY kode_pelatihan LIMIT 1");
        if (!$first_rule) return false;
        $dataminat_rows = $db->get_results("SELECT kode_dataminat FROM tb_relasi WHERE kode_pelatihan = '{$first_rule->kode_pelatihan}' ORDER BY kode_dataminat");
        return $dataminat_rows[0]->kode_dataminat ?? false;
    }

    // Ambil semua pelatihan unik
    $diagnoses = $db->get_results("SELECT DISTINCT kode_pelatihan FROM tb_relasi");

    $possible_diagnoses = [];

    // Filter pelatihan yang masih mungkin sesuai jawaban user
    foreach ($diagnoses as $diag) {
        $kode_pelatihan = $diag->kode_pelatihan;

        // dataminat untuk pelatihan ini
        $dataminat_rows = $db->get_results("SELECT kode_dataminat FROM tb_relasi WHERE kode_pelatihan = '$kode_pelatihan'");
        $rule_dataminat = array_map(fn($g) => $g->kode_dataminat, $dataminat_rows);

        $valid = true;
        foreach ($answers as $kode_dataminat => $jawaban) {
            if ($jawaban == 'Ya' && !in_array($kode_dataminat, $rule_dataminat)) {
                $valid = false;
                break;
            }
            if ($jawaban == 'Tidak' && in_array($kode_dataminat, $rule_dataminat)) {
                $valid = false;
                break;
            }
        }

        if ($valid) {
            $possible_diagnoses[$kode_pelatihan] = $rule_dataminat;
        }
    }

    if (empty($possible_diagnoses)) {
        return false;
    }

    // Cari dataminat yang belum ditanyakan dari pelatihan yang masih mungkin
    $candidate_dataminat = [];
    foreach ($possible_diagnoses as $kode_pelatihan => $dataminat_list) {
        foreach ($dataminat_list as $g) {
            if (!isset($answers[$g])) {
                $candidate_dataminat[$g] = true;
            }
        }
    }

    if (empty($candidate_dataminat)) {
        return false;
    }

    // Ambil dataminat dengan urutan alfabet untuk deterministik
    $candidate_keys = array_keys($candidate_dataminat);
    sort($candidate_keys);
    return $candidate_keys[0];
}
?>

    <script src="assets/js/bootstrap.min.js"></script>
