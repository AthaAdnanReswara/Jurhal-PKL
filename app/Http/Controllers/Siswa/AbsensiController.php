<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\Absensi;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AbsensiController extends Controller
{
    //menapilan di admin
    public function absensi()
    {
        $absensi = Absensi::with(['siswa'])->get();

        return view('admin.absensi.absensi', compact('absensi'));
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $absensis = Absensi::where('id_siswa', Auth::user()->siswa->id)->get();
        return view('siswa.absensi.index', compact('absensis'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('siswa.absensi.tambah');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'status' => 'required',
            'keterangan' => 'required_if:status,izin,sakit,libur'
        ]);

        //Ambil tanggal hari ini 
        $today = Carbon::today();

        //cegah absen 2x dalam 1 hari
        if (Absensi::where('id_siswa', Auth::user()->siswa->id)->where('tanggal', $today)->exists()) {
            return back()->with('error', 'Siswa sudah absen hari ini');
        }

        //cek absen terakhir
        $lastAbsen = Absensi::where('id_siswa', Auth::user()->siswa->id)
            ->orderBy('tanggal', 'desc')
            ->first();

        //isi otomais alpa untuk hari bolong (skip weekend)
        if ($lastAbsen) {
            //mulai dari h+1
            $nexDate = Carbon::parse($lastAbsen->tanggal)->addDAy();

            //selama < hari ini (tanggal terakhir absen)
            while ($nexDate->It($today)) {
                if (!in_array($nexDate->dayOfWeek, [Carbon::SATURDAY, Carbon::SUNDAY])) {
                    Absensi::create([
                        'id_siswa' => Auth::user()->siswa->id,
                        'tanggal' => $nexDate->toDateString(),
                        'status' => 'alpa',
                        'keterangan' => 'Tidak melakukan absensi'
                    ]);
                }

                //maju ke hari berikutnya
                $nexDate->addDay();
            }
        }
        //simpan Absen masuk
        Absensi::create([
            'id_siswa' => Auth::user()->siswa->id,
            'tanggal' => $today,
            'jam_masuk' => $request->status == 'hadir' ? now()->format('H:i:s') : null,
            'status' => $request->status,
            'keterangan' => $request->status == 'hadir' ? null : $request->keterangan,
        ]);

        return back()->with('success', 'Absensi Masuk Berhasil');
    }

    public function absenPulang($id)
    {
        $absensi = Absensi::findOrFail($id);

        if ($absensi->status != 'hadir') {
            return back()->with('error', 'Absen pulang hanya untuk siswa yang hadir.');
        }

        if($absensi->jam_pulang !== null) {
            return back()->with('error', 'sudah absen pulang sebelumnya');
        }

        $absensi->update([
            'jam_pulang'=> now()->format('H:i:s')
        ]);

        return back()->with('success','Absen pulang berhasil');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
