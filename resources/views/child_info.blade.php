<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informasi Anak</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-white text-gray-900">
    <div class="container mx-auto p-4 md:p-6 max-w-md w-full">
        @if ($latestMedicalRecord)
            <div class="text-base md:text-lg font-bold mb-4 text-black">
                Informasi tentang {{ $child->nama }}
            </div>
            <ul class="list-none p-0 text-sm md:text-base text-black space-y-2">
                <li class="border-b border-gray-200 pb-2"><strong>Tanggal:</strong> {{ $latestMedicalRecord->tanggal ?? 'Tidak ada data' }}</li>             
                <li class="border-b border-gray-200 pb-2"><strong>Makan Pagi:</strong> {{ $latestMedicalRecord->makan_pagi ?? 'Tidak ada data' }}</li>             
                <li class="border-b border-gray-200 pb-2"><strong>Makan Siang:</strong> {{ $latestMedicalRecord->makan_siang ?? 'Tidak ada data' }}</li>             
                <li class="border-b border-gray-200 pb-2"><strong>Makan Sore:</strong> {{ $latestMedicalRecord->makan_sore ?? 'Tidak ada data' }}</li>             
                <li class="border-b border-gray-200 pb-2">
                    <strong>Camilan:</strong>
                    <b> Pagi:</b> {{ $latestMedicalRecord->makanan_camilan_pagi ?? 'Tidak ada data' }},
                    <b>Siang:</b> {{ $latestMedicalRecord->makanan_camilan_siang ?? 'Tidak ada data' }}
                </li>             
                <li class="border-b border-gray-200 pb-2"><strong>Air Putih:</strong> {{ $latestMedicalRecord->air_putih_pagi ?? 'Tidak ada data' }}</li>             
                <li class="border-b border-gray-200 pb-2"><strong>Susu:</strong> {{ $latestMedicalRecord->susu_pagi ?? 'Tidak ada data' }}</li>             
                <li class="border-b border-gray-200 pb-2"><strong>Buang Air Besar:</strong> {{ $latestMedicalRecord->bab_pagi ?? 'Tidak ada data' }}</li>             
                <li class="border-b border-gray-200 pb-2"><strong>Buang Air Kecil:</strong> {{ $latestMedicalRecord->bak_pagi ?? 'Tidak ada data' }}</li>
                <li class="border-b border-gray-200 pb-2"><strong>Catatan Buang Air:</strong> {{ $latestMedicalRecord->catatan_buang_air ?? 'Tidak ada data' }}</li>             
                <li class="border-b border-gray-200 pb-2"><strong>Kegiatan Indoor:</strong> {{ $latestMedicalRecord->kegiatan_indoor ?? 'Tidak ada data' }}</li>             
                <li class="border-b border-gray-200 pb-2"><strong>Kegiatan Outdoor:</strong> {{ $latestMedicalRecord->kegiatan_outdoor ?? 'Tidak ada data' }}</li>             
                <li class="border-b border-gray-200 pb-2"><strong>Tidur:</strong> {{ $latestMedicalRecord->tidur_pagi ?? 'Tidak ada data' }}</li>  
                <li class="pb-2">
                    <strong>Catatan:</strong>
                    <textarea class="w-full bg-gray-100 p-3 rounded-md border border-gray-300 focus:ring-purple-500 focus:border-purple-500" rows="3" readonly>{{ $latestMedicalRecord->keterangan ?? 'Tidak ada data' }}</textarea>
                </li>
            </ul>
        @else
            <p class="text-sm text-gray-500">Tidak ada data riwayat terbaru.</p>
        @endif
    </div>
</body>
</html>
