@extends('layouts.app')

@section('content-app')
    <div class="container mt-4">
        <div class="card">
            <div class="card-header pb-0">
                <div class="d-flex justify-content-between">
                    <h4 class="card-title mg-b-0">Data Absensi</h4>
                    @if (count($valid) <= 0)
                        <a href="{{ url('/kehadiran/create') }}" class="btn btn-sm btn-primary"><i class="mdi mdi-plus"></i>
                            Tambah
                            Kehadiran</a>
                    @endif

                </div>
                <p class="tx-12 tx-gray-500 mb-2">Data Absensi</p>
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
                                <th class="wd-15p border-bottom-0">Tanggal</th>
                                <th class="wd-20p border-bottom-0">Jumlah Hadir</th>
                                <th class="wd-15p border-bottom-0">Jumlah Sakit</th>
                                <th class="wd-15p border-bottom-0">Jumlah Izin</th>
                                <th class="wd-25p border-bottom-0">Jumlah Tanpa Keterangan</th>
                                <th class="wd-10p border-bottom-0">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $item)
                                <tr>
                                    <td>{{ $item->tanggal }}</td>
                                    <td>{{ $item->Hadir }}</td>
                                    <td>{{ $item->Sakit }}</td>
                                    <td>{{ $item->Izin }}</td>
                                    <td>{{ $item->Alpa }}</td>
                                    <td>
                                        <a href="{{ url('/kehadiran/' . $item->tanggal ) }}"
                                            class="btn btn-sm btn-info"> <i class="far fa-eye"></i>
                                            Detail</a>

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
