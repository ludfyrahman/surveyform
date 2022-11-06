<?php

namespace App\Http\Controllers\BackOffice;

use App\Http\Controllers\Controller;
use App\Models\Absensi;
use App\Models\Employee;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AbsensiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $data = DB::select("
                SELECT tanggal,
                    COUNT(IF(keterangan = 'Hadir', 1, NULL)) 'Hadir',
                    COUNT(IF(keterangan = 'Sakit', 1, NULL)) 'Sakit',
                    COUNT(IF(keterangan = 'Tanpa Keterangan', 1, NULL)) 'Alpa',
                    COUNT(IF(keterangan = 'Izin', 1, NULL)) 'Izin'
                    FROM absensi GROUP BY tanggal
            ");
        $valid = Absensi::where('tanggal', Carbon::now()->locale('id')->isoFormat('YYYY-M-D'))->get();
        // return count($valid);
        return view('pages.backoffice.absensi.index', compact('data', 'valid'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = Employee::where('status', 'Aktif')->get();
        $date = Carbon::now()->locale('id')->isoFormat('dddd, DD MMMM YYYY');
        $dateVal = Carbon::now()->locale('id')->isoFormat('YYYY-M-D');


        return view('pages.backoffice.absensi.add', compact('data', 'date', 'dateVal'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            for ($i = 0; $i < count($request->kehadiran); $i++) {
                Absensi::create([
                    "pegawai_id" => $request->pegawai_id[$i],
                    "tanggal" => $request->tanggal,
                    "keterangan" => $request->kehadiran[$i],
                ]);
            }
            return redirect('kehadiran')->with('success', 'Berhasil menambah data!');
        } catch (\Throwable $th) {
            return back()->with('failed', 'Gagal menambah data!' . $th);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Absensi::leftJoin('pegawai', 'pegawai.id', 'absensi.pegawai_id')
            ->select('absensi.*', 'pegawai.nama')
            ->where('absensi.tanggal', $id)
            ->get();
        return view('pages.backoffice.absensi.edit', compact('data', 'id'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            Absensi::where('id', $request->id)->update([
                "keterangan" => $request->kehadiran,
                "updated_at" => Carbon::now(),
            ]);
            return redirect('kehadiran/' . $request->tanggal)->with('success', 'Berhasil merubah kehadiran');
        } catch (\Throwable $th) {
            return $th;
            return redirect('kehadiran/' . $request->tanggal)->with('failed', 'Gagal merubah kehadiran');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
