<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Sertifikat</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            text-align: center;
            padding: 40px;
            background: #f8f8f8;
        }

        .container {
            width: 100%;
            padding: 40px;
            border: 6px solid #333;
            background: #fff;
        }

        h1 {
            font-size: 40px;
            letter-spacing: 2px;
            margin-bottom: 5px;
        }

        .name {
            font-size: 30px;
            font-weight: bold;
            margin: 20px 0;
        }

        .module {
            font-size: 22px;
            margin-top: 10px;
        }

        .footer {
            margin-top: 60px;
            font-size: 16px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>SERTIFIKAT</h1>

        <p>Diberikan kepada:</p>

        <div class="name"><?php echo e($user->name); ?></div>

        <p>Atas penyelesaian modul:</p>

        <div class="module"><?php echo e($module->title); ?></div>

        <p>Nilai rata-rata: <b><?php echo e($score); ?>%</b></p>

        <div class="footer">
            Diterbitkan pada: <?php echo e($date); ?>

        </div>
    </div>
</body>
</html>
<?php /**PATH C:\school\idn-kelas-10\lomba-lomba\te\laravel\sgc\resources\views\dashboard\certificate_pdf.blade.php ENDPATH**/ ?>