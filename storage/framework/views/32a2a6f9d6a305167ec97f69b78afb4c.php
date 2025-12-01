<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Download Sertifikat - <?php echo e($certificate->full_name); ?></title>
    
    <!-- Menggunakan Google Font yang sama dengan sertifikat -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;900&display=swap" rel="stylesheet">
    
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Menerapkan font khusus untuk judul */
        .font-playfair {
            font-family: 'Playfair Display', serif;
        }
    </style>
</head>
<!-- 1. Mengubah background menjadi warna yang selaras -->
<body class="bg-amber-50">
    <div class="min-h-screen flex items-center justify-center p-4">
        <div class="max-w-2xl w-full">
            <!-- Branding -->
            <div class="text-center mb-6">
                <h1 class="text-3xl font-bold text-amber-800">SGC-EasyLearn</h1>
            </div>

            <!-- Success Message (Dengan warna tema emas) -->
            <div class="mb-8 p-6 bg-amber-100 border-l-4 border-amber-600 rounded-lg shadow-md">
                <div class="flex items-center">
                    <svg class="w-8 h-8 text-amber-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <div>
                        <h2 class="text-2xl font-bold text-amber-800 mb-1 font-playfair">Selamat! Sertifikat Berhasil Dibuat</h2>
                        <p class="text-amber-700">Sertifikat Anda untuk modul <strong><?php echo e($module->title); ?></strong> siap dilihat dan dicetak.</p>
                    </div>
                </div>
            </div>

            <!-- Certificate Preview (Dengan warna tema emas) -->
            <div class="bg-white shadow-xl rounded-lg overflow-hidden mb-8">
                <div class="text-center p-6 bg-gradient-to-br from-amber-50 to-white">
                    <div class="inline-block px-6 py-2 border-2 border-amber-700 rounded-full mb-6">
                        <span class="text-amber-700 font-bold tracking-widest font-playfair text-xl">SERTIFIKAT</span>
                    </div>
                </div>

                <div class="text-center p-6">
                    <h3 class="text-3xl font-bold text-gray-900 mb-6 font-playfair">Penghargaan Keberhasilan</h3>
                    <p class="text-lg text-gray-600 mb-4">Diberikan kepada</p>
                    
                    <p class="text-4xl font-bold text-amber-700 border-b-4 border-amber-700 pb-4 px-6 mb-8 font-playfair">
                        <?php echo e($certificate->full_name); ?>

                    </p>

                    <p class="text-gray-700 mb-2">telah berhasil menyelesaikan modul pembelajaran</p>
                    <p class="text-2xl font-bold text-amber-700 mb-4 font-playfair"><?php echo e($module->title); ?></p>
                    <p class="text-sm text-gray-600">Nomor Sertifikat: <span class="font-mono font-bold"><?php echo e($certificate->certificate_number); ?></span></p>
                    <p class="text-sm text-gray-600">Diselesaikan pada: <?php echo e($certificate->completed_at->format('d F Y')); ?></p>
                </div>
            </div>

            <!-- 2. Tombol Aksi yang Disederhanakan -->
            <div class="flex flex-col sm:flex-row gap-4">
                <!-- Primary Action Button -->
                <a href="<?php echo e(route('certificates.show', $certificate)); ?>" class="flex-1 bg-amber-600 hover:bg-amber-700 text-white font-bold py-3 px-6 rounded-lg transition duration-200 flex items-center justify-center gap-2 shadow-lg">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                    </svg>
                    Lihat & Cetak Sertifikat
                </a>

                <!-- Secondary Action Button -->
                <a href="<?php echo e(route('modules.show', $module)); ?>" class="flex-1 bg-gray-600 hover:bg-gray-700 text-white font-bold py-3 px-6 rounded-lg transition duration-200 text-center flex items-center justify-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Kembali ke Modul
                </a>
            </div>

            <!-- Information (Dengan warna tema emas) -->
            <div class="mt-8 p-4 bg-amber-100 rounded-lg border-l-4 border-amber-500">
                <p class="text-sm text-amber-800">
                    <strong>Tip:</strong> Anda dapat mengunduh atau mencetak sertifikat ini kapan saja dari halaman profil Anda.
                </p>
            </div>
        </div>
    </div>

    <style>
        @media print {
            body {
                background: white;
            }
            /* Sembunyikan semua elemen UI saat print */
            .bg-amber-100, button, a, .bg-amber-50, h1 {
                display: none !important;
            }
            .bg-white {
                box-shadow: none;
                border: none;
            }
        }
    </style>
</body>
</html><?php /**PATH C:\school\idn-kelas-10\lomba-lomba\te\laravel\sgc\resources\views\certificates\download.blade.php ENDPATH**/ ?>