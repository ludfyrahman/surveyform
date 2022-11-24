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
                <h4>Informasi Karyawan </h4>
                <table class="table table-striped mt-3">
                    <tr>
                        <td>Nama</td><td>{{$employee->nama}}</td>
                    </tr>
                    <tr>
                        <td>Telepon</td><td>{{$employee->telepon}}</td>
                    </tr>
                    <tr>
                        <td>Alamat</td><td>{{$employee->alamat}}</td>
                    </tr>


                </table>
                <h4>Informasi Kehadiran </h4>
                <div class="table-responsive">
                    <table class="table text-md-nowrap" id="example1">
                        <thead>
                            <tr>
                                <th class=" border-bottom-0">No</th>
                                <th class=" border-bottom-0">Tanggal</th>
                                <th class=" border-bottom-0">Kehadiran</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ Helper::tanggal($item->tanggal) }}</td>
                                    <td>{{ $item->keterangan }}</td>

                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
