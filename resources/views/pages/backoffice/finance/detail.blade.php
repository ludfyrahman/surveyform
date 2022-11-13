@extends('layouts.app')

@section('content-app')
    <div class="container mt-4">

        <div class="card">
            <div class="card-header pb-0">
                <div class="d-flex justify-content-between">
                    <h4 class="card-title mg-b-0">{{ $title }}</h4>

                </div>
                <p class="tx-12 tx-gray-500 mb-2">{{ $subtitle }}</p>
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
                <div class="row mg-t-20">
                    <div class="col-md">
                        <label class="tx-gray-600">Billed To</label>
                        <div class="billed-to">
                            {{-- <h6>{{$data->customer->nama}}</h6>
                            <p>{{$data->customer->alamat}}<br> --}}
                            Tel No: 08123456993<br></p>
                        </div>
                    </div>
                    <div class="col-md">
                        <label class="tx-gray-600">Invoice Information</label>
                        <p class="invoice-info-row"><span>Invoice No</span> <span>TJ00212112022</span></p>
                        <p class="invoice-info-row"><span>Date:</span> <span>12 November 2022</span></p>
                        <p class="invoice-info-row"><span>Type:</span> <span class="badge bg-primary">Offline</span></p>
                    </div>
                </div>
                <div class="table-responsive mg-t-40">
                    <table class="table table-invoice border text-md-nowrap mb-0">
                        <thead>
                            <tr>
                                <th>#</th><th>Item</th><th>Jenis</th><th>Jumlah</th><th>Harga</th><th>Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- @php $subtotal=0; @endphp
                            @foreach ($items as $item)
                            @php
                                $subtotal +=$item->sub_total;
                            @endphp
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{ $item->tipe == \App\Constants\ItemType::BARANG ? $item->product->nama : $item->service->nama}}</td>
                                <td>{{ $item->tipe}} </td>
                                <td>{{ $item->jumlah}} </td>
                                <td class="text-right">{{ Helper::rupiah($item->harga)}} </td>
                                <td class="text-right">{{ Helper::rupiah($item->sub_total)}} </td>
                            </tr>
                            @endforeach --}}
                            <tfoot>
                                <tr>
                                    <td colspan='5' class="text-right"><h5>Subtotal</h5></td>
                                    <td class="text-right"><h5>{{Helper::rupiah(20000)}}</h5></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td colspan='5' class="text-right"><h5>Diskon</h5></td>
                                    <td class="text-right">{{Helper::rupiah(0)}}</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td colspan='5' class="text-right"><h5>Total</h5></td>
                                    <td class="text-right">
                                        <h5 id='total' class="text-primary">{{Helper::rupiah(20000)}}</h5>
                                        <input type="hidden" name='total' id='totalValue' value="{{20000}}">
                                        <input type="hidden" name='diskon' id='diskon' >
                                    </td>
                                    <td></td>
                                </tr>
                            </tfoot>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
