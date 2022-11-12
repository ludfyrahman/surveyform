@extends('layouts.app')

@section('content-app')
    <div class="container mt-4">
        <div class="card">
            <div class="card-header pb-0">
                <div class="d-flex justify-content-between">
                    <h4 class="card-title mg-b-0">{{$title}}</h4>

                </div>
                <p class="tx-12 tx-gray-500 mb-2">History Stok Barang {{ $data->nama }}</p>
                @if (session('success'))
                    <div class="alert alert-success mg-b-0" role="alert">
                        <button aria-label="Close" class="close" data-bs-dismiss="alert" type="button">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        {{ session('success') }}
                    </div>
                @endif
                <a href="{{ route('stok.index') }}" class="btn btn-info float-end">Kembali</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table text-md-nowrap" id="example1">
                        <thead>
                            <tr>
                                <th class=" border-bottom-0">No</th>
                                <th class=" border-bottom-0">Harga</th>
                                <th class=" border-bottom-0">Jumlah</th>
                                <th class=" border-bottom-0">Tipe</th>
                                <th class=" border-bottom-0">Tanggal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $penjualan = 0;
                                $jumlahPenjualan = 0;
                                $pembelian = 0;
                                $jumlahPembelian = 0;
                            @endphp
                            @foreach ($list as $item)
                            @php
                                if($item->tipe == 'Pembelian')
                                    $penjualan += $item->harga; $jumlahPembelian = $item->jumlah;
                                if($item->tipe == 'Penjualan')
                                    $pembelian += $item->harga; $jumlahPenjualan = $item->jumlah;
                            @endphp
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ Helper::rupiah($item->harga) }}</td>
                                    <td>{{ $item->jumlah }}</td>
                                    <td><span class="badge {{ $item->tipe == 'Pembelian' ? 'bg-primary' : 'bg-warning' }}">{{ $item->tipe }}</span></td>
                                    <td>{{ $item->tanggal }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="row text-center">
                        <div class="col-md-6">
                            <h4>Pembelian</h4>
                            <h3 class="text-primary">{{Helper::rupiah($pembelian)}} <span class="badge bg-primary">{{$jumlahPembelian}} Barang</span></h3>
                        </div>
                        <div class="col-md-6">
                            <h4>Penjualan</h4>
                            <h3 class="text-warning">{{Helper::rupiah($penjualan)}} <span class="badge bg-warning">{{$jumlahPembelian}} Barang</span></h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
