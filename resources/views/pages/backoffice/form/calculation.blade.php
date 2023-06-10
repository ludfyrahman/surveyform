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
        <div class="card card-primary mt-2">
            <div class="card-header pb-0">
                <div class="d-flex justify-content-between">
                    <h4 class="card-title mg-b-0">Validitas</h4>
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
    </div>
@endsection
