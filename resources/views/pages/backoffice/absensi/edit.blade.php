@extends('layouts.app')

@section('content-app')
    <div class="container mt-4">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title mb-1">Detail Absensi {{ Helper::tanggal($id) }}</h4>
                @if (session('failed'))
                    <div class="alert alert-danger mg-b-0" role="alert">
                        <button aria-label="Close" class="close" data-bs-dismiss="alert" type="button">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        {{ session('failed') }}
                    </div>
                @endif
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
                    <table class="table table-bordered table-striped mg-b-0 text-md-nowrap">
                        <thead>
                            <tr>
                                <th class="border-bottom-0 text-center">Nama</th>
                                <th class="border-bottom-0 text-center">Kehadiran</th>
                                <th class="border-bottom-0 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $item)
                                <tr>
                                    <td><input type="hidden" name="pegawai_id[]" value="{{ $item->id }}">
                                        {{ $item->nama }}</td>
                                    <td>{{ $item->keterangan }} </td>
                                    <td>
                                        <a class=" modal-effect btn btn-sm btn-info" data-bs-effect="effect-scale"
                                            data-bs-toggle="modal" href="#modalEdit{{ $item->id }}"> <i
                                                class="mdi mdi-pencil"></i>
                                            Edit</a>
                                        <!-- Modal effects -->
                                        <div class="modal fade" id="modalEdit{{ $item->id }}">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content modal-content-demo">
                                                    <form action="" class="form-horizontal"
                                                        action="{{ route('kehadiran.update', $item->id) }}" method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="modal-header">
                                                            <h6 class="modal-title">Ubah Kehadiran</h6><button
                                                                aria-label="Close" class="close" data-bs-dismiss="modal"
                                                                type="button"><span
                                                                    aria-hidden="true">&times;</span></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <div class="form-group">

                                                                        <input type="text" name="nama" readonly
                                                                            style="background-color:#3a3a3a0d;"
                                                                            class="form-control @error('nama') parsley-error @enderror"
                                                                            placeholder="Nama Karyawan"
                                                                            value="{{ $item->nama }}">
                                                                        <input type="hidden" name="tanggal"
                                                                            value="{{ $id }}">
                                                                        <input type="hidden" name="id"
                                                                            value="{{ $item->id }}">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">

                                                                    <div class="form-group">

                                                                        <select name="kehadiran" id=""
                                                                            class="form-control">
                                                                            <option value="">Pilih Kehadiran</option>
                                                                            <option value="Hadir" selected>Hadir</option>
                                                                            <option value="Sakit">Sakit</option>
                                                                            <option value="Izin">Izin</option>
                                                                            <option value="Tanpa Keterangan">Tanpa
                                                                                Keterangan</option>

                                                                        </select>

                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button class="btn ripple btn-primary" type="submit">Simpan
                                                                Perubahan</button>
                                                            <button class="btn ripple btn-secondary" data-bs-dismiss="modal"
                                                                type="button">Batal</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- End Modal effects-->
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
