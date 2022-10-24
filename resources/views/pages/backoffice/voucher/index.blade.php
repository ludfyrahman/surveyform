@extends('layouts.app')

@section('content-app')
    <div class="container mt-4">
        <div class="card">
            <div class="card-header pb-0">
                <div class="d-flex justify-content-between">
                    <h4 class="card-title mg-b-0">{{$title}}</h4>
                    <a href="{{ route('voucher.create') }}" class="btn btn-sm btn-primary"><i class="mdi mdi-plus"></i> Tambah
                        Voucher</a>

                </div>
                <p class="tx-12 tx-gray-500 mb-2">Data Voucher</p>
                @if (session('success'))
                    <div class="alert alert-success mg-b-0" role="alert">
                        <button aria-label="Close" class="close" data-bs-dismiss="alert" type="button">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        {{ session('success') }}
                    </div>
                @endif

                @if (session('failed'))
                <div class="alert alert-danger mg-b-0" role="alert">
                    <button aria-label="Close" class="close" data-bs-dismiss="alert" type="button">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    {{ session('failed') }}
                </div>
            @endif

            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table text-md-nowrap" id="example1">
                        <thead>
                            <tr>
                                <th class=" border-bottom-0">No</th>
                                <th class=" border-bottom-0">Nama Voucher</th>
                                <th class=" border-bottom-0">Tipe Potongan</th>
                                <th class=" border-bottom-0">Besaran Potongan</th>
                                <th class=" border-bottom-0">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->nama_voucher }}</td>
                                    <td>{{ $item->tipe == 'nominal'?'Nominal':'Persentase' }}</td>
                                    <td>{{$item->tipe =='nominal' ? Helper::rupiah($item->besaran) : $item->besaran.'%' }}</td>
                                    <td class="d-flex">
                                        <a href="{{ route('voucher.edit', $item->id)}}" class="btn btn-sm btn-info me-2"> <i class="mdi mdi-pencil"></i>
                                            Ubah</a>
                                        <form method="POST" action="{{route('voucher.destroy', $item->id)}}">
                                            @method('delete')
                                            @csrf
                                            <button type="submit" onclick="return confirm('apakah anda yakin ingin menghapus data ??')" class="btn btn-sm btn-danger"><i class="mdi mdi-delete"></i>
                                            Hapus
                                            </button>
                                        </form>
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
