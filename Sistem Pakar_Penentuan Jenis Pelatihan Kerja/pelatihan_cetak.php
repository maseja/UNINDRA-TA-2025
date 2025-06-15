<!DOCTYPE html>
<html>
<head>
    <title>Laporan Pelatihan Kerja</title>
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
        .content {
            margin-bottom: 40px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 10px 8px;
            text-align: left;
        }
        th {
            background-color: #f0f0f0;
        }
        .footer {
            margin-top: 60px;
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

<div class="content">
    <h2>Laporan Rekomendasi Pelatihan Kerja</h2>
    <table>
        <thead>
            <tr>
                <th>Kode</th>
                <th>Nama Pelatihan</th>
                <th>Deskripsi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $rows = $db->get_results("SELECT * FROM tb_pelatihan ORDER BY kode_pelatihan");
            foreach ($rows as $row) : ?>
                <tr>
                    <td><?= htmlspecialchars($row->kode_pelatihan) ?></td>
                    <td><?= htmlspecialchars($row->nama_pelatihan) ?></td>
                    <td><?= htmlspecialchars($row->keterangan) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

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
        1 => 'Januari',
        2 => 'Februari',
        3 => 'Maret',
        4 => 'April',
        5 => 'Mei',
        6 => 'Juni',
        7 => 'Juli',
        8 => 'Agustus',
        9 => 'September',
        10 => 'Oktober',
        11 => 'November',
        12 => 'Desember'
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
