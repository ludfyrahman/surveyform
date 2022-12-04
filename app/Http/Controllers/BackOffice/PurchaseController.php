<?php

namespace App\Http\Controllers\BackOffice;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


use App\Models\PurchaseDetail;
use App\Models\Purchase;
use App\Models\Jasa;
use App\Models\Product;
use App\Models\Supplier;

use App\Helper\Helper;

use App\Constants\ItemType;
use App\Constants\SaleStatus;
class PurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data = Purchase::with('customer')->get();
        $title = 'List Data Pembelian';
        return view('pages.backoffice.purchase.index', compact('data', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $title = 'Tambah Data Pembelian';
        $vouchers = DB::table('voucher')->where('status', 'Aktif')->get();
        $suppliers = Supplier::all();
        $items =  PurchaseDetail::with('service', 'product')->where('status', SaleStatus::PROSES)->get();
        $data = (object)[
            'kategori'  => '',
            'type'      => 'create',
        ];
        $invoice = Helper::kodeBeli();
        return view('pages.backoffice.purchase.form', compact('title','suppliers', 'data', 'items', 'vouchers','invoice'));
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
            'item_id'   => 'required',
            'jumlah'    => 'required',
            'tipe'      => 'required',
        ]);

        try {
            DB::transaction(function () use ($request) {
                $find = null;
                $harga = 0;
                if($request->tipe == ItemType::BARANG){
                    $find = Product::find($request->item_id);
                    $harga = $find->harga_jual;
                }else{
                    $find = Jasa::find($request->item_id);
                    $harga = $find->harga;
                }
                $jumlah = $request->jumlah;

                PurchaseDetail::create([
                    'item_id'   => $request->item_id,
                    'jumlah'    => $jumlah,
                    'harga'     => $harga,
                    'sub_total' => $harga * $jumlah,
                    'tipe'      => $request->tipe,
                    'status'    => SaleStatus::PROSES,
                ]);
            });

            return back()->with('success', 'Berhasil menambah data!');
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
        $data = Purchase::where('id', $id)->first();
        $title = 'Detail Data Penjualan '.$data->invoice;

        $items =  PurchaseDetail::with('service', 'product')->where('pembelian_id', $id)->get();
        return view('pages.backoffice.purchase.detail', compact('data', 'title', 'items'));
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
        $data = Purchase::where('id', $id)->first();
        $title = 'Edit Data Pembelian';
        return view('pages.backoffice.purchase.form', compact('data', 'title'));
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
            'kategori' => 'required',
        ]);
        try {
            $data = ([
                'kategori' => $request->kategori,
            ]);

            Purchase::where('id', $id)->update($data);
            return redirect('type')->with('success', 'Berhasil mengubah data!');
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
        Purchase::find($id)->delete();
        return redirect('sale')->with('success', 'Berhasil Hapus data!');
    }

    public function destroyDetail($id){
        PurchaseDetail::find($id)->delete();
        return back()->with('success', 'Berhasil Hapus data!');
    }

    public function voucherItem($id){
        return DB::table('voucher')->where('id', $id)->first();
    }

    public function submitPurchase(Request $request){
        $request->validate([
            'invoice'       => 'required',
            'supplier_id'   => 'required',
            'total'         => 'required',
            'tipe_transaksi'=> 'required',
        ]);

        try {
            DB::transaction(function () use ($request) {

                $model = Purchase::create([
                    'supplier_id'   => $request->supplier_id,
                    'tanggal'       => date('Y-m-d H:i:s'),
                    'invoice'       => $request->invoice,
                    'total'         => $request->total,
                    'tipe_transaksi'=> $request->tipe_transaksi,
                    'status'        => SaleStatus::DONE,
                ]);



                $details = PurchaseDetail::where('status', SaleStatus::PROSES)->get();

                foreach ($details as $key => $detail) {

                    $updateDetail = PurchaseDetail::find($detail->id);
                    $updateDetail->status = SaleStatus::DONE;
                    $updateDetail->pembelian_id = $model->id;
                    $updateDetail->save();
                    /**
                     * update field stok in product
                     */
                    if($detail->tipe == ItemType::BARANG){
                        $product = Product::find($detail->item_id);
                        $product->stok = $product->stok + $detail->jumlah;
                        $product->save();
                    }

                }

            });

            return redirect('purchase')->with('success', 'Berhasil menambah data!');
        } catch (\Throwable $th) {
            return back()->with('failed', 'Gagal menambah data!'.$th->getMessage());
        }
    }

    public function itemByType($type){
        $result = null;
        if($type == ItemType::JASA){
            $result = Jasa::get(['jasa.harga AS price', 'jasa.id AS id', 'jasa.nama as nama'])->each->setAppends([]);
        }else{
            $result = Product::get(['barang.nama AS nama', 'barang.harga_jual AS price', 'barang.id as id'])->each->setAppends([]);
        }
        return Response()->json($result);
    }
}
