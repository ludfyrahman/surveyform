@extends('layouts.app')

@section('content-app')
    <div class="container mt-4">
        <div class="card card-primary">
            <div class="card-header pb-0">
                <div class="d-flex justify-content-between">
                    <h4 class="card-title mg-b-0">Data Kuesioner</h4>
                </div>
            </div>
            <div class="card-body">
                @php
                    $criteria = ['Sangat Rendah', 'Rendah', 'Cukup', 'Tinggi', 'Sangat Tinggi'];
                    $likert = ['Sangat Tidak Setuju', 'Tidak Setuju', 'Netral', 'Setuju', 'Sangat Setuju'];
                    $likertValue = [1,2,3,4,5];
                    $worthinessLabel = ['Sangat Tidak Layak', 'Tidak Layak', 'Cukup', 'Layak', 'Sangat Layak'];
                    $worthinessValue = [21,40,60,80,101];
                    $meritValue = [0,0.25,0.5,0.75,1];
                    $minimumCriteria = [0.2,0.4,0.7,0.9,1];
                    $final = null;
                @endphp
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Responden</th>
                                @foreach ($data[2] as $index => $d)
                                    <th>{{ $d->name }}</th>
                                @endforeach
                                <td>Total</td>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $totalAll = 0;
                            @endphp
                            @foreach ($data[1] as $key => $d)
                                <tr>
                                    <td>{{ $key }}</td>
                                    @php
                                        $total = 0;
                                        $count = count($d);
                                    @endphp
                                    @foreach ($d as $dd)
                                        <td>{{ $dd->answer }}</td>
                                        @php
                                            $total += $dd->answer;
                                        @endphp
                                    @endforeach
                                    @if($count < count($data[2]))
                                        @for ($i = 0; $i < count($data[2]) - $count; $i++)
                                            <td>0</td>
                                        @endfor
                                    @endif
                                    <td>{{ $total }}</td>
                                    @php
                                        $totalAll += $total;
                                    @endphp
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot class="bg-primary">
                            <tr>
                                <td>Total</td>
                                @foreach ($data[3]->toArray() as $index => $d)
                                @php
                                    $sum = array_sum(array_column($d, 'answer'));
                                @endphp
                                <td>{{$sum}}</td>
                                @endforeach
                                <td>{{$totalAll}}</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
        <div class="card card-danger mt-2">
            <div class="card-header pb-0">
                <div class="d-flex justify-content-between">
                    <h4 class="card-title mg-b-0">Rekapitulasi</h4>
                </div>
            </div>
            <div class="card-body row">
                @foreach ($data[0] as $key => $d)
                    <div class="col-md-6">
                        <h5>{{$key+1}} {{$d->name}}</h5>
                        <div class="table-responsive">
                            <table class="table table-sriped">
                                <thead>
                                    <tr>
                                        <th>Responden</th>
                                        @php
                                            $form = Helper::result_form(2)->where('sub_category_id', $d->id)->get();
                                        @endphp
                                        @foreach ($form as $f)
                                            <th>{{$f->name}}</th>
                                        @endforeach
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data[1] as $key => $child)
                                    <tr>
                                        <td>{{$key}}</td>
                                        @php $countQuestion = 0; $total = 0; @endphp
                                        @foreach ($child as $dd)
                                            @if($dd->form->sub_category_id == $d->id)
                                                <td>{{$dd->answer}}</td>
                                                @php $countQuestion++;$total += $dd->answer; @endphp
                                            @endif
                                        @endforeach
                                        @if ($countQuestion < count($form))
                                            @for ($i = 0; $i < count($form) - $countQuestion; $i++)
                                                <td>0</td>
                                            @endfor
                                        @endif
                                        <td>
                                            {{$total}}
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="card card-warning mt-2">
            <div class="card-header pb-0">
                <div class="d-flex justify-content-between">
                    <h4 class="card-title mg-b-0">Validitas</h4>
                </div>
            </div>
            <div class="card-body row">
                @foreach ($data[0] as $key => $d)
                        @foreach ($d->question as $question)
                        <div class="col-md-6">
                            <h5>{{$d->name}}</h5>
                            <p class="text-muted">{{$question->name}}</p>
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Responden</th>
                                            <th>X</th>
                                            <th>Y</th>
                                            <th>XY</th>
                                            <th>X2</th>
                                            <th>Y2</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $sumX = 0;
                                            $sumY = 0;
                                            $sumXY = 0;
                                            $sumX2 = 0;
                                            $sumY2 = 0;
                                        @endphp
                                        @foreach ($data[1] as $key => $child)
                                        <tr>
                                            <td>{{$key}}</td>
                                            <td>
                                                    @php
                                                    $x = 0;
                                                        $filter = $child->filter(function ($value, $key) use ($question) {
                                                            return $value->form_id == $question->id;
                                                        });
                                                        $reset = array_values($filter->toArray());
                                                    @endphp
                                                @if (isset($reset[0]))
                                                    @php
                                                        $x = $reset[0]['answer'] ?? 0;
                                                    @endphp
                                                @endif
                                                {{$x}}
                                            </td>
                                            <td>
                                                @php $total = 0;@endphp
                                                @foreach ($child as $dd)
                                                    @if($dd->form->sub_category_id == $d->id)
                                                        @php $countQuestion++;$total += $dd->answer; @endphp
                                                    @endif
                                                @endforeach
                                                {{$total}}
                                            </td>
                                            <td>{{$x * $total}}</td>
                                            <td>{{$x**2}}</td>
                                            <td>{{$total**2}}</td>

                                            @php
                                                $sumX += $x;
                                                $sumY += $total;
                                                $sumXY += $x * $total;
                                                $sumX2 += $x**2;
                                                $sumY2 += $total**2;
                                            @endphp
                                        </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td>𝚺</td>
                                            <td>{{$sumX}}</td>
                                            <td>{{$sumY}}</td>
                                            <td>{{$sumXY}}</td>
                                            <td>{{$sumX2}}</td>
                                            <td>{{$sumY2}}</td>
                                        </tr>
                                        <tr>
                                            <td>(Total)2</td>
                                            <td>{{$sumX**2}}</td>
                                            <td>{{$sumY**2}}</td>
                                            <td>{{$sumXY**2}}</td>
                                            <td>{{$sumX2**2}}</td>
                                            <td>{{$sumY2**2}}</td>
                                        </tr>
                                    @php
                                        $allData = count($data[1]);
                                        $division = sqrt(($allData * $sumX2 - pow($sumX, 2)) * ($allData * $sumY2 - pow($sumY, 2)));
                                        $top = (($allData * $sumXY) - ($sumX * $sumY));
                                        $result = $top / ($division > 0 ? $division : 1);
                                    @endphp
                                        <tr class="bg-primary">
                                            <td colspan="6">r = {{$result}}</td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                        @endforeach
                @endforeach
            </div>
        </div>
        <div class="card card-danger mt-2">
            <div class="card-header pb-0">
                <div class="d-flex justify-content-between">
                    <h4 class="card-title mg-b-0">Reliabilitas</h4>
                </div>
            </div>
            <div class="card-body row">
                @php
                    $CategoryResult = [];
                @endphp
                @foreach ($data[0] as $key => $d)
                    <div class="col-md-6">
                        <h5>{{$key+1}} {{$d->name}}</h5>
                        <div class="table-responsive">
                            <table class="table table-sriped">
                                <thead>
                                    <tr>
                                        <th>Responden</th>
                                        @php
                                            $form = Helper::result_form(2)->where('sub_category_id', $d->id)->get();
                                        @endphp
                                        @foreach ($form as $f)
                                            <th>{{$f->name}}</th>
                                        @endforeach
                                        <th>Total</th>
                                        <th>Kuadrat Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $bottomTotal = [];
                                        $bottomTotalSquare = [];
                                        $totalAll = 0;
                                        $totalPowAll = 0;
                                    @endphp
                                    @foreach ($data[1] as $key => $child)
                                    <tr>
                                        <td>{{$key}}</td>
                                        @php $countQuestion = 0; $total = 0; @endphp
                                        @foreach ($child as $dd)
                                            @if($dd->form->sub_category_id == $d->id)
                                                <td>{{$dd->answer}}</td>
                                                @php $countQuestion++;$total += $dd->answer;
                                                if(isset($bottomTotal[$dd->form->id])){
                                                    $bottomTotal[$dd->form->id] += $dd->answer;
                                                    $bottomTotalSquare[$dd->form->id] += $dd->answer * $dd->answer;
                                                }else{
                                                    $bottomTotal[$dd->form->id] = $dd->answer;
                                                    $bottomTotalSquare[$dd->form->id] = $dd->answer * $dd->answer;
                                                }

                                                @endphp
                                            @endif
                                        @endforeach
                                        @if ($countQuestion < count($form))
                                            @for ($i = 0; $i < count($form) - $countQuestion; $i++)
                                                <td>0</td>
                                            @endfor
                                        @endif
                                        <td>
                                            {{$total}}
                                        </td>
                                        <td>{{$total**2}}</td>
                                        @php
                                            $totalAll +=$total;
                                            $totalPowAll +=$total**2;
                                        @endphp
                                    </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td>
                                            Total
                                        </td>
                                        @foreach ($form as $f)
                                            <td>{{$bottomTotal[$f->id] ?? 0}}</td>
                                        @endforeach
                                        <td>{{$totalAll}}</td>
                                        <td>{{$totalPowAll}}</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Sigma Total
                                        </td>
                                        @foreach ($form as $f)
                                            <td>{{$bottomTotalSquare[$f->id] ?? 0}}</td>
                                        @endforeach
                                    </tr>
                                    <tr>
                                        <td>
                                            N
                                        </td>
                                        <td>{{count($data[1])}}</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Varian
                                        </td>
                                        @php
                                            $varianceSum = 0;
                                        @endphp
                                        @foreach ($form as $f)
                                        @php
                                            // calculate variance
                                            $variance = (($bottomTotalSquare[$f->id] ?? 0) - (($bottomTotal[$f->id] ?? 0)**2 / count($data[1])) )/ count($data[1]);
                                            $varianceSum += $variance;
                                        @endphp
                                            <td>{{$variance}} </td>
                                        @endforeach
                                    </tr>
                                    <tr>
                                        <td>
                                            Jumlah Varian
                                        </td>
                                        <td>
                                            {{$varianceSum}}
                                        </td>
                                    </tr>
                                    @php
                                        $varianceTotal = ($totalPowAll - (($totalAll**2) / count($data[1]))) / count($data[1]);
                                    @endphp
                                    <tr>
                                        <td>
                                            Total Varian
                                        </td>
                                        <td>
                                            {{$varianceTotal}}
                                        </td>
                                    </tr>
                                    @php
                                        // calculate r11
                                        $nTotal = $form->count() == 1 ? 2 : $form->count();
                                        $r11Top = (1 - ($varianceSum / $varianceTotal));
                                        $r11 = ($nTotal / ($nTotal - 1)) * $r11Top;
                                        $result = null;


                                        foreach ($criteria as $key => $cri) {
                                            if($r11 < $minimumCriteria[$key]){
                                                $result = $cri;
                                                break;
                                            }
                                        }
                                        $CategoryResult[] = ['name' => $d->name, 'result' => $result, 'ca' => $r11];
                                    @endphp
                                    <tr>
                                        <td>
                                            N Pernyataan
                                        </td>
                                        <td>
                                            {{$nTotal ?? '-'}}
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            R11
                                        </td>
                                        <td>
                                            {{$r11}}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Kriteria
                                        </td>
                                        <td>

                                            {{$result}}
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                @endforeach

                <h4>Kesimpulan Reliabilitas</h4>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>NO</th><th>Variabel</th><th>Cronbach's Alpha</th><th>N</th><th>Kriteria</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tbody>
                            @foreach ($CategoryResult as $category)
                                <tr>
                                    <td>{{$loop->iteration }}</td>
                                    <td>{{$category['name']}}</td>
                                    <td>{{number_format($category['ca'], 2)}}</td>
                                    <td>{{$category['name']}}</td>
                                    <td>{{$category['result']}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card card-warning mt-2">
            <div class="card-header pb-0">
                <div class="d-flex justify-content-between">
                    <h4 class="card-title mg-b-0">Hasil</h4>
                </div>
            </div>
            <div class="card-body row">
                @foreach ($data[0] as $key => $d)
                <h5>{{$d->name}}</h5>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th rowspan="2">No</th><th rowspan="2">Pertanyaan</th><th colspan="{{count($likert)}}" class="text-center">Skala Likert</th><th rowspan="2">Total</th>
                        </tr>
                        <tr>
                            @foreach ($likert as $lik)
                            <th>{{$lik}}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $likertCount = [];
                        @endphp
                        @foreach ($d->question as $question)
                        @php
                            $totalByQuestion = 0;
                        @endphp
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$question->name}}</td>
                                @foreach ($likertValue as $lik)
                                @php
                                    $countAnswer = $question->where('sub_category_id', $d->id)->whereHas('answer', function ($query) use ($lik, $question, $d) {
                                        $query->where('answer', $lik)->where('form_id', $question->id);
                                    })->count();
                                    $totalByQuestion += $countAnswer;
                                    if(isset($likertCount[$lik])){
                                        $likertCount[$lik] += $countAnswer;
                                    }else{
                                        $likertCount[$lik] = $countAnswer;
                                    }
                                @endphp
                                <th>{{$countAnswer}}</th>
                                @endforeach
                                <th>{{$totalByQuestion}}</th>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="2">Frekwensi</td>
                            @foreach ($likertCount as $lik)
                                <td>{{$lik}}</td>
                            @endforeach
                            <td>{{array_sum($likertCount)}}</td>
                        </tr>
                        <tr>
                            <td colspan="2">Skor</td>
                            @php
                                $totalScore = 0;
                                $presentaseTotal = [];
                                $meritTotal = [];
                            @endphp
                            @foreach ($likertCount as $key => $lik)
                                @php
                                    $totalScore += $key * $lik;
                                    $presentaseTotal[] = number_format(($lik / array_sum($likertCount)) * 100, 2);
                                    $meritTotal[] = ($meritValue[$key - 1] * $lik) / count($d->question);
                                @endphp
                                <td>{{$key * $lik}}</td>
                            @endforeach
                            <td>{{$totalScore}}</td>
                        </tr>
                        <tr>
                            <td colspan="2">Presentase</td>
                            @foreach ($presentaseTotal as $key => $pres)
                                <td>{{$pres}}%</td>
                            @endforeach
                            <td>{{array_sum($presentaseTotal)}}</td>
                        </tr>
                        <tr>
                            <td colspan="2">Merit</td>
                            @foreach ($meritTotal as $key => $merit)
                                <td>{{ $merit }}</td>
                            @endforeach
                            <td>{{array_sum($meritTotal)}}</td>
                        </tr>
                        <tr class="bg-primary">
                            <td colspan="2">Skor Ideal</td>
                            <td colspan="6">{{$likertValue[4] * array_sum($likertCount)}}</td>
                        </tr>
                        @php
                            $usability = array_sum($meritTotal) / count($data[1]);
                            $kelayakan = $totalScore / ($totalScore * $likertValue[4]) * 100;
                        @endphp
                        <tr class="bg-primary">
                            <td  colspan="2">Kelayakan</td>
                            <td colspan="6">{{$kelayakan}}% -
                                @foreach ($worthinessLabel as $key => $worth)
                                    @if($kelayakan < $worthinessValue[$key])
                                        @php
                                            $final = $worth;
                                            break;
                                        @endphp
                                    @endif
                                @endforeach

                                {{$final}}
                            </td>
                        </tr>

                        <tr class="bg-primary">
                            <td  colspan="2">Usability</td>
                            <td colspan="6">{{$usability}}</td>
                        </tr>

                    </tfoot>
                </table>
                @endforeach
            </div>
        </div>

    </div>
@endsection
