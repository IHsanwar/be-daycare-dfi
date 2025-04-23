<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Child;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        $children = $user->children;
        $selectedChild = null;

        if ($request->route('child_id')) {
            $selectedChild = $children->find($request->route('child_id'));
        }

        return view('dashboard.dashboard', compact('children', 'selectedChild'));
    }

    public function adminIndex(Request $request)
{
    if (Auth::check() && Auth::user()->role == 'admin') {
        $search = $request->query('search');

        $users = User::when($search, function ($query, $search) {
            return $query->where('name', 'like', '%' . $search . '%');
        })->get();

        return view('dashboard.dashboarduser', compact('users'));
    }

    return redirect("login")->withErrors('Kamu tidak memiliki akses ke dashboard admin. Silakan login kembali.');
}


    public function childIndex(Request $request)
{
    if (Auth::check() && Auth::user()->role == 'admin') {
        $search = $request->query('search');

        $children = Child::with('user')
            ->when($search, function ($query, $search) {
                return $query->where('nama', 'like', '%' . $search . '%');
            })
            ->get();

        $users = User::where('role', 'user')->get();

        return view('dashboard.dashboardanak', compact('children', 'users'));
    }

    return redirect("login")->withErrors('Anda tidak memiliki akses ke dashboard anak. Silakan login terlebih dahulu.');
}
}
    