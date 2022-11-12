<?php

namespace App\Http\Controllers\BackOffice;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

/**
 * block model
 */

use App\Models\Product;
use App\Models\PurchaseDetail;
use App\Models\SaleDetail;
use App\Constants\SaleStatus;
class StokController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data = Product::leftJoin('kategori', 'kategori.id', 'barang.kategori_id')
                        ->leftJoin('satuan', 'satuan.id', 'barang.satuan_id')
                        ->where(['barang.status' => 'Aktif'])
                        ->select('kategori.kategori', 'satuan.satuan', 'barang.*')
                        ->get();
        $title = 'List Stok Barang';
        return view('pages.backoffice.stok.index', compact('data', 'title'));
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
        //
        $data = Product::find($id);
        $title = 'Detail Stok Barang '.$data->nama;
        $purchase = PurchaseDetail::where('status', SaleStatus::DONE)->get();
        $sales = SaleDetail::where('status', SaleStatus::DONE)->get();
        $list = [];
        foreach ($purchase as $key => $pur) {
            $list[] = (object)[
                'tanggal' =>$pur->created_at,
                'tipe' => 'Pembelian',
                'jumlah' =>$pur->jumlah,
                'harga' =>$pur->harga,
            ];
        }

        foreach ($sales as $key => $sale) {
            $list[] = (object)[
                'tanggal' =>$sale->created_at,
                'tipe' => 'Penjualan',
                'jumlah' =>$sale->jumlah,
                'harga' =>$sale->harga,
            ];
        }
        $list = (object)$list;
        return view('pages.backoffice.stok.detail', compact('data', 'title', 'list'));
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
