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
    </div>
@endsection
