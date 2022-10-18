@extends('layouts.app')

@section('content-app')
    <div class="container mt-4">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title mb-1">Pengaturan Profil Perusahaan</h4>
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
                    <form class="form-horizontal" action="{{ route('employe.store') }}" method="POST"
                        enctype="multipart/form-data" data-parsley-validate="">

                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">Nama Perusahaan <span class="tx-danger">*</span></label>
                                    <input type="text" name="nama_perusahaan"
                                        class="form-control @error('nama_perusahaan') parsley-error @enderror"
                                        placeholder="Nama Perusahaan" value="{{ $data->nama_perusahaan }}">
                                    @error('nama_perusahaan')
                                        <ul class="parsley-errors-list filled" id="parsley-id-5">
                                            <li class="parsley-required">{{ $message }}</li>
                                        </ul>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">Logo <span class="tx-danger">*</span></label>
                                    <input type="file" class="dropify" data-height="200" />
                                    @error('telepon')
                                        <ul class="parsley-errors-list filled" id="parsley-id-5">
                                            <li class="parsley-required">{{ $message }}</li>
                                        </ul>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">Deskripsi <span class="tx-danger">*</span></label>
                                    {{-- <textarea name="alamat" class="form-control @error('alamat') parsley-error @enderror" id="" cols="10"
                                        rows="3">{{ old('alamat') }}</textarea> --}}
                                        <div class="ql-wrapper ql-wrapper-demo bg-gray-100">
                                            <div id="quillEditor">
                                                {{$data->deskripsi}}
                                            </div>
                                        </div>

                                    @error('alamat')
                                        <ul class="parsley-errors-list filled" id="parsley-id-5">
                                            <li class="parsley-required">{{ $message }}</li>
                                        </ul>
                                    @enderror
                                </div>
                            </div>

                        </div>


                        <div class="form-group mb-0 mt-3 justify-content-end">
                            <div>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                                <button type="reset" class="btn btn-secondary">Batal</button>
                                <a href="{{ url('employe') }}" class="btn btn-info">Kembali</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
