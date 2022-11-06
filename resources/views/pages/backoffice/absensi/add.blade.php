@extends('layouts.app')

@section('content-app')
    <div class="container mt-4">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title mb-1">Tambah Data Kehadiran</h4>
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

                <div class="card-body pt-0">
                    <form class="form-horizontal" action="{{ route('kehadiran.store') }}" method="POST"
                        enctype="multipart/form-data" data-parsley-validate="">

                        @csrf
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label for="">Hari/Tanggal</label>
                                <input type="text" readonly style="background-color: #ecf0fa;"
                                    class="form-control @error('tanggal') parsley-error @enderror" placeholder="tanggal"
                                    value="{{ $date }}">
                                <input type="hidden" name="tanggal" value="{{ $dateVal }}">
                                @error('tanggal')
                                    <ul class="parsley-errors-list filled" id="parsley-id-5">
                                        <li class="parsley-required">{{ $message }}</li>
                                    </ul>
                                @enderror
                            </div>
                            <div class="col-md-12">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped mg-b-0 text-md-nowrap">
                                        <thead>
                                            <tr>
                                                <th class="border-bottom-0 text-center">Nama</th>
                                                <th class="border-bottom-0 text-center">Kehadiran</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($data as $item)
                                                <tr>
                                                    <td><input type="hidden" name="pegawai_id[]"
                                                            value="{{ $item->id }}"> {{ $item->nama }}</td>
                                                    <td>
                                                        <div class="form-group">

                                                            <select name="kehadiran[]" id="" class="form-control">
                                                                <option value="">Pilih Kehadiran</option>
                                                                <option value="Hadir" selected>Hadir</option>
                                                                <option value="Sakit">Sakit</option>
                                                                <option value="Izin">Izin</option>
                                                                <option value="Tanpa Keterangan">Tanpa Keterangan</option>

                                                            </select>

                                                        </div>
                                                    </td>

                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>


                        <div class="form-group mb-0 mt-3 justify-content-end">
                            <div>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                                <button type="reset" class="btn btn-secondary">Batal</button>
                                <a href="{{ url('kehadiran') }}" class="btn btn-info">Kembali</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
