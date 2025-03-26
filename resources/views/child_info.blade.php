<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informasi Anak</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    <div class="text-lg font-bold mb-2.5 text-black">Informasi Tentang {{ $child->name }}</div>
    @if ($latestMedicalRecord)
        <ul class="list-none p-0 text-sm text-black">
            <li class="py-2 border-b border-gray-200"><strong>Tanggal:</strong> {{ $latestMedicalRecord->tanggal }}</li>
            <li class="py-2 border-b border-gray-200"><strong>Makan Pagi:</strong> {{ $latestMedicalRecord->makan_pagi }}</li>
            <li class="py-2 border-b border-gray-200"><strong>Makan Siang:</strong> {{ $latestMedicalRecord->makan_siang }}</li>
            <li class="py-2 border-b border-gray-200"><strong>Makan Sore:</strong> {{ $latestMedicalRecord->makan_sore }}</li>
            <li class="py-2 border-b border-gray-200"><strong>Camilan:</strong> {{ $latestMedicalRecord->camilan }}</li>
            <li class="py-2 border-b border-gray-200"><strong>Air Putih:</strong> {{ $latestMedicalRecord->air_putih }}</li>
            <li class="py-2 border-b border-gray-200"><strong>Susu:</strong> {{ $latestMedicalRecord->susu }}</li>
            <li class="py-2 border-b border-gray-200"><strong>Buang Air Besar:</strong> {{ $latestMedicalRecord->bab }}</li>
            <li class="py-2 border-b border-gray-200"><strong>Buang Air Kecil:</strong> {{ $latestMedicalRecord->bak }}</li>
            <li class="py-2 border-b border-gray-200"><strong>Kegiatan Indoor:</strong> {{ $latestMedicalRecord->kegiatan_indoor }}</li>
            <li class="py-2 border-b border-gray-200"><strong>Kegiatan Outdoor:</strong> {{ $latestMedicalRecord->kegiatan_outdoor }}</li>
            <li class="py-2 border-b border-gray-200"><strong>Tidur:</strong> {{ $latestMedicalRecord->tidur }}</li>
            <li class="py-2 border-b border-gray-200">
                <strong>Catatan:</strong>
                <textarea class="w-full bg-gray-200 p-2 rounded-md border border-gray-300 focus:ring-purple-500 focus:border-purple-500" rows="3" placeholder="Tulis catatan di sini...">{{ $latestMedicalRecord->catatan }}</textarea>
            </li>
        </ul>
    @else
        <p class="text-sm text-gray-500">Tidak ada data riwayat terbaru.</p>
    @endif
</body>
</html>