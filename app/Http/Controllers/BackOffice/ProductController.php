<?php

namespace App\Http\Controllers\BackOffice;

use App\Helper\Helper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Type;
use App\Models\Unit;

class ProductController extends Controller
{
    public function index()
    {
        $data = Product::leftJoin('kategori', 'kategori.id', 'barang.kategori_id')
                        ->leftJoin('satuan', 'satuan.id', 'barang.satuan_id')
                        ->where('barang.status', 'Aktif')
                        ->select('kategori.kategori', 'satuan.satuan', 'barang.*')
                        ->get();
        $title = 'List Data Barang';
        return view('pages.backoffice.barang.index', compact('data', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kode = Helper::kodeProduk();
        $data = (object)[
            'nama'      => '',
            'harga_beli'   => '',
            'harga_jual'   => '',
            'expired_date'   => '',
            'kategori'   => '',
            'kategori_id'   => '',
            'satuan'   => '',
            'satuan_id'   => '',
            'kode'    => $kode,
            'status'    => '',
            'deskripsi'    => '',
            'stok'    => '',
            'type'  => 'create',
        ];
        $satuan = Unit::all();
        $kategori = Type::all();
        return view('pages.backoffice.barang.form', compact('data', 'satuan', 'kategori'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return $request;
        $request->validate([
            'nama' => 'required',
            'harga_beli' => 'required|numeric',
            'harga_jual' => 'required|numeric',
            'expired_date' => 'required',
            'kategori' => 'required',
            'satuan' => 'required',
            'deskripsi' => 'required',
            'stok' => 'required|numeric',
        ]);
        try {
            Product::create([
                'nama'      => $request->nama,
                'kode'   => $request->kode,
                'deskripsi'    => $request->deskripsi,
                'harga_beli'    => $request->harga_beli,
                'harga_jual'    => $request->harga_jual,
                'expired_date'    => $request->expired_date,
                'satuan_id'    => $request->satuan,
                'kategori_id'    => $request->kategori,
                'stok'    => $request->stok,
                'foto'    => '-',
                'status'    => $request->status ?? 'Aktif',
            ]);
            return redirect('product')->with('success', 'Berhasil menambah data!');
        } catch (\Throwable $th) {
            return $th;
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
        $data = Product::where('id', $id)->first();

        $satuan = Unit::all();
        $kategori = Type::all();
        return view('pages.backoffice.barang.form', compact('data', 'satuan', 'kategori'));
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
            'harga_beli' => 'required|numeric',
            'harga_jual' => 'required|numeric',
            'expired_date' => 'required',
            'kategori' => 'required',
            'satuan' => 'required',
            'deskripsi' => 'required',
            'stok' => 'required|numeric',
        ]);
        try {
            Product::where('id', $id)->update([
                'nama'      => $request->nama,
                'kode'   => $request->kode,
                'deskripsi'    => $request->deskripsi,
                'harga_beli'    => $request->harga_beli,
                'harga_jual'    => $request->harga_jual,
                'expired_date'    => $request->expired_date,
                'satuan_id'    => $request->satuan,
                'kategori_id'    => $request->kategori,
                'stok'    => $request->stok,
                'foto'    => '-',
                'status'    => $request->status ?? 'Aktif',
            ]);
            return redirect('product')->with('success', 'Berhasil mengubah data!');
        } catch (\Throwable $th) {
            return $th;
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
            Product::where('id', $id)->update([
                'status'    => 'Nonaktif',
            ]);
            return redirect('service')->with('success', 'Berhasil menghapus data!');
        } catch (\Throwable $th) {
            return back()->with('failed', 'Gagal menghapus data!' . $th->getMessage());
        }
    }


    public function getData($id){
        
    }
}
