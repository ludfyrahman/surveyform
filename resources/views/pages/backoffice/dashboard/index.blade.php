@extends('layouts.app')

@section('content-app')
    <div class="container mt-5">
        <!-- breadcrumb -->

        <!-- row -->
        <div class="row row-sm">
            <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
                <div class="card overflow-hidden sales-card bg-primary-gradient">
                    <div class="ps-3 pt-3 pe-3 pb-2 pt-0">
                        <div class="">
                            <h6 class="mb-3 tx-12 text-white">Survey Hari ini</h6>
                        </div>
                        <div class="pb-0 mt-0">
                            <div class="d-flex">
                                <div class="">
                                    <h4 class="tx-20 fw-bold mb-1 text-white">{{ $summary->today }}</h4>
                                    <p class="mb-0 tx-12 text-white op-7">Penghitungan survey realtime</p>
                                </div>

                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
                <div class="card overflow-hidden sales-card bg-danger-gradient">
                    <div class="ps-3 pt-3 pe-3 pb-2 pt-0">
                        <div class="">
                            <h6 class="mb-3 tx-12 text-white">Survey Minggu Ini</h6>
                        </div>
                        <div class="pb-0 mt-0">
                            <div class="d-flex">
                                <div class="">
                                    <h4 class="tx-20 fw-bold mb-1 text-white">{{ $summary->week }}
                                    </h4>
                                    <p class="mb-0 tx-12 text-white op-7">Penghitungan survey realtime</p>
                                </div>

                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
                <div class="card overflow-hidden sales-card bg-success-gradient">
                    <div class="ps-3 pt-3 pe-3 pb-2 pt-0">
                        <div class="">
                            <h6 class="mb-3 tx-12 text-white">Survey Bulan Ini</h6>
                        </div>
                        <div class="pb-0 mt-0">
                            <div class="d-flex">
                                <div class="">
                                    <h4 class="tx-20 fw-bold mb-1 text-white">{{ $summary->month }}</h4>
                                    <p class="mb-0 tx-12 text-white op-7">Penghitungan survey realtime</p>
                                </div>

                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
                <div class="card overflow-hidden sales-card bg-warning-gradient">
                    <div class="ps-3 pt-3 pe-3 pb-2 pt-0">
                        <div class="">
                            <h6 class="mb-3 tx-12 text-white">Survet Tahun Ini</h6>
                        </div>
                        <div class="pb-0 mt-0">
                            <div class="d-flex">
                                <div class="">
                                    <h4 class="tx-20 fw-bold mb-1 text-white">{{ $summary->year }}
                                    </h4>
                                    <p class="mb-0 tx-12 text-white op-7">Penghitungan survey realtime</p>
                                </div>

                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        @foreach ($summary->chart as $index => $chart)
            <h4>{{ $index+1 }}. {{$chart['category']}}</h4>
            @foreach ($chart['subcategory'] as $subIndex => $subcategory)
                <h5 class="text-muted ms-2">{{ $subIndex+1 }}. {{ $subcategory['name'] }}</h5>
                <div class="row">
                    @foreach ($subcategory['child'] as $childIndex => $sub)
                    <div class="ms-4 col-md-4">
                        <p class="text-muted">{{ $childIndex+1 }}. {{ $sub['name'] }}</p>
                        <div id="chart-{{$sub['id']}}" class="ht-150"></div>
                        <div class="row sales-infomation pb-0 mb-0 mx-auto wd-100p">
                            @if($sub['answer'])
                                @foreach($sub['answer']['label'] as $indexLabel => $label)
                                <div class="col-md-6 col">
                                    <p class="mb-0 d-flex"><span class="legend bg-primary brround"></span>{{$label}}</p>
                                    <h3 class="mb-1">{{$sub['answer']['value'][$indexLabel]}}</h3>
                                </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                    @if($sub['answer'])
                        @push('script')
                        <script>
                            $('#vmap2').vectorMap({
                                map: 'usa_en',
                                showTooltip: true,
                                backgroundColor: '#fff',
                                color: '#60adff',
                                colors: {
                                    mo: '#9fceff',
                                    fl: '#60adff',
                                    or: '#409cff',
                                    ca: '#005cbf',
                                    tx: '#005cbf',
                                    wy: '#005cbf',
                                    ny: '#007bff'
                                },
                                hoverColor: '#222',
                                enableZoom: false,
                                borderWidth: 1,
                                borderColor: '#fff',
                                hoverOpacity: .85
                            });
                            /*--- Apex (#chart) ---*/
                            var options = {
                                series:{!! json_encode($sub['answer']['value']) !!},
                                chart: {
                                    width: '100%',
                                    type: 'pie',
                                },
                                labels: {!! json_encode($sub['answer']['label']) !!},
                                theme: {
                                    monochrome: {
                                        enabled: true
                                    }
                                },
                                plotOptions: {
                                    pie: {
                                        dataLabels: {
                                            offset: -5
                                        }
                                    }
                                },
                                title: {
                                    text: "Grafik Kuesioner: {{$sub['name']}}"
                                },
                                legend: {
                                    show: true
                                }
                            };
                            var chart = new ApexCharts(document.querySelector("#chart-{{$sub['id']}}"), options);
                            chart.render();
                        </script>
                        @endpush
                    @endif

                    @endforeach
                </div>

            @endforeach
        @endforeach
        <!-- /row -->

    </div>
@endsection
