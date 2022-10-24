<?php

namespace App\Http\Controllers\BackOffice;

use App\Http\Controllers\Controller;
use App\Models\Voucher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VoucherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [];
        if (Auth::user()->role == 'Owner' ||Auth::user()->role == 'Pegawai' ) {
            $data = Voucher::where('status', 'Aktif')->get();
        } else {
            $data = Voucher::all();
        }

        $title = 'LIST DATA VOUCHER';
        return view('pages.backoffice.voucher.index', compact('data', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = (object)[
            'nama_voucher' => '',
            'tipe' => '',
            'status' => '',
            'besaran' => '',
            'type'  => 'create',
        ];
        return view('pages.backoffice.voucher.form', compact('data'));
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
            'nama_voucher' => 'required',
            'besaran' => 'required|numeric',
            'tipe' => 'required',
        ]);
        try {
            Voucher::create([
                'nama_voucher' => $request->nama_voucher,
                'besaran' => $request->besaran,
                'tipe' => $request->tipe,
                'status' => $request->status ?? "Aktif",
            ]);
            return redirect('voucher')->with('success', 'Berhasil menambah data');
        } catch (\Throwable $th) {
            return back()->with('failed', 'Gagal menambah data');
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
        $data = Voucher::where('id', $id)->first();
        return view('pages.backoffice.voucher.form', compact('data'));
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
            'nama_voucher' => 'required',
            'besaran' => 'required|numeric',
            'tipe' => 'required',
        ]);
        try {
            Voucher::where('id', $id)->update([
                'nama_voucher' => $request->nama_voucher,
                'besaran' => $request->besaran,
                'tipe' => $request->tipe,
                'status' => $request->status ?? "Aktif",
            ]);
            return redirect('voucher')->with('success', 'Berhasil mengubah data');
        } catch (\Throwable $th) {
            return back()->with('failed', 'Gagal mengubah data');
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
            Voucher::where('id', $id)->update(['status'=>'Nonaktif']);
            return redirect('voucher')->with('success', 'Berhasil mengahpus data');
        } catch (\Throwable $th) {
            return redirect('voucher')->with('failed', 'Gagal menghapus data');
        }
    }
}
