<?php

namespace App\Http\Controllers;

use App\Models\Dudi;
use App\Models\Kelas;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    //
    public function login()
    {
        $user = Auth::user();

        if ($user->role === 'admin') {
            $totalKelas = Kelas::count();
            $totalDudi = Dudi::count();
            $totalPembimbing = User::where('role', 'pembimbing')->count();
            $totalSiswa = User::where('role', 'siswa')->count();

            return view('admin.dashboard', compact('user', 'totalKelas', 'totalDudi', 'totalPembimbing', 'totalSiswa'));
        } elseif ($user->role === 'pembimbing') {
            return view('pembimbing.dashboard', compact('user', 'totalPembimbing'));
        } elseif ($user->role === 'pembimbing') {
            return view('siswa.dashboard', compact('user'));
        } else {
            abort(403, 'Role penguna tidak dikenali');
        }
    }

}
