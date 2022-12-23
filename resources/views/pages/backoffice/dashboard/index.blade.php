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
                        <h6 class="mb-3 tx-12 text-white">Penjualan Hari ini</h6>
                    </div>
                    <div class="pb-0 mt-0">
                        <div class="d-flex">
                            <div class="">
                                <h4 class="tx-20 fw-bold mb-1 text-white">{{Helper::rupiah($summary->saleToday)}}</h4>
                                <p class="mb-0 tx-12 text-white op-7">Compared to last week</p>
                            </div>
                            <span class="float-end my-auto ms-auto">
                                <i class="fas fa-arrow-circle-{{$summary->saleTodayBefore < 0 ? 'down' : 'up'}} text-white"></i>
                                <span class="text-white op-7"> {{$summary->saleTodayBefore}}%</span>
                            </span>
                        </div>
                    </div>
                </div>
                <span id="compositeline" class="pt-1">5,9,5,6,4,12,18,14,10,15,12,5,8,5,12,5,12,10,16,12</span>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
            <div class="card overflow-hidden sales-card bg-danger-gradient">
                <div class="ps-3 pt-3 pe-3 pb-2 pt-0">
                    <div class="">
                        <h6 class="mb-3 tx-12 text-white">Pembelian Hari Ini</h6>
                    </div>
                    <div class="pb-0 mt-0">
                        <div class="d-flex">
                            <div class="">
                                <h4 class="tx-20 fw-bold mb-1 text-white">{{Helper::rupiah($summary->purchaseToday)}}</h4>
                                <p class="mb-0 tx-12 text-white op-7">Compared to last week</p>
                            </div>
                            <span class="float-end my-auto ms-auto">
                                <i class="fas fa-arrow-circle-{{$summary->purchaseTodayBefore < 0 ? 'down' :'up'}} text-white"></i>
                                <span class="text-white op-7"> {{$summary->purchaseTodayBefore}}%</span>
                            </span>
                        </div>
                    </div>
                </div>
                <span id="compositeline2" class="pt-1">3,2,4,6,12,14,8,7,14,16,12,7,8,4,3,2,2,5,6,7</span>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
            <div class="card overflow-hidden sales-card bg-success-gradient">
                <div class="ps-3 pt-3 pe-3 pb-2 pt-0">
                    <div class="">
                        <h6 class="mb-3 tx-12 text-white">Penjualan Bulan Ini</h6>
                    </div>
                    <div class="pb-0 mt-0">
                        <div class="d-flex">
                            <div class="">
                                <h4 class="tx-20 fw-bold mb-1 text-white">{{Helper::rupiah($summary->saleMonth)}}</h4>
                                <p class="mb-0 tx-12 text-white op-7">Compared to last week</p>
                            </div>
                            <span class="float-end my-auto ms-auto">
                                <i class="fas fa-arrow-circle-{{ $summary->saleMonthBefore < 0 ? 'down' : 'up'}} text-white"></i>
                                <span class="text-white op-7"> {{ $summary->saleMonthBefore }}%</span>
                            </span>
                        </div>
                    </div>
                </div>
                <span id="compositeline3" class="pt-1">5,10,5,20,22,12,15,18,20,15,8,12,22,5,10,12,22,15,16,10</span>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
            <div class="card overflow-hidden sales-card bg-warning-gradient">
                <div class="ps-3 pt-3 pe-3 pb-2 pt-0">
                    <div class="">
                        <h6 class="mb-3 tx-12 text-white">Pembelian Bulan Ini</h6>
                    </div>
                    <div class="pb-0 mt-0">
                        <div class="d-flex">
                            <div class="">
                                <h4 class="tx-20 fw-bold mb-1 text-white">{{Helper::rupiah($summary->purchaseMonth)}}</h4>
                                <p class="mb-0 tx-12 text-white op-7">Compared to last week</p>
                            </div>
                            <span class="float-end my-auto ms-auto">
                                <i class="fas fa-arrow-circle-{{$summary->purchaseMonthBefore < 0 ? 'down' : 'up'}} text-white"></i>
                                <span class="text-white op-7"> {{$summary->purchaseMonthBefore}}%</span>
                            </span>
                        </div>
                    </div>
                </div>
                <span id="compositeline4" class="pt-1">5,9,5,6,4,12,18,14,10,15,12,5,8,5,12,5,12,10,16,12</span>
            </div>
        </div>
    </div>
    <!-- row closed -->

    <!-- row opened -->
    <div class="row row-sm">
        <div class="col-md-12 col-lg-12 col-xl-7">
            <div class="card">
                <div class="card-header bg-transparent pd-b-0 pd-t-20 bd-b-0">
                    <div class="d-flex justify-content-between">
                        <h4 class="card-title mb-0">Penjualan & Pembelian</h4>
                        <i class="mdi mdi-dots-horizontal text-gray"></i>
                    </div>
                    <p class="tx-12 text-muted mb-0">Grafik menampilkan informasi penjualan dan pembelian pada toko pada tiap bulannya.</p>
                </div>
                <div class="card-body">
                    <div class="total-revenue">
                        <div>
                        <h4>
                            @php
                                $total = array_sum($summary->salesChart);
                                echo number_format($total);
                            @endphp
                        </h4>
                        <label><span class="bg-primary"></span>Penjualan</label>
                        </div>
                        <div>
                        <h4>
                            @php
                                $total = array_sum($summary->salesChart);
                                echo number_format($total);
                            @endphp
                        </h4>
                        <label><span class="bg-danger"></span>Pembelian</label>
                        </div>
                    </div>
                    <div id="bar" class="sales-bar mt-4"></div>
                </div>
            </div>
        </div>
        <div class="col-xl-5 col-md-12 col-lg-12">
            <div class="card">
                <div class="card-header pb-1">
                    <h3 class="card-title mb-2">Customer Toko</h3>
                    <p class="tx-12 mb-0 text-muted">Customer adalah individu yang membeli barang atau menggunakan jasa pada aplikasi ini.</p>
                </div>
                <div class="card-body p-0 customers mt-1">
                    <div class="list-group list-lg-group list-group-flush">
                        @foreach ($customers as $customer)

                        <div class="list-group-item list-group-item-action" href="#">
                            <div class="media mt-0">
                                <img class="avatar-lg rounded-circle me-3 my-auto" src="../../assets/img/faces/3.jpg" alt="Image description">
                                <div class="media-body">
                                    <div class="d-flex align-items-center">
                                        <div class="mt-0">
                                            <h5 class="mb-1 tx-15">{{$customer->nama}}</h5>
                                            <p class="mb-0 tx-13 text-muted">User ID: #{{$customer->id}} <span class="text-{{$customer->status == 'Aktif' ? 'success': 'danger'}} ms-2">{{$customer->status}}</span></p>
                                        </div>
                                        <span class="ms-auto wd-45p fs-16 mt-2">
                                            <div id="spark1" class="wd-100p"></div>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- row closed -->

    <!-- row opened -->
    <div class="row row-sm">
        <div class="col-xl-4 col-md-12 col-lg-6">
            <div class="card">
                <div class="card-header pb-0">
                    <h3 class="card-title mb-2">Pemesanan</h3>
                    <p class="tx-12 mb-0 text-muted">Pemesanan barang atau penggunaan jasa pada aplikasi tercantum pada grafik dibawah ini.</p>
                </div>
                <div class="card-body sales-info ot-0 pt-0 pb-0">
                    <div id="chart" class="ht-150"></div>
                    <div class="row sales-infomation pb-0 mb-0 mx-auto wd-100p">
                        <div class="col-md-6 col">
                            <p class="mb-0 d-flex"><span class="legend bg-primary brround"></span>Produk</p>
                            <h3 class="mb-1">{{$summary->product}}</h3>
                            <div class="d-flex">
                                <p class="text-muted d-none ">Last 6 months</p>
                            </div>
                        </div>
                        <div class="col-md-6 col">
                            <p class="mb-0 d-flex"><span class="legend bg-info brround"></span>Jasa</p>
                                <h3 class="mb-1">{{$summary->service}}</h3>
                            <div class="d-flex">
                                <p class="text-muted d-none">Last 6 months</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
         <div class="col-md-12 col-lg-8 col-xl-8">
            <div class="card card-table-two">
                <div class="d-flex justify-content-between">
                    <h4 class="card-title mb-1">Pendataan penjualan</h4>
                    <i class="mdi mdi-dots-horizontal text-gray"></i>
                </div>
                <span class="tx-12 tx-muted mb-3 ">ini adalah pendataan penjualan tiap transaksi diaplikasi.</span>
                <div class="table-responsive country-table">
                    <table class="table table-striped table-bordered mb-0 text-sm-nowrap text-lg-nowrap text-xl-nowrap">
                        <thead>
                            <tr>
                                <th class="wd-lg-25p">ID</th>
                                <th class="wd-lg-25p tx-right">Jumlah Item</th>
                                <th class="wd-lg-25p tx-right">Penjualan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($summary->sales as $sale)

                            <tr>
                                <td>{{$sale->invoice}}</td>
                                <td class="tx-right tx-medium tx-inverse"><span class="badge bg-primary">{{$sale->detail->count()}}</span></td>
                                <td class="tx-right tx-medium tx-inverse">{{Helper::rupiah($sale->total)}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- row close -->
    <!-- /row -->
</div>
@push('script')
<script>
    /* Apexcharts (#bar) */
	var optionsBar = {
	  chart: {
		height: 249,
		type: 'bar',
		toolbar: {
		   show: false,
		},
		fontFamily: 'Nunito, sans-serif'
	  },
	 colors: ["#036fe7", '#f93a5a'],
	 plotOptions: {
				bar: {
				  dataLabels: {
					enabled: false
				  },
				  columnWidth: '42%',
				  endingShape: 'rounded',
				}
			},
	  dataLabels: {
		  enabled: false
	  },
	  stroke: {
		  show: true,
		  width: 2,
		  endingShape: 'rounded',
		  colors: ['transparent'],
	  },
	  responsive: [{
		  breakpoint: 576,
		  options: {
			   stroke: {
			  show: true,
			  width: 1,
			  endingShape: 'rounded',
			  colors: ['transparent'],
			},
		  },


	  }],
	   series: [{
		  name: 'Penjualan',
		  data: @json($summary->salesChart)
	  }, {
		  name: 'Pembelian',
		  data: @json($summary->purchaseChart)
	  },],
	  xaxis: {
		  categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct'],
	  },
	  fill: {
		  opacity: 1
	  },
	  legend: {
		show: false,
		floating: true,
		position: 'top',
		horizontalAlign: 'left',
		// offsetY: -36

	  },
	  title: {
	    text: 'Grafik Pembelian dan Penjualan toko',
	    align: 'left',
	  },
	  tooltip: {
		  y: {
			  formatter: function (val) {
				  return " " + val + " Item"
			  }
		  }
	  }
	}
	new ApexCharts(document.querySelector('#bar'), optionsBar).render();

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
        series: [{{$summary->product}}, {{$summary->service}}],
        chart: {
        width: '100%',
        type: 'pie',
    },
    labels: ["Produk", "Jasa"],
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
        text: "Grafik Perbandingan Penjualan"
    },
    legend: {
        show: true
    }
    };

    var chart = new ApexCharts(document.querySelector("#chart"), options);
    chart.render();
	/*--- Apex (#chart)closed ---*/
</script>
@endpush
@endsection
