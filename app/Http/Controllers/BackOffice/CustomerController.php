<?php

namespace App\Http\Controllers\BackOffice;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Customer::all();
        $title = 'List Data Pelanggan';
        return view('pages.backoffice.customer.index', compact('data', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Tambah Data Pelanggan';
        $data = (object)[
            'nama'      => '',
            'telepon'   => '',
            'alamat'    => '',
            'status'    => '',
            'instansi'    => '',
            'telepon_instansi'    => '',
            'type'  => 'create',
        ];
        return view('pages.backoffice.customer.form', compact('data', 'title'));
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
            'status' => 'required',
        ]);

        try {
            Customer::create([
                'nama'      => $request->nama,
                'telepon'   => $request->telepon,
                'alamat'    => $request->alamat,
                'instansi'    => $request->instansi ?? '-',
                'telepon_instansi'    => $request->telepon_instansi ?? '-',
                'status'    => $request->status,
            ]);
            return redirect('customer')->with('success', 'Berhasil menambah data!');
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
        $data = Customer::where('id', $id)->first();
        return view('pages.backoffice.customer.form', compact('data'));
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
            'telepon' => 'required',
            'alamat' => 'required',
            'status' => 'required',
        ]);
        try {
            $data = ([
                'nama'      => $request->nama,
                'telepon'   => $request->telepon,
                'instansi'      => $request->instansi ?? '-',
                'telepon_instansi'   => $request->telepon_instansi ?? '-',
                'alamat'    => $request->alamat,
                'status'    => $request->status,
            ]);

            Customer::where('id', $id)->update($data);
            return redirect('customer')->with('success', 'Berhasil mengubah data!');
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
        Customer::find($id)->delete();
        return redirect('customer')->with('success', 'Berhasil mengubah data!');
    }
}
