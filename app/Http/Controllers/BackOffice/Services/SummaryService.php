<?php

namespace App\Http\Controllers\BackOffice\Services;

use App\Constants\ItemType;
use App\Models\Customer;
use App\Models\Purchase;
use App\Models\Answer;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Form;
use App\Shareds\BaseService;

class SummaryService
{
    public function __construct()
    {

    }

    public function getSummary($request){
        $date  = date('Y-m-d');
        $today = Answer::whereDate('created_at', $date)->get()->groupBy('key')->count();
        $week = 0;
        $month = Answer::whereMonth('created_at', $date)->get()->groupBy('key')->count();
        $year = Answer::whereYear('created_at', $date)->get()->groupBy('key')->count();
        $summary = Category::with('subcategory', 'subcategory.question', 'subcategory.question.answer')->get();
        $chart = null;
        foreach ($summary as $summaryKey => $s) {
            $subcategory = [];
            foreach ($s->subcategory as $subKey => $sub) {
                $questions = ['name' => $sub->name, 'child' => []];
                foreach ($sub->question as $questionKey => $question) {
                    if($question->type != 'radio-range' && $question->type !='select') {
                        continue;
                    }else{
                        $childQuestion =['name' => $question->name, 'answer' => [], 'id' => $question->id];
                        $answerChild = [];
                        foreach ($question->answer as $answerKey => $answer) {
                            $answerChild[] = $answer->answer;
                        }
                        $keyAnswer = array_count_values($answerChild);
                        $finalQuestion = $childQuestion;
                        foreach ($keyAnswer as $answerKeyIndication => $answerFinal) {
                            $finalQuestion['answer']['label'][] = "$answerKeyIndication";
                            $finalQuestion['answer']['value'][] = $answerFinal;
                        }
                        $questions['child'][] = $finalQuestion;
                    }

                }
                $subcategory[] = $questions;
            }

            $array = ['category' => $s->name, 'subcategory' => $subcategory];
            $chart[] = $array;
        }
        // dd($chart);
        return (object)[
            'today' => $today,
            'week' => $week,
            'month' => $month,
            'year' => $year,
            'chart' => $chart
        ];
    }
    public function _getSummary($request){
        $today = date('Y-m-d');
        $todayB = date('Y-m-d', strtotime('-1 day'));
        $month = date('m');
        $monthB = date('m', strtotime('-1 month'));
        /**
         * sales = penjualan
         */
        $salesAll = new Sale;
        $sales = $salesAll->whereDate('created_at', $today);
        $saletoday = $sales->sum('total');

        $salesB = $salesAll->whereDate('created_at', $todayB);
        $saletodayBefore = $salesB->sum('total');

        $salesM = $salesAll->whereMonth('created_at', $month);
        $saleMonth = $salesM->sum('total');

        $salesMB = $salesAll->whereMonth('created_at', $monthB);
        $saleMonthBefore = $salesMB->sum('total');

        $products = $sales->with('detail')->whereHas('detail', function($query){
            $query->where('tipe', ItemType::BARANG);
        })->get();
        $product = 0;
        foreach ($products as $key => $produc) {
            $product+= $produc->detail->sum('jumlah');
        }

        $services = $sales->with('detail')->whereHas('detail', function($query){
            $query->where('tipe', ItemType::JASA);
        })->get();

        $service = 0;
        foreach ($services as $key => $serv) {
            $service+= $serv->detail->sum('jumlah');
        }
        $salesChart = [];
        for ($i=0; $i <= 12 ; $i++) {
            $salesChartValue = $salesAll->with('detail')->whereHas('detail', function($query) use($i){
                $query->whereMonth('created_at', $i);
            })->withSum('detail', 'jumlah')->first();
            if($salesChartValue!=null){
                $salesChart[] = (int)$salesChartValue->detail_sum_jumlah;
            }else{
                $salesChart[] = 0;
            }
        }


        $sales = $sales->with('detail')->get();


        /**
         * purchase = pembelian
         */
        $purchaseAll = new Purchase;
        $purchase = $purchaseAll->whereDate('created_at', $today);
        $purhasetoday = $purchase->sum('total');

        $purchaseB = $purchaseAll->whereDate('created_at', $todayB);
        $purhasetodayBefore = $purchaseB->sum('total');

        $purchase = $purchase->with('detail')->get();

        $purchaseM = $purchaseAll->whereMonth('created_at', $month);
        $purchaseMonth = $purchaseM->sum('total');

        $purchaseMB = $purchaseAll->whereMonth('created_at', $monthB);
        $purchaseMonthBefore = $purchaseMB->sum('total');

        $purchaseChart = [];
        for ($i=0; $i <= 12 ; $i++) {
            $purchaseChartValue = $purchaseAll->with('detail')->whereHas('detail', function($query) use($i){
                $query->whereMonth('created_at', $i);
            })->withSum('detail', 'jumlah')->first();
            if($purchaseChartValue!=null){
                $purchaseChart[] = (int)$purchaseChartValue->detail_sum_jumlah;
            }else{
                $purchaseChart[] = 0;
            }
        }

        return (object)[
            'saleToday' => $saletoday,
            'purchaseMonth' => $purchaseMonth,
            'saleMonth' => $saleMonth,
            'purchaseToday' => $purhasetoday,

            'saleTodayBefore' => ($saletoday - $saletodayBefore) / ($saletoday == 0 ? 1: $saletoday) * 100,
            'purchaseMonthBefore' => ($purchaseMonth - $purchaseMonthBefore) / ($purchaseMonth == 0 ? 1: $purchaseMonth) * 100,
            'saleMonthBefore' => ($saleMonth - $saleMonthBefore) / ($saleMonth == 0 ? 1: $saleMonth) * 100,
            'purchaseTodayBefore' => ($purhasetoday - $purhasetodayBefore) / ($purhasetoday == 0 ? 1: $purhasetoday) * 100,


            /**
             * compare
             */
            'service' => $service,
            'product' => $product,
            /**
             * chart
             */
            'salesChart' => $salesChart,
            'purchaseChart' => $purchaseChart,

            'sales' => $salesAll->with('detail')->get(),
        ];
    }

}
