<?php
include 'functions.php'; // pastikan ini path yang benar

// Ambil data relasi (rules), dan data dataminat & diagnosa dari global
$rules = get_relasi(array());
?>

<!DOCTYPE html>
<html>
<head>
    <title>Laporan Rule Pelatihan Kerja</title>
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
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
            page-break-inside: auto;
        }
        thead {
            display: table-header-group;
            page-break-inside: avoid;
        }
        tbody {
            display: table-row-group;
        }
        tr {
            page-break-inside: avoid;
            page-break-after: auto;
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
            margin-top: 60px;
            text-align: right;
            font-size: 14px;
            page-break-after: always;
        }
        .footer .date {
            margin-bottom: 70px;
        }
        .footer .signature-line {
            border-top: 1px solid black;
            width: 150px;
            margin-left: auto;
        }
        @media print {
            body {
                margin: 10mm 10mm 10mm 10mm !important;
            }
            .no-print { display: none; }
        }
    </style>
    <script>
        window.addEventListener('load', function() {
            window.print();
        });
    </script>
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

<h2>Daftar Rule Pelatihan Kerja</h2>

<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Rule</th>
            <th>Rekomendasi Pelatihan</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $no = 1;
        foreach ($rules as $kode_pelatihan => $dataminat_list):
            $arr_dataminat = [];
            foreach ($dataminat_list as $kode_dataminat => $val) {
                $arr_dataminat[] = htmlspecialchars($dataminat[$kode_dataminat]);
            }
            $if_text = 'IF ' . implode(' AND ', $arr_dataminat);
            $then_text = htmlspecialchars($pelatihan[$kode_pelatihan]->nama_pelatihan);
        ?>
            <tr>
                <td><?= $no++ ?></td>
                <td><?= $if_text ?></td>
                <td><?= $then_text ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

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
