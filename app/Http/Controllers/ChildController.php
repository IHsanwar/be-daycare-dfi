<?php

namespace App\Http\Controllers;

use App\Models\Child;
use App\Models\ChildHistory;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ChildHistoryExport;
use Illuminate\Support\Facades\Log;

class ChildController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'nama' => 'required|string|max:255',
            'nama_pendamping' => 'nullable|string|max:255',
        ]);

        $child = Child::create([
            'user_id' => $request->user_id,
            'nama' => $request->nama,
            'nama_pendamping' => $request->nama_pendamping,
        ]);

        return redirect()->back()->with('success', 'Anak berhasil ditambahkan');
    }

    public function destroy(Request $request, $id)
    {
        $child = Child::find($id);
    
        if (!$child) {
            return response()->json(['success' => false, 'message' => 'Data tidak ditemukan.'], 404);
        }
    
        $child->delete();
    
        return response()->json(['success' => true, 'message' => 'Data berhasil dihapus.']);
    }
    

    public function updateStatus(Request $request, $id)
    {
        $child = Child::findOrFail($id);
        $today = Carbon::now()->format('Y-m-d');

        $validatedData = $request->validate([
            'nama_pendamping' => 'required|string',
            'tanggal' => 'required|date_format:d-m-Y',
            'makan_pagi' => 'nullable|string',
            'makan_siang' => 'nullable|string',
            'makan_sore' => 'nullable|string',
            'makan_pagi_custom' => 'nullable|string',
            'makan_siang_custom' => 'nullable|string',
            'makan_sore_custom' => 'nullable|string',
            'susu_pagi' => 'nullable|integer',
            'susu_siang' => 'nullable|integer',
            'susu_sore' => 'nullable|integer',
            'air_putih_pagi' => 'nullable|integer',
            'air_putih_siang' => 'nullable|integer',
            'air_putih_sore' => 'nullable|integer',
            'bak_pagi' => 'nullable|integer',
            'bak_siang' => 'nullable|integer',
            'bak_sore' => 'nullable|integer',
            'bab_pagi' => 'nullable|integer',
            'bab_siang' => 'nullable|integer',
            'bab_sore' => 'nullable|integer',
            'tidur_pagi' => 'nullable|integer',
            'tidur_siang' => 'nullable|integer',
            'tidur_sore' => 'nullable|integer',
            'kegiatan_outdoor' => 'nullable|array',
            'kegiatan_outdoor_lainnya' => 'nullable|string|max:255',
            'keterangan' => 'nullable|string',
            'kegiatan_indoor' => 'nullable|array',
            'kegiatan_indoor_lainnya' => 'nullable|string|max:255',
            'makanan_camilan_pagi' => 'nullable|array',
            'makanan_camilan_siang' => 'nullable|array',
            'makanan_camilan_sore' => 'nullable|array',
            'makanan_camilan_pagi.*' => 'nullable|string',
            'makanan_camilan_siang.*' => 'nullable|string',
            'makanan_camilan_sore.*' => 'nullable|string',
            'kondisi' => 'nullable|in:sehat,sakit',
            'obat_pagi' => 'nullable|date_format:H:i',
            'obat_siang' => 'nullable|date_format:H:i',
            'obat_sore' => 'nullable|date_format:H:i',
        ]);

        $tanggal = Carbon::createFromFormat('d-m-Y', $validatedData['tanggal'])->format('Y-m-d');

        foreach (['pagi', 'siang', 'sore'] as $waktu) {
            if (isset($validatedData["makan_$waktu"]) && $validatedData["makan_$waktu"] === 'custom') {
                $validatedData["makan_$waktu"] = $validatedData["makan_{$waktu}_custom"] ?? 'custom';
            }
            unset($validatedData["makan_{$waktu}_custom"]);
        }

        $kegiatanOutdoor = $request->kegiatan_outdoor ?? [];
        $kegiatanOutdoorLainnya = $request->kegiatan_outdoor_lainnya;

        if (in_array('lainnya', $kegiatanOutdoor) && $kegiatanOutdoorLainnya) {
            $key = array_search('lainnya', $kegiatanOutdoor);
            if ($key !== false) {
                unset($kegiatanOutdoor[$key]);
                $kegiatanOutdoor[] = $kegiatanOutdoorLainnya;
            }
        }

        $validatedData['kegiatan_outdoor'] = json_encode($kegiatanOutdoor);

        unset($validatedData['kegiatan_outdoor_lainnya']);

        $kegiatanIndoor = $request->kegiatan_indoor ?? [];
        $kegiatanIndoorLainnya = $request->kegiatan_indoor_lainnya;

        if (in_array('lainnya', $kegiatanIndoor) && $kegiatanIndoorLainnya) {
            $key = array_search('lainnya', $kegiatanIndoor);
            if ($key !== false) {
                unset($kegiatanIndoor[$key]);
                $kegiatanIndoor[] = $kegiatanIndoorLainnya;
            }
        }

        $validatedData['kegiatan_indoor'] = json_encode($kegiatanIndoor);

        unset($validatedData['kegiatan_indoor_lainnya']);

        $validatedData['tanggal'] = $tanggal;

        $validatedData['makanan_camilan_pagi'] = json_encode(array_filter($validatedData['makanan_camilan_pagi'] ?? []));
        $validatedData['makanan_camilan_siang'] = json_encode(array_filter($validatedData['makanan_camilan_siang'] ?? []));
        $validatedData['makanan_camilan_sore'] = json_encode(array_filter($validatedData['makanan_camilan_sore'] ?? []));

        $child->update($validatedData);

        ChildHistory::where('child_id', $child->id)
            ->whereDate('tanggal', $tanggal)
            ->delete();

        $childHistory = new ChildHistory($validatedData);
        $childHistory->child_id = $child->id;
        $childHistory->save();

        return redirect()->to('/success')->with('success', 'Status anak berhasil diperbarui dan riwayat terbaru disimpan.');
    }


    public function editStatus($id, $type = null)
{
    $child = Child::findOrFail($id);
    $today = Carbon::now()->format('Y-m-d');

    // Ambil histori terbaru (prioritaskan hari ini, jika tidak ada ambil yang terakhir)
    $latestHistory = $child->histories()
        ->whereDate('tanggal', '<=', $today)
        ->latest()
        ->first();

    // Jika ada histori terbaru, gunakan datanya
    if ($latestHistory) {
        $child->fill($latestHistory->toArray());
        $child->kegiatan_outdoor = json_decode($latestHistory->kegiatan_outdoor, true) ?? [];
        $child->kegiatan_indoor = json_decode($latestHistory->kegiatan_indoor, true) ?? [];
    }

    // Hanya update field yang dikirim dalam request
    $updateFields = request()->only([
        'makan_pagi', 'makan_siang', 'makan_sore', 'nama_pendamping',
        'susu_pagi', 'susu_siang', 'susu_sore',
        'air_putih_pagi', 'air_putih_siang', 'air_putih_sore',
        'bak_pagi', 'bak_siang', 'bak_sore',
        'bab_pagi', 'bab_siang', 'bab_sore',
        'tidur_pagi', 'tidur_siang', 'tidur_sore',
        'kegiatan_outdoor', 'kegiatan_indoor', 'keterangan',
        'obat_pagi', 'obat_siang', 'obat_sore',
        'makan_pagi_custom', 'makan_siang_custom', 'makan_sore_custom',
        'makanan_camilan_pagi', 'makanan_camilan_siang', 'makanan_camilan_sore',
        'kondisi'
    ]);

    // Update hanya field yang dikirim
    $child->fill($updateFields);

    // Simpan perubahan ke database
    $child->save();

    // Pilih tampilan berdasarkan tipe
    return match (trim($type)) {
        'makan-cemilan' => view('updatestatus.updatestatusmakan', compact('child')),
        'buang-air' => view('updatestatus.updatestatusbuangair', compact('child')),
        'kegiatan' => view('updatestatus.updatestatuskegiatan', compact('child')),
        'keterangan' => view('updatestatus.updatestatusketerangan', compact('child')),
        'kesehatan' => view('updatestatus.updatestatuskesehatan', compact('child')),
        default => view('editstatus', compact('child')),
    };
}

    
    public function search(Request $request)
    {
        $search = $request->input('search');
        
        $children = Child::query()
            ->where('nama', 'LIKE', "%{$search}%")
            ->orWhereHas('user', function($query) use ($search) {
                $query->where('name', 'LIKE', "%{$search}%");
            })
            ->get();

        return view('dashboardanak.dashboardanak', [
            'children' => $children,
            'users' => \App\Models\User::where('role', 'user')->get()
        ]);
    }

    public function showHistory($id)
    {
        $child = Child::findOrFail($id);
        $histories = $child->histories()->orderBy('tanggal', 'desc')->paginate(7);
        return view('child_history', compact('child', 'histories'));
    }

    public function showInfo($id)
{
    try {
        $child = Child::findOrFail($id);

        $latestMedicalRecord = $child->histories()->latest('tanggal')->first();

        // Debugging output to log file
        Log::info('Child Info:', ['child' => $child]);
        Log::info('Latest Medical Record:', ['record' => $latestMedicalRecord]);

        return view('child_info', compact('child', 'latestMedicalRecord'));
    } catch (\Exception $e) {
        Log::error('Child Info Fetch Error: ' . $e->getMessage());
        return redirect()->back()->with('error', 'Unable to fetch child information.');
    }
}

    

    public function downloadExcel(Request $request, $id)
    {
        $child = Child::findOrFail($id);
        $dateRange = explode(' - ', $request->input('daterange'));
        $startDate = Carbon::createFromFormat('d-m-Y', $dateRange[0])->startOfDay();
        $endDate = Carbon::createFromFormat('d-m-Y', $dateRange[1])->endOfDay();

        $histories = $child->histories()
            ->whereBetween('tanggal', [$startDate, $endDate])
            ->orderBy('tanggal', 'desc')
            ->get();

        $fileName = 'Riwayat ' . $child->nama . '.xlsx';
        return Excel::download(new ChildHistoryExport($child, $histories), $fileName);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'user_id' => 'required|exists:users,id',
        ]);

        $child = Child::findOrFail($id);
        $child->update($request->only(['nama', 'user_id']));

        return redirect()->route('dashboardanak')->with('success', 'Data anak berhasil diperbarui');
    }
}
