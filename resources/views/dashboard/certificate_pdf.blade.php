<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Sertifikat SGC</title>

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;900&family=Montserrat:wght@400;500;700&display=swap" rel="stylesheet">

<style>
@page {
    size: A4 landscape;
    margin: 0;
}

:root {
    --primary: #0a2463;
    --accent: #c9a227;
    --light: #f7f9fc;
    --border: #d5d7dd;
}

body {
    margin: 0;
    font-family: 'Montserrat', sans-serif;
    background: #eef1ff;
}

/* Fix tinggi agar tidak membuat halaman ke-2 */
.wrapper {
    width: 100%;
    height: 190mm; /* Height optimal */
    padding: 15mm 18mm;
    background: var(--light);
    box-sizing: border-box;
    position: relative;
    overflow: hidden;
}

/* Dekorasi sudut */
.corner {
    position: absolute;
    width: 110px;
    height: 110px;
    border: 3px solid var(--accent);
    opacity: 0.55;
}

.corner.tl {
    top: 8mm; left: 8mm;
    border-right: none; border-bottom: none;
}
.corner.tr {
    top: 8mm; right: 8mm;
    border-left: none; border-bottom: none;
}
.corner.bl {
    bottom: 8mm; left: 8mm;
    border-right: none; border-top: none;
}
.corner.br {
    bottom: 8mm; right: 8mm;
    border-left: none; border-top: none;
}

/* Watermark */
.watermark {
    position: absolute;
    top: 50%; left: 50%;
    width: 42%;
    opacity: 0.05;
    transform: translate(-50%, -50%);
}

/* Logo */
.logo {
    width: 38mm;
    display: block;
    margin: 0 auto 6mm auto;
    position: relative;
    z-index: 2;
}

/* Judul */
h1 {
    font-family: 'Playfair Display', serif;
    font-size: 40px;
    text-align: center;
    margin: 0;
    color: var(--primary);
    font-weight: 900;
    letter-spacing: 1px;
}

.subtitle {
    text-align: center;
    margin-top: 6px;
    font-size: 15px;
    color: #555;
}

/* Nama siswa */
.name {
    font-family: 'Playfair Display', serif;
    text-align: center;
    font-size: 34px;
    margin-top: 10mm;
    font-weight: 700;
    color: var(--primary);
}

/* Module */
.module-label {
    text-align: center;
    font-size: 15px;
    margin-top: 6mm;
    color: #666;
}

.module-title {
    text-align: center;
    font-size: 22px;
    font-weight: 700;
    color: var(--primary);
    margin-top: 4px;
}

/* Deskripsi */
.desc {
    width: 70%;
    margin: 10mm auto;
    text-align: center;
    font-size: 14px;
    line-height: 1.5;
    color: #444;
}

/* Badge nilai */
.seal {
    margin-top: 2mm;
    display: flex;
    justify-content: center;
}

.seal-circle {
    width: 110px;
    height: 110px;
    border-radius: 50%;
    background: conic-gradient(from 180deg, var(--accent), #fbeec2, var(--accent));
    padding: 5px;
    display: flex;
    justify-content: center;
    align-items: center;
    box-shadow: 0 4px 12px rgba(0,0,0,0.15);
}

.seal-inner {
    background: white;
    width: 100%;
    height: 100%;
    border-radius: 50%;
    text-align: center;
    padding-top: 22px;
}

.seal-score {
    margin-top: 20px;
    font-weight: 700;
    font-size: 22px;
    color: var(--primary);
}

.seal-text {
    font-size: 10px;
    margin-top: 1px;
    color: #666;
}

/* Footer */
.footer {
    position: absolute;
    bottom: 12mm;
    left: 18mm;
    right: 18mm;
    display: flex;
    justify-content: space-between;
    align-items: flex-end;
}

.date {
    font-size: 14px;
    color: #444;
}

/* Signature Box */
.signature-box {
    width: 30mm;
    text-align: center;
    border: 1px solid var(--border);
    padding: 12px 15px 15px 15px;
    background: white;
    border-radius: 6px;
    position: relative;
}

/* signature image lebih lebar, tidak terdistorsi */
.signature-image {
    width: 30mm;
    height: auto;
    margin-bottom: 2mm;
    object-fit: contain;
}

/* garis lebih presisi */
.signature-line {
    width: 30mm;
    height: 1.3px;
    background: #000;
    margin: -1mm auto 3mm auto;
}

.signature-name {
    font-weight: 700;
    font-size: 15px;
    margin-top: 1mm;
}

.signature-role {
    font-size: 12px;
    color: #555;
}

</style>
</head>

<body>

<div class="wrapper">

    <!-- Corners -->
    <div class="corner tl"></div>
    <div class="corner tr"></div>
    <div class="corner bl"></div>
    <div class="corner br"></div>

    <!-- Watermark -->
    <img src="{{ public_path('img/sgc-logo.png') }}" class="watermark">

    <!-- Logo -->
    <img src="{{ public_path('img/sgc-logo.png') }}" class="logo">

    <h1>SERTIFIKAT KOMPETENSI</h1>
    <div class="subtitle">Dengan bangga diberikan kepada</div>

    <div class="name">{{ $user->name }}</div>

    <div class="module-label">Atas keberhasilan menyelesaikan modul pelatihan</div>
    <div class="module-title">{{ $module->title }}</div>

    <div class="desc">
        Sertifikat ini diberikan sebagai bentuk penghargaan atas dedikasi, komitmen,
        dan konsistensi dalam menyelesaikan seluruh rangkaian materi.
        Semoga menjadi langkah penting dalam pengembangan diri dan karier.
    </div>

    <!-- Score Seal -->
    <div class="seal">
        <div class="seal-circle">
            <div class="seal-inner">
                <div class="seal-score">{{ $score }}%</div>
                <div class="seal-text">NILAI RATA-RATA</div>
            </div>
        </div>
    </div>

    <div class="footer">
        <div class="date">
            Diterbitkan pada:<br>
            <strong>{{ $date }}</strong>
        </div>

        <div class="signature-box">
            <img src="{{ public_path('img/ttd.png') }}" class="signature-image">

            <div class="signature-line"></div>

            <div class="signature-name">Founder SGC</div>
            <div class="signature-role">Muhammad Rizki Suryapratama</div>
        </div>
    </div>

</div>

</body>
</html>
