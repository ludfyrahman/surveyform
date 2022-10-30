@extends('layouts.app')

@section('content-app')
    <div class="container mt-4">
        <div class="card">
            <div class="card-header pb-0">
                <div class="d-flex justify-content-between">
                    <h4 class="card-title mg-b-0">{{$title}}</h4>
                    <a href="{{ route('purchase.create') }}" class="btn btn-sm btn-primary"><i class="mdi mdi-plus"></i> Tambah
                        Pembelian</a>

                </div>
                <p class="tx-12 tx-gray-500 mb-2">Data Pembelian</p>
                @if (session('success'))
                    <div class="alert alert-success mg-b-0" role="alert">
                        <button aria-label="Close" class="close" data-bs-dismiss="alert" type="button">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        {{ session('success') }}
                    </div>
                @endif

            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table text-md-nowrap" id="example1">
                        <thead>
                            <tr>
                                <th class="wd-15p border-bottom-0">No</th>
                                <th class="wd-20p border-bottom-0">Invoice</th>
                                <th class="wd-20p border-bottom-0">Total</th>
                                <th class="wd-20p border-bottom-0">Diskon</th>
                                <th class="wd-20p border-bottom-0">Customer</th>
                                <th class="wd-25p border-bottom-0">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->invoice }}</td>
                                    <td class="text-success text-right">{{ Helper::rupiah($item->total) }}</td>
                                    <td class="text-primary text-right">{{ Helper::rupiah($item->diskon) }}</td>
                                    <td>{{ $item->customer->nama }}</td>
                                    <td class="d-flex"><a href="{{ route('purchase.show', $item->id)}}" class="btn btn-sm btn-info me-2"> <i class="mdi mdi-book"></i>Detail</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
