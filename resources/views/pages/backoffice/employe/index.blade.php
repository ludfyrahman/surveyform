@extends('layouts.app')

@section('content-app')
    <div class="container mt-4">
        <div class="card">
            <div class="card-header pb-0">
                <div class="d-flex justify-content-between">
                    <h4 class="card-title mg-b-0">Data Pegawai</h4>
                    <a href="{{ url('/employe/create') }}" class="btn btn-sm btn-primary"><i class="mdi mdi-plus"></i> Tambah
                        Pegawai</a>

                </div>
                <p class="tx-12 tx-gray-500 mb-2">Data Pegawai</p>
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
                                <th class="wd-15p border-bottom-0">Nama</th>
                                <th class="wd-20p border-bottom-0">Username</th>
                                <th class="wd-15p border-bottom-0">Telepon</th>
                                @if (Auth::user()->role == 'Super Admin')
                                    <th class="wd-15p border-bottom-0">Status</th>
                                @endif
                                <th class="wd-25p border-bottom-0">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $item)
                                <tr>
                                    <td>{{ $item->nama }}</td>
                                    <td>{{ $item->username }}</td>
                                    <td>{{ $item->telepon }}</td>
                                    @if (Auth::user()->role == 'Super Admin')
                                        <td>{{ $item->status }}</td>
                                    @endif
                                    <td class="d-flex"><a href="{{ url('/employe/' . $item->id . '/edit') }}" class="btn btn-sm btn-info me-2">
                                            <i class="mdi mdi-pencil"></i>
                                            Ubah</a>
                                        <form method="POST" action="{{ route('employe.destroy', $item->id) }}">
                                            @method('delete')
                                            @csrf
                                            <button type="submit"
                                                onclick="return confirm('apakah anda yakin ingin menghapus data ??')"
                                                class="btn btn-sm btn-danger"><i class="mdi mdi-delete"></i>
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
