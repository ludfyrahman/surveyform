<?php

namespace App\Http\Controllers\BackOffice;

use App\Http\Controllers\Controller;
use App\Models\Purchase;
use App\Models\PurchaseDetail;
use App\Models\Sale;
use App\Models\SaleDetail;
use Carbon\Carbon;
use Illuminate\Http\Request;

class FinanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = "Laporan Keuangan";
        $subtitle = "Data Pembelian dan Penjualan";
        $start = Carbon::now();
        $endWeek = Carbon::now()->subDays(7);
        $endMonth = Carbon::now()->subDays(30);
        $endYear = Carbon::now()->subDays(365);
        //query penjualan

        $summarySale = [
            "daily" => Sale::where('tanggal', $start)->sum('total'),
            "weekly" => Sale::whereBetween('tanggal', [$endWeek, $start])->sum('total'),
            "monthly" => Sale::whereBetween('tanggal', [$endMonth, $start])->sum('total'),
            "yearly" => Sale::whereBetween('tanggal', [$endYear, $start])->sum('total'),
        ];

        $tmpSale = Sale::whereBetween('tanggal', [$endMonth, $start])->orderBy('created_at', 'DESC')->get();
        $historySale = [];
        foreach ($tmpSale as $ts) {
            $ts->jenis = 'Penjualan';
            array_push($historySale, $ts);
        }
        //query pembelian
        $summaryPurchase = [
            "daily" => Purchase::where('tanggal', $start)->sum('total'),
            "weekly" => Purchase::whereBetween('tanggal', [$endWeek, $start])->sum('total'),
            "monthly" => Purchase::whereBetween('tanggal', [$endMonth, $start])->sum('total'),
            "yearly" => Purchase::whereBetween('tanggal', [$endYear, $start])->sum('total'),
        ];
        $historyPurchase = [];
        $tmpPurchase = Purchase::whereBetween('tanggal', [$endMonth, $start])->orderBy('created_at', 'DESC')->get();
        foreach ($tmpPurchase as $tp) {
            $tp->jenis = 'Pembelian';
            array_push($historySale, $tp);
        }
        // grouping dan order by created_at desc
        $data = [];
        $historySale = (object)$historySale;
        $historyPurchase = (object)$historyPurchase;
        foreach ($historySale as $hs) {

            array_push($data, $hs);
        }
        foreach ($historyPurchase as $ph) {

            array_push($data, $ph);
        }
        $tmp = collect($data);

        $data = $tmp->sortBy(function ($post) {
            return $post->created_at;
        });

        return view('pages.backoffice.finance.index', compact('title', 'subtitle', 'summarySale', 'summaryPurchase', 'data'));
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
        $title = 'Detail Penjualan';
        $subtitle = 'Detail Item Penjualan';
        $detail = [];
        if (substr($id, 0, 3) == 'TRB') {
            $data = Purchase::where('invoice', $id)->first();
            $items =  PurchaseDetail::with('service', 'product')->where('pembelian_id', $data->id)->get();
            $detail = ["data" => $data, "items" => $items,];
            return view('pages.backoffice.finance.detailPurchase', compact('title', 'subtitle', 'detail'));
        } else {
            $data = Sale::where('invoice', $id)->first();
            $items =  SaleDetail::with('service', 'product')->where('penjualan_id', $data->id)->get();
            $detail = ["data" => $data, "items" => $items,];
            return view('pages.backoffice.finance.detail', compact('title', 'subtitle', 'detail'));
        }
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
