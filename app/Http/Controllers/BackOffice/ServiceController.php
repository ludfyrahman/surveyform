<?php

namespace App\Http\Controllers\BackOffice;

use App\Helper\Helper;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Models\Jasa;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Jasa::where('status', 'Aktif')->get();
        $title = 'List Layanan Jasa';
        return view('pages.backoffice.services.index', compact('data', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kode = Helper::kodeJasa();
        $data = (object)[
            'nama'      => '',
            'harga'   => '',
            'kode'    => $kode,
            'status'    => '',
            'deskripsi'    => '',
            'type'  => 'create',
        ];
        return view('pages.backoffice.services.form', compact('kode', 'data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'kode' => 'required',
            'deskripsi' => 'required',
            'harga' => 'required|numeric',
        ]);
        try {
            Jasa::create([
                'nama'      => $request->nama,
                'kode'   => $request->kode,
                'deskripsi'    => $request->deskripsi,
                'harga'    => $request->harga,
                'status'    => $request->status ?? 'Aktif',
            ]);
            return redirect('service')->with('success', 'Berhasil menambah data!');
        } catch (\Throwable $th) {
            return back()->with('failed', 'Gagal menambah data!' . $th->getMessage());
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Jasa::where('id', $id)->first();
        return view('pages.backoffice.services.form', compact('data'));
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
        $request->validate([
            'nama' => 'required',
            'kode' => 'required',
            'deskripsi' => 'required',
            'harga' => 'required|numeric',
        ]);
        try {
            Jasa::where('id', $id)->update([
                'nama'      => $request->nama,
                'kode'   => $request->kode,
                'deskripsi'    => $request->deskripsi,
                'harga'    => $request->harga,
                'status'    => $request->status ?? 'Aktif',
            ]);
            return redirect('service')->with('success', 'Berhasil mengubah data!');
        } catch (\Throwable $th) {
            return back()->with('failed', 'Gagal mengubah data!' . $th->getMessage());
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
        try {
            Jasa::where('id', $id)->update([
                'status'    => 'Nonaktif',
            ]);
            return redirect('service')->with('success', 'Berhasil menghapus data!');
        } catch (\Throwable $th) {
            return back()->with('failed', 'Gagal menghapus data!' . $th->getMessage());
        }
    }
}
