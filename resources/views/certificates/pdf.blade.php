<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sertifikat - {{ $certificate->full_name }}</title>
    
    <!-- Menggunakan Google Font (Playfair Display) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;900&display=swap" rel="stylesheet">
    
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Menerapkan font khusus untuk judul dan nama */
        .font-playfair {
            font-family: 'Playfair Display', serif;
        }
        
        /* Membuat bingkai ganda (double border) */
        .double-border {
            position: relative;
            border: 10px solid #b45309; /* amber-700 */
        }
        .double-border::before {
            content: "";
            position: absolute;
            top: 20px;
            left: 20px;
            right: 20px;
            bottom: 20px;
            border: 2px solid #b45309; /* amber-700 */
            pointer-events: none;
        }

        @media print {
            body {
                margin: 0;
                padding: 0;
                background: white;
            }
            .no-print {
                display: none !important;
            }
            /* Pastikan warna tetap tercetak dengan baik */
            .text-amber-700 {
                -webkit-print-color-adjust: exact;
                color-adjust: exact;
            }
        }
    </style>
</head>
<body class="bg-gray-100">
    <!-- Download Buttons (Hidden on print) -->
    <div class="no-print flex justify-center gap-4 p-4 bg-white sticky top-0 shadow-md">
        <button onclick="window.print()" class="bg-amber-600 text-white px-6 py-2 rounded hover:bg-amber-700 transition-colors">
            🖨️ Cetak / Simpan sebagai PDF
        </button>
        <a href="{{ route('modules.index') }}" class="bg-gray-600 text-white px-6 py-2 rounded hover:bg-gray-700 transition-colors">
            ← Kembali
        </a>
    </div>

    <div class="flex justify-center p-4 md:p-8">
        <!-- Certificate -->
        <div class="max-w-4xl w-full bg-white shadow-2xl relative overflow-hidden" style="aspect-ratio: 16/10;">
            <!-- Bingkai Ganda -->
            <div class="absolute inset-0 double-border"></div>
            
            <!-- Certificate Content -->
            <div class="absolute inset-0 flex flex-col items-center justify-center p-8 md:p-12 text-center">
                <!-- Logo/Stamp Placeholder -->
                <div class="absolute top-8 right-8 w-24 h-24 opacity-20">
                    <!-- Ganti dengan <img src="{{ asset('images/logo-sgc.png') }}" alt="Logo SGC-EasyLearn"> -->
                    <div class="w-full h-full border-4 border-amber-700 rounded-full flex items-center justify-center">
                        <span class="text-amber-700 font-bold text-xs text-center">LOGO<br>SGC-EasyLearn</span>
                    </div>
                </div>

                <!-- Top Decoration -->
                <div class="mb-6">
                    <div class="inline-block px-6 py-2 border-2 border-amber-700 rounded-full">
                        <span class="text-amber-700 font-bold tracking-widest font-playfair text-xl">SERTIFIKAT</span>
                    </div>
                </div>

                <!-- Main Text -->
                <div class="mb-8">
                    <h1 class="text-4xl md:text-5xl font-black text-gray-900 mb-4 font-playfair">Penghargaan Keberhasilan</h1>
                    <p class="text-lg text-gray-600">Dengan bangga diberikan kepada</p>
                </div>

                <!-- Recipient Name -->
                <div class="mb-8">
                    <p class="text-4xl md:text-5xl font-bold text-amber-700 border-b-4 border-amber-700 pb-3 px-8 font-playfair">
                        {{ $certificate->full_name }}
                    </p>
                </div>

                <!-- Certificate Details -->
                <div class="mb-12 text-gray-700 max-w-2xl">
                    <p class="text-lg mb-2">telah berhasil menyelesaikan modul pembelajaran</p>
                    <p class="text-2xl font-bold text-amber-700 mb-4 font-playfair">{{ $certificate->module->title }}</p>
                    <p class="text-sm">Nomor Sertifikat: <span class="font-mono font-bold">{{ $certificate->certificate_number }}</span></p>
                    <p class="text-sm mt-2">Diselesaikan pada: {{ $certificate->completed_at->format('d F Y') }}</p>
                </div>

                <!-- Signatures -->
                <div class="flex justify-around w-full mt-auto px-12">
                    <div class="text-center">
                        <div class="w-32 h-16 border-b-2 border-gray-400 mb-2"></div>
                        <p class="text-sm font-semibold text-gray-700">Pengajar</p>
                        <p class="text-xs text-gray-500">(Nama Pengajar)</p>
                    </div>
                    <div class="text-center">
                        <div class="w-32 h-16 border-b-2 border-gray-400 mb-2"></div>
                        <p class="text-sm font-semibold text-gray-700">Pimpinan Pusat</p>
                        <p class="text-xs text-gray-500">(Nama Pimpinan)</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>