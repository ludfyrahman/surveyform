<?php

namespace App\Http\Controllers\BackOffice;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/**
 * model block
 */
use App\Models\Unit;
class UnitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data = Unit::all();
        $title = 'List Data Satuan';
        return view('pages.backoffice.unit.index', compact('data', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $title = 'Tambah Data Satuan';
        $data = (object)[
            'satuan'        => '',
            'akronim'       => '',
            'type'          => 'create',
        ];
        return view('pages.backoffice.unit.form', compact('title', 'data'));
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
        $request->validate([
            'satuan' => 'required',
            'akronim' => 'required',
        ]);

        try {
            Unit::create([
                'satuan' => $request->satuan,
                'akronim' => $request->akronim,
            ]);
            return redirect('unit')->with('success', 'Berhasil menambah data!');
        } catch (\Throwable $th) {
            return back()->with('failed', 'Gagal menambah data!'.$th->getMessage());
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
        //
        $data = Unit::where('id', $id)->first();
        return view('pages.backoffice.unit.form', compact('data'));
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
        $request->validate([
            'satuan' => 'required',
            'akronim' => 'required',
        ]);
        try {
            $data = ([
                'satuan' => $request->satuan,
                'akronim' => $request->akronim,
            ]);

            Unit::where('id', $id)->update($data);
            return redirect('unit')->with('success', 'Berhasil mengubah data!');
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
        //
        Unit::find($id)->destroy();
        return redirect('unit')->with('success', 'Berhasil mengubah data!');
    }
}
