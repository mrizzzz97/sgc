<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sertifikat - <?php echo e($certificate->full_name); ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="min-h-screen flex items-center justify-center p-4">
        <!-- Certificate Container -->
        <div class="max-w-4xl w-full">
            <!-- Certificate Background -->
            <div class="bg-white shadow-2xl" style="aspect-ratio: 16/10;">
                <div class="w-full h-full relative overflow-hidden">
                    <!-- Decorative Background -->
                    <div class="absolute inset-0 bg-gradient-to-br from-indigo-50 via-white to-purple-50"></div>
                    
                    <!-- Certificate Content -->
                    <div class="absolute inset-0 flex flex-col items-center justify-center p-12 text-center">
                        <!-- Top Decoration -->
                        <div class="mb-6">
                            <div class="inline-block px-6 py-2 border-2 border-indigo-600 rounded-full">
                                <span class="text-indigo-600 font-bold tracking-widest">SERTIFIKAT</span>
                            </div>
                        </div>

                        <!-- Main Text -->
                        <div class="mb-8">
                            <h1 class="text-5xl font-bold text-gray-900 mb-4">Penghargaan Keberhasilan</h1>
                            <p class="text-lg text-gray-600">Diberikan kepada</p>
                        </div>

                        <!-- Recipient Name -->
                        <div class="mb-8">
                            <p class="text-5xl font-bold text-indigo-600 border-b-4 border-indigo-600 pb-3 px-8">
                                <?php echo e($certificate->full_name); ?>

                            </p>
                        </div>

                        <!-- Certificate Details -->
                        <div class="mb-12 text-gray-700">
                            <p class="text-lg mb-2">telah berhasil menyelesaikan modul pembelajaran</p>
                            <p class="text-2xl font-bold text-indigo-600 mb-4"><?php echo e($module->title); ?></p>
                            <p class="text-sm">Nomor Sertifikat: <span class="font-mono font-bold"><?php echo e($certificate->certificate_number); ?></span></p>
                            <p class="text-sm mt-2">Diselesaikan pada: <?php echo e($certificate->completed_at->format('d F Y')); ?></p>
                        </div>

                        <!-- Signatures -->
                        <div class="flex justify-around w-full mt-16 px-12">
                            <div class="text-center">
                                <div class="w-32 h-16 border-b-2 border-gray-400 mb-2"></div>
                                <p class="text-sm font-semibold text-gray-700">Guru Pembimbing</p>
                            </div>
                            <div class="text-center">
                                <div class="w-32 h-16 border-b-2 border-gray-400 mb-2"></div>
                                <p class="text-sm font-semibold text-gray-700">Kepala Sekolah</p>
                            </div>
                        </div>
                    </div>

                    <!-- Border Decoration -->
                    <div class="absolute inset-0 border-8 border-indigo-600 pointer-events-none" style="margin: 20px;"></div>
                </div>
            </div>

            <!-- Buttons -->
            <div class="flex gap-4 justify-center mt-8">
                <a href="<?php echo e(route('certificates.download', $certificate)); ?>" 
                   class="bg-indigo-600 text-white px-8 py-3 rounded-lg hover:bg-indigo-700 font-semibold transition">
                    📥 Download PDF
                </a>
                <a href="<?php echo e(route('modules.index')); ?>" 
                   class="bg-gray-600 text-white px-8 py-3 rounded-lg hover:bg-gray-700 font-semibold transition">
                    ← Kembali ke Modul
                </a>
            </div>
        </div>
    </div>

    <script>
        // Print untuk download PDF
        function downloadAsPDF() {
            window.print();
        }
    </script>
</body>
</html>
<?php /**PATH C:\school\idn-kelas-10\lomba-lomba\te\laravel\sgc\resources\views\certificates\show.blade.php ENDPATH**/ ?>