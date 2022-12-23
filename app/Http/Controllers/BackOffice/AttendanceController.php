<?php

namespace App\Http\Controllers\BackOffice;

use App\Http\Controllers\Controller;
use App\Models\Absensi;
use Illuminate\Http\Request;
use App\Models\Employee;
use Illuminate\Support\Facades\DB;

class AttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $title = "Laporan Kehadiran Karyawan";
        $subtitle = "Data Pembelian dan Penjualan";
        $data = [];
        if (!empty($request->start) || !empty($request->end)) {
            $data = DB::select("SELECT absensi.pegawai_id, pegawai.nama,
            COUNT(IF(absensi.keterangan = 'Hadir', 1, NULL)) 'Hadir',
            COUNT(IF(absensi.keterangan = 'Sakit', 1, NULL)) 'Sakit',
            COUNT(IF(absensi.keterangan = 'Tanpa Keterangan', 1, NULL)) 'Alpa',
            COUNT(IF(absensi.keterangan = 'Izin', 1, NULL)) 'Izin'
            FROM absensi JOIN pegawai ON absensi.pegawai_id=pegawai.id
            WHERE (tanggal BETWEEN $request->start AND $request->end)
            GROUP BY absensi.pegawai_id");
        } else {
            $data = DB::select("SELECT absensi.pegawai_id, pegawai.nama,
            COUNT(IF(absensi.keterangan = 'Hadir', 1, NULL)) 'Hadir',
            COUNT(IF(absensi.keterangan = 'Sakit', 1, NULL)) 'Sakit',
            COUNT(IF(absensi.keterangan = 'Tanpa Keterangan', 1, NULL)) 'Alpa',
            COUNT(IF(absensi.keterangan = 'Izin', 1, NULL)) 'Izin'
            FROM absensi JOIN pegawai ON absensi.pegawai_id=pegawai.id
            GROUP BY absensi.pegawai_id");
        }


        // return $data;
        return view('pages.backoffice.attendance.index', compact('title', 'subtitle', 'data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $title = "Detail Kehadiran Karyawan";
        $subtitle = "Data Kehadiran Karyawan";
        $data = Absensi::where('pegawai_id', $id)->get();
        $employee = Employee::where('id', $id)->first();
        return view('pages.backoffice.attendance.detail', compact('title', 'subtitle', 'data', 'employee'));
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
        //
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
