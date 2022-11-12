<?php

namespace App\Http\Controllers\BackOffice;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;


use App\Models\SaleDetail;
use App\Models\Sale;
use App\Models\Jasa;
use App\Models\Product;
use App\Models\Customer;

use App\Helper\Helper;

use App\Constants\ItemType;
use App\Constants\SaleStatus;
class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data = Sale::with('customer')->get();
        $title = 'List Data Penjualan';
        return view('pages.backoffice.sale.index', compact('data', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $title = 'Tambah Data Penjualan';
        $vouchers = DB::table('voucher')->where('status', 'Aktif')->get();
        $customers = Customer::all();
        $items =  SaleDetail::with('service', 'product')->where('status', SaleStatus::PROSES)->get();
        $data = (object)[
            'kategori'  => '',
            'type'      => 'create',
        ];
        $invoice = Helper::kodeJual();
        return view('pages.backoffice.sale.form', compact('title','customers', 'data', 'items', 'vouchers','invoice'));
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
                    if($find->stok < $request->jumlah){
                        return back()->with('failed', 'jumlah pembelian melebihi stok yang tersedia');
                    }
                    $harga = $find->harga_jual;
                }else{
                    $find = Jasa::find($request->item_id);
                    $harga = $find->harga;
                }
                $jumlah = $request->jumlah;

                SaleDetail::create([
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
        $data = Sale::where('id', $id)->first();
        $title = 'Detail Data Penjualan '.$data->invoice;

        $items =  SaleDetail::with('service', 'product')->where('penjualan_id', $id)->get();
        return view('pages.backoffice.sale.detail', compact('data', 'title', 'items'));
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
        $data = Sale::where('id', $id)->first();
        $title = 'Edit Data Penjualan';
        return view('pages.backoffice.sale.form', compact('data', 'title'));
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

            Sale::where('id', $id)->update($data);
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
        Sale::find($id)->delete();
        return redirect('sale')->with('success', 'Berhasil Hapus data!');
    }

    public function destroyDetail($id){
        SaleDetail::find($id)->delete();
        return back()->with('success', 'Berhasil Hapus data!');
    }

    public function voucherItem($id){
        return DB::table('voucher')->where('id', $id)->first();
    }

    public function submitOrder(Request $request){
        $request->validate([
            'invoice'       => 'required',
            'customer_id'   => 'required',
            'total'         => 'required',
            'diskon'        => 'required',
            'tipe_transaksi'=> 'required',
        ]);

        try {
            DB::transaction(function () use ($request) {
                $model = Sale::create([
                    'customer_id'   => $request->customer_id,
                    'invoice'       => $request->invoice,
                    'total'         => $request->total,
                    'diskon'        => $request->diskon,
                    'tipe_transaksi'=> $request->tipe_transaksi,
                    'status'        => SaleStatus::DONE,
                    'tanggal'       => date('Y-m-d H:i:s'),
                ]);


                // $detail = SaleDetail::where('status', SaleStatus::PROSES)->update(['status' => SaleStatus::DONE, 'penjualan_id' => $model->id]);
                $details = SaleDetail::where('status', SaleStatus::PROSES)->get();
                foreach ($details as $key => $detail) {
                    $updateDetail = SaleDetail::find($detail->id)->update(['status' => SaleStatus::DONE, 'pembelian_id' => $model->id]);
                    /**
                     * update field stok in product
                     */
                    if($detail->tipe == ItemType::BARANG){
                        $product = Product::find($detail->item_id);
                        if($product->stok < 1){
                            return back()->with('failed', 'stok tidak valid silahkan tambah stok terlebih dahulu');
                        }
                        $product->stok = $product->stok - $detail->jumlah;
                        $product->save();
                    }

                }
            });

            return redirect('sale')->with('success', 'Berhasil menambah data!');
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
