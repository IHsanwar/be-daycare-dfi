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

            return response()->json(['success' => true, 'message' => 'Anak berhasil dihapus.']);
        }

            
    public function updateStatusFinal($id)
    {
        $child = Child::findOrFail($id);
        $sessionKey = 'form_data_' . $id;
        $validatedData = session($sessionKey, []);
    
        if (empty($validatedData)) {
            return redirect()->route('editStatus', ['id' => $id])->with('error', 'Data belum lengkap.');
        }
    
        $validatedData['tanggal'] = Carbon::now()->format('Y-m-d');
        $validatedData['kegiatan_outdoor'] = json_encode($validatedData['kegiatan_outdoor'] ?? []);
        $validatedData['kegiatan_indoor'] = json_encode($validatedData['kegiatan_indoor'] ?? []);
    
        $child->update($validatedData);
    
        ChildHistory::where('child_id', $child->id)
            ->whereDate('tanggal', $validatedData['tanggal'])
            ->delete();
    
        $childHistory = new ChildHistory($validatedData);
        $childHistory->child_id = $child->id;
        $childHistory->save();
    
        session()->forget($sessionKey);
    
        return redirect()->to('/success')->with('success', 'Status anak berhasil diperbarui.');
    }
    


    public function editStatus($id, $type = null)
    {
        $child = Child::findOrFail($id);
        $today = Carbon::now()->format('Y-m-d');
    
        $latestHistory = $child->histories()
            ->whereDate('tanggal', '<=', $today)
            ->latest()
            ->first();
    
        if ($latestHistory) {
            $child->fill($latestHistory->toArray());
            $child->kegiatan_outdoor = json_decode($latestHistory->kegiatan_outdoor, true) ?? [];
            $child->kegiatan_indoor = json_decode($latestHistory->kegiatan_indoor, true) ?? [];
        }
    
        $view = match (trim($type)) {
            'makan-cemilan' => 'updatestatus.updatestatusmakan',
            'buang-air' => 'updatestatus.updatestatusbuangair',
            'kegiatan' => 'updatestatus.updatestatuskegiatan',
            'kesehatan' => 'updatestatus.updatestatuskesehatan',
            default => null,
        };
        
        if ($view) {
            return view($view, compact('child'));
        } else {
            return view('editstatus', compact('child'));
        }
    }


    
    public function updateStatus(Request $request, $id, $type)
{
    $child = Child::findOrFail($id);
    $validatedData = [];

    if ($type === 'makan-cemilan') {
        $validatedData = $request->validate([
            'nama_pendamping' => 'nullable|string',
            'tanggal' => 'nullable|date',
            'makan_pagi' => 'nullable|string',
            'makan_siang' => 'nullable|string',
            'makan_sore' => 'nullable|string',
            'makan_pagi_custom' => 'nullable|string',
            'makan_siang_custom' => 'nullable|string',
            'makan_sore_custom' => 'nullable|string',
            'makanan_camilan_pagi' => 'nullable|array',
            'makanan_camilan_siang' => 'nullable|array',
            'makanan_camilan_sore' => 'nullable|array',
            'makanan_camilan_pagi_custom' => 'nullable|string',
            'makanan_camilan_siang_custom' => 'nullable|string',
            'makanan_camilan_sore_custom' => 'nullable|string',
            'susu_pagi' => 'nullable|integer',
            'air_putih_pagi' => 'nullable|integer',
            'susu_siang' => 'nullable|integer',
            'air_putih_siang' => 'nullable|integer',
            'susu_sore' => 'nullable|integer',
            'air_putih_sore' => 'nullable|integer',
        ]);

        // Gabungkan data custom
        if ($validatedData['makan_pagi'] === 'custom' && !empty($validatedData['makan_pagi_custom'])) {
            $validatedData['makan_pagi'] = $validatedData['makan_pagi_custom'];
        }
        if ($validatedData['makan_siang'] === 'custom' && !empty($validatedData['makan_siang_custom'])) {
            $validatedData['makan_siang'] = $validatedData['makan_siang_custom'];
        }
        if ($validatedData['makan_sore'] === 'custom' && !empty($validatedData['makan_sore_custom'])) {
            $validatedData['makan_sore'] = $validatedData['makan_sore_custom'];
        }

        foreach (['pagi', 'siang', 'sore'] as $waktu) {
            $key = "makanan_camilan_{$waktu}";
            $customKey = "{$key}_custom";
            if (!empty($validatedData[$customKey])) {
                $validatedData[$key][] = $validatedData[$customKey];
            }
        }

        // Update ke tabel `children`
        $child->update([
            'nama_pendamping' => $validatedData['nama_pendamping'] ?? $child->nama_pendamping,
            'tanggal' => $validatedData['tanggal'] ?? $child->tanggal,
            'makan_pagi' => $validatedData['makan_pagi'] ?? $child->makan_pagi,
            'makan_siang' => $validatedData['makan_siang'] ?? $child->makan_siang,
            'makan_sore' => $validatedData['makan_sore'] ?? $child->makan_sore,
            'makanan_camilan_pagi' => $validatedData['makanan_camilan_pagi'] ?? $child->makanan_camilan_pagi,
            'makanan_camilan_siang' => $validatedData['makanan_camilan_siang'] ?? $child->makanan_camilan_siang,
            'makanan_camilan_sore' => $validatedData['makanan_camilan_sore'] ?? $child->makanan_camilan_sore,
            'susu_pagi' => $validatedData['susu_pagi'] ?? $child->susu_pagi,
            'air_putih_pagi' => $validatedData['air_putih_pagi'] ?? $child->air_putih_pagi,
            'susu_siang' => $validatedData['susu_siang'] ?? $child->susu_siang,
            'air_putih_siang' => $validatedData['air_putih_siang'] ?? $child->air_putih_siang,
            'susu_sore' => $validatedData['susu_sore'] ?? $child->susu_sore,
            'air_putih_sore' => $validatedData['air_putih_sore'] ?? $child->air_putih_sore,
            'kegiatan_outdoor' => json_encode($validatedData['kegiatan_outdoor'] ?? []),
            'kegiatan_indoor' => json_encode($validatedData['kegiatan_indoor'] ?? []),
            'keterangan' => $validatedData['keterangan'] ?? $child->keterangan,
            'bak_pagi' => $validatedData['bak_pagi'] ?? $child->bak_pagi,
            'bab_pagi' => $validatedData['bab_pagi'] ?? $child->bab_pagi,
            'bak_siang' => $validatedData['bak_siang'] ?? $child->bak_siang,
            'bab_siang' => $validatedData['bab_siang'] ?? $child->bab_siang,
            'bak_sore' => $validatedData['bak_sore'] ?? $child->bak_sore,
            'bab_sore' => $validatedData['bab_sore'] ?? $child->bab_sore,
            'tidur_pagi' => $validatedData['tidur_pagi'] ?? $child->tidur_pagi,
            'tidur_siang' => $validatedData['tidur_siang'] ?? $child->tidur_siang,
            'tidur_sore' => $validatedData['tidur_sore'] ?? $child->tidur_sore,
            'kondisi' => $validatedData['kondisi'] ?? $child->kondisi,
            'obat_pagi' => $validatedData['obat_pagi'] ?? $child->obat_pagi,
            'obat_siang' => $validatedData['obat_siang'] ?? $child->obat_siang,
            'obat_sore' => $validatedData['obat_sore'] ?? $child->obat_sore,
            'catatan_buang_air' => $validatedData['catatan_buang_air'] ?? $child->catatan_buang_air,
        ]);
    }

    elseif ($type === 'buang-air') {
        $validatedData = $request->validate([
            'bak_pagi' => 'nullable|integer',
            'bab_pagi' => 'nullable|integer',
            'bak_siang' => 'nullable|integer',
            'bab_siang' => 'nullable|integer',
            'bak_sore' => 'nullable|integer',
            'bab_sore' => 'nullable|integer',
            'catatan_buang_air' => 'nullable|string',
        ]);

        // Misalnya ingin update jumlah total buang air ke `children`
        $child->update([
            'total_bak' => ($validatedData['bak_pagi'] ?? 0) + ($validatedData['bak_siang'] ?? 0) + ($validatedData['bak_sore'] ?? 0),
            'total_bab' => ($validatedData['bab_pagi'] ?? 0) + ($validatedData['bab_siang'] ?? 0) + ($validatedData['bab_sore'] ?? 0),
        ]);
    }

    elseif ($type === 'kegiatan') {
        $validatedData = $request->validate([
            'kegiatan_outdoor' => 'nullable|array',
            'kegiatan_indoor' => 'nullable|array',
        ]);
    }

    elseif ($type === 'kesehatan') {
        $validatedData = $request->validate([
            'kondisi' => 'nullable|in:sehat,sakit',
            'obat_pagi' => 'nullable|date_format:H:i',
            'obat_siang' => 'nullable|date_format:H:i',
            'obat_sore' => 'nullable|date_format:H:i',
            'tidur_pagi' => 'nullable|string',
            'tidur_siang' => 'nullable|string',
            'tidur_sore' => 'nullable|string',
            'keterangan' => 'nullable|string',
        ]);

        // Simpan kondisi terakhir ke tabel `children`
        $child->update([
            'kondisi' => $validatedData['kondisi'] ?? $child->kondisi,
        ]);
    }

    else {
        return redirect()->back()->withErrors(['error' => 'Tipe update tidak valid.']);
    }

    // Serialize array fields
    foreach (['makanan_camilan_pagi', 'makanan_camilan_siang', 'makanan_camilan_sore'] as $key) {
        if (isset($validatedData[$key]) && is_array($validatedData[$key])) {
            $validatedData[$key] = implode(',', $validatedData[$key]);
        }
    }

    $child->histories()->updateOrCreate(
        ['tanggal' => $validatedData['tanggal'] ?? today()],
        $validatedData
    );

    return redirect()->to('/success')->with('success', 'Data berhasil diperbarui.');
}


public function childIndex(Request $request)
{
    $search = $request->query('search');

    $anak = Anak::query()
        ->when($search, function ($query, $search) {
            return $query->where('nama_anak', 'like', '%' . $search . '%');
        })
        ->paginate(10);

    return view('dashboard.anak', compact('anak'));
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

        $latestMedicalRecord = $child->histories()->orderBy('tanggal', 'desc')->first();


        // Debugging output to log file
        Log::info('Child Info:', ['child' => $child]);
        Log::info('Latest Medical Record:', ['record' => $latestMedicalRecord]);

        return view('child_info', compact('child', 'latestMedicalRecord'));
    } catch (\Exception $e) {
        Log::error('Child Info Fetch Error: ' . $e->getMessage());

        dd($latestMedicalRecord);
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
