<!DOCTYPE html>
<html>
<head>
    <title>Rule</title>
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

        .btn-print {
            background-color: #f39c12; /* Orange */
            color: white;
        }

        .btn-print:hover {
            background-color: white;
            color: #f39c12;
            border: 2px solid #f39c12;
        }

        .card-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px;
        }

        .card {
            background-color: #f0f0f5; /* Light Gray */
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 20px;
            width: 300px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }

        .card-header {
            background-color: #007BFF; /* Blue */
            color: white;
            padding: 10px;
            border-radius: 8px 8px 0 0;
        }

        .card-body {
            padding: 10px;
        }

        .text-danger {
            color: #d9534f;
        }

        .text-primary {
            color: #007BFF; /* Blue */
        }

        .page-header h1 {
            font-size: 24px;
            color: #333;
            text-align: center;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>

<div class="page-header">
    <h1>Rule</h1>
</div>

<!-- Tombol Cetak -->
<div style="text-align: center; margin-bottom: 20px;">
    <a href="rule_cetak.php" class="custom-btn btn-print" target="_blank">Cetak</a>
</div>

<div class="card-container">
    <?php
    $rules = get_relasi(array());
    $no = 1;
    foreach ($rules as $kode_pelatihan => $val) :
        $rule = array();
        foreach ($val as $kode_dataminat => $v) {
            $rule[] = '<span class="text-danger">' . $dataminat[$kode_dataminat] . '</span>';
        }
    ?>
        <div class="card">
            <div class="card-header">
                Rule <?= $no++ ?>
            </div>
            <div class="card-body">
                <p><strong>IF</strong> <?= implode('<br />&nbsp; &nbsp; &nbsp;<strong>AND</strong> ', $rule) ?></p>
                <p><strong>THEN</strong> <span class="text-primary"><?= $pelatihan[$kode_pelatihan]->nama_pelatihan ?></span></p>
            </div>
        </div>
    <?php endforeach; ?>
</div>

</body>
</html>
