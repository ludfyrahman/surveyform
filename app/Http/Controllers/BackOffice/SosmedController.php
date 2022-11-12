<?php

namespace App\Http\Controllers\BackOffice;

use App\Http\Controllers\Controller;
use App\Models\Sosmed;
use Illuminate\Http\Request;

class SosmedController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Sosmed::all();
        $title = 'List Data Sosial Media';
        return view('pages.backoffice.sosmed.index', compact('data', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Tambah Data Sosial Media';
        $data = (object)[
            'nama_akun'      => '',
            'platform'   => '',
            'link'    => '',
            'status'    => 'Aktif',
            'type'      => 'create',
        ];
        return view('pages.backoffice.sosmed.form', compact('title', 'data'));
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
            'nama_akun' => 'required',
            'platform' => 'required',
            'link' => 'required',
            'status' => 'required',
        ]);

        try {
            Sosmed::create([
                'nama_akun' => $request->nama_akun,
                'platform'   => $request->platform,
                'link'    => $request->link,
                'status'    => $request->status,
            ]);
            return redirect('sosmed')->with('success', 'Berhasil menambah data!');
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
        $title = 'Edit Data Sosial Media';
        $data = Sosmed::where('id', $id)->first();
        return view('pages.backoffice.sosmed.form', compact('data', 'title'));
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
            'nama_akun' => 'required',
            'platform' => 'required',
            'link' => 'required',
            'status' => 'required',
        ]);
        try {
            $data = ([
                'nama_akun'      => $request->nama_akun,
                'platform'   => $request->platform,
                'link'    => $request->link,
                'status'    => $request->status,
            ]);

            Sosmed::where('id', $id)->update($data);
            return redirect('sosmed')->with('success', 'Berhasil mengubah data!');
        } catch (\Throwable $th) {
            return back()->with('failed', 'Gagal mengubah data!');
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
        Sosmed::find($id)->delete();
        return redirect('sosmed')->with('success', 'Berhasil menghapus data!');
    }
}
