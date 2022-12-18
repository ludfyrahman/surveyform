<?php

namespace App\Http\Controllers\BackOffice;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/**
 * model block
 */
use App\Models\Supplier;
use Illuminate\Support\Facades\Auth;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [];
        if (Auth::user()->role == 'Super Admin') {
            $data = Supplier::all();
        } else {
            $data = Supplier::where('status', 'Admin')->get();
        }


        $title = 'List Data Supplier';
        return view('pages.backoffice.supplier.index', compact('data', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $title = 'Tambah Data Supplier';
        $data = (object)[
            'nama'      => '',
            'telepon'   => '',
            'alamat'    => '',
            'status'    => '',
            'type'      => 'create',
        ];
        return view('pages.backoffice.supplier.form', compact('title', 'data'));
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
            'nama' => 'required',
            'telepon' => 'required',
            'alamat' => 'required',
        ]);

        try {
            Supplier::create([
                'nama'      => $request->nama,
                'telepon'   => $request->telepon,
                'alamat'    => $request->alamat,
                'status'    => $request->status ?? 'Aktif',
            ]);
            return redirect('supplier')->with('success', 'Berhasil menambah data!');
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
        $title = 'Edit Data Supplier';
        $data = Supplier::where('id', $id)->first();
        return view('pages.backoffice.supplier.form', compact('data', 'title'));
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
            'nama' => 'required',
            'telepon' => 'required',
            'alamat' => 'required',

        ]);
        try {
            $data = ([
                'nama'      => $request->nama,
                'telepon'   => $request->telepon,
                'alamat'    => $request->alamat,
                'status'    => $request->status ?? 'Aktif',
            ]);

            Supplier::where('id', $id)->update($data);
            return redirect('supplier')->with('success', 'Berhasil mengubah data!');
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
        Supplier::find($id)->delete();
        return redirect('supplier')->with('success', 'Berhasil mengubah data!');
    }
}
