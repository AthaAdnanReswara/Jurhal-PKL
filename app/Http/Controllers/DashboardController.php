<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\Dudi;
use App\Models\Kegiatan;
use App\Models\Kelas;
use App\Models\Siswa;
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
            $totalSiswa = Siswa::where('pembimbing_id', Auth::user()->id)->count();
            $totalDudi = Siswa::where('pembimbing_id', Auth::user()->id)->distinct('nama_dudi')->count();

            return view('pembimbing.dashboard', compact('user', 'totalSiswa', 'totalDudi'));
        } elseif ($user->role === 'siswa') {
            if (!$user->siswa) {
                $totalKegiatan = 0;
                $totalAbsensi = 0;

                return view('siswa.dashboard', compact('user', 'totalKegiatan', 'totalAbsensi'));
            } else {
                $totalKegiatan = Kegiatan::where('id_siswa', Auth::user()->siswa->id)->count();
                $totalAbsensi = Absensi::where('id_siswa', Auth::user()->siswa->id)->count();

                return view('siswa.dashboard', compact('user', 'totalKegiatan', 'totalAbsensi'));
            }
        } else {
            abort(403, 'Role penguna tidak dikenali');
        }
    }
}
