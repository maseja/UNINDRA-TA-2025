<?php
require_once 'functions.php';

// Ambil nama user dari session
$user_login = isset($_SESSION['login']) ? $_SESSION['login'] : null;
$nama_user = 'Pengguna';

// Ambil nama_user dari tb_admin jika login valid
if ($user_login) {
    $admin = $db->get_row("SELECT nama_user FROM tb_admin WHERE user = '{$user_login}'");
    if ($admin) {
        $nama_user = $admin->nama_user;
    }
}

// Ambil kriteria yang dipilih (jawaban 'Ya')
$kriteria_terpilih = $db->get_results("SELECT kode_dataminat FROM tb_konsultasi WHERE jawaban='Ya'");
$jumlah_terpilih = count($kriteria_terpilih);

if ($jumlah_terpilih > 0) {
    $rows = $db->get_results("SELECT r.kode_pelatihan, COUNT(DISTINCT r.kode_dataminat) as match_count
        FROM tb_relasi r
        INNER JOIN tb_konsultasi k ON r.kode_dataminat = k.kode_dataminat
        WHERE k.jawaban = 'Ya'
        GROUP BY r.kode_pelatihan");

    $pelatihan = [];
    foreach ($rows as $row) {
        $total_kriteria = $db->get_var("SELECT COUNT(DISTINCT kode_dataminat) FROM tb_relasi WHERE kode_pelatihan = '{$row->kode_pelatihan}'");
        $match_count = $row->match_count;
        $confidence = ($match_count / $total_kriteria) * 100;
        $pelatihan[$row->kode_pelatihan] = $confidence;
    }

    arsort($pelatihan);
    $top_pelatihan = key($pelatihan);
    $top_confidence = reset($pelatihan);

    $pelatihan_info = $db->get_row("SELECT * FROM tb_pelatihan WHERE kode_pelatihan='$top_pelatihan'");
} else {
    $pelatihan_info = null;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Hasil Rekomendasi Pelatihan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 40px 50px;
        }
        .header {
            display: flex;
            align-items: center;
            border-bottom: 3px solid black;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }
        .header img {
            width: 90px;
            height: auto;
            margin-right: 20px;
        }
        .header .kop-text {
            flex-grow: 1;
            text-align: center;
            line-height: 1.2;
        }
        .header .kop-text h1 {
            margin: 0;
            font-size: 24px;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 1.5px;
        }
        .header .kop-text p {
            margin: 4px 0;
            font-size: 13px;
        }
        p.intro {
            font-size: 16px;
            margin-bottom: 20px;
        }
        h3 {
            margin-top: 40px;
            margin-bottom: 10px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            border: 1px solid black;
            padding: 8px 10px;
            text-align: left;
            vertical-align: top;
        }
        th {
            background-color: #f0f0f0;
        }
        .footer {
            margin-top: 40px;
            text-align: right;
            font-size: 14px;
        }
        .footer .date {
            margin-bottom: 70px;
        }
        .footer .signature-line {
            border-top: 1px solid black;
            width: 150px;
            margin-left: auto;
        }
    </style>
</head>
<body>

<div class="header">
    <img src="assets/images/KEMNAKERRI.png" alt="Logo KEMNAKERRI">
    <div class="kop-text">
        <h1>Kementerian Ketenagakerjaan Republik Indonesia</h1>
        <p>Alamat: Jl. Gatot Subroto No.51, RT.5/RW.4, Kuningan Tim., Kecamatan Setiabudi,</p>
        <p>Kota Jakarta Selatan, Daerah Khusus Ibukota Jakarta 12950</p>
        <p>Telepon: (021) 1500630</p>
    </div>
</div>

<?php if ($jumlah_terpilih > 0): ?>

<p class="intro">
    Berikut kami sampaikan hasil analisis menggunakan metode <strong>Forward Chaining</strong> dari aplikasi Sistem Pakar Penentuan Jenis Pelatihan Kerja yang Sesuai dengan Profil Pencari Kerja.<br>
    Nama Peserta: <strong><?= htmlspecialchars($nama_user) ?></strong>
</p>


    <h3>Kriteria Terpilih</h3>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Kriteria</th>
            </tr>
        </thead>
        <tbody>
        <?php
        $no = 1;
        foreach ($kriteria_terpilih as $row):
            $kriteria = $db->get_row("SELECT nama_dataminat FROM tb_dataminat WHERE kode_dataminat='{$row->kode_dataminat}'");
        ?>
            <tr>
                <td><?= $no++ ?></td>
                <td><?= htmlspecialchars($kriteria->nama_dataminat) ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>

    <h3>Hasil Rekomendasi Pelatihan untuk: <?= htmlspecialchars($nama_user) ?></h3>
    <table>
        <thead>
            <tr>
                <th>Jenis Pelatihan</th>
                <th>Level Kecocokan</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><?= htmlspecialchars($pelatihan_info->nama_pelatihan) ?></td>
                <td><?= round($top_confidence, 2) ?>%</td>
            </tr>
        </tbody>
    </table>

    <table>
        <tr>
            <td>Jenis Pelatihan</td>
            <td><?= htmlspecialchars($pelatihan_info->nama_pelatihan) ?></td>
        </tr>
        <tr>
            <td>Deskripsi</td>
            <td><?= htmlspecialchars($pelatihan_info->keterangan) ?></td>
        </tr>
    </table>

<?php else: ?>

    <p>Tidak ada kriteria yang dipilih. Silakan lakukan konsultasi terlebih dahulu.</p>

<?php endif; ?>

<div class="footer">
    <?php
    $days = [
        'Sunday' => 'Minggu',
        'Monday' => 'Senin',
        'Tuesday' => 'Selasa',
        'Wednesday' => 'Rabu',
        'Thursday' => 'Kamis',
        'Friday' => 'Jumat',
        'Saturday' => 'Sabtu'
    ];
    $months = [
        1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April',
        5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus',
        9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember'
    ];

    $day = $days[date('l')];
    $date = date('d');
    $month = $months[date('n')];
    $year = date('Y');
    ?>
    <p class="date">Jakarta, <?= "$day, $date $month $year" ?></p>
    <p>Mengetahui,</p>
    <p class="signature-line"></p>
    <p><strong>Admin KEMNAKERRI</strong></p>
</div>

</body>
</html>
