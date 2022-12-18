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

                <div class="card-body pt-0">
                    <form class="form-horizontal" action="{{ route('profile.update', $data->id) }}" method="POST"
                        enctype="multipart/form-data" data-parsley-validate="">
                        @method('PUT')
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">Nama Perusahaan <span class="tx-danger">*</span></label>
                                    <input type="text" id="nama_perusahaan" name="nama_perusahaan"
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
                                    <label for="">Email Perusahaan <span class="tx-danger">*</span></label>
                                    <input type="text" id="email" name="email"
                                        class="form-control @error('email') parsley-error @enderror"
                                        placeholder="Email Perusahaan" value="{{ $data->email }}">
                                    @error('email')
                                        <ul class="parsley-errors-list filled" id="parsley-id-5">
                                            <li class="parsley-required">{{ $message }}</li>
                                        </ul>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">No Hp Perusahaan <span class="tx-danger">*</span></label>
                                    <input type="text" id="email" name="phone"
                                        class="form-control @error('phone') parsley-error @enderror"
                                        placeholder="NoHp Perusahaan" value="{{ $data->phone }}">
                                    @error('phone')
                                        <ul class="parsley-errors-list filled" id="parsley-id-5">
                                            <li class="parsley-required">{{ $message }}</li>
                                        </ul>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">Dark Logo <span class="tx-danger">*</span></label>
                                    <input type="file" class="dropify" name="logo" data-height="200"
                                        data-default-file="{{ asset($data->logo) }}" />
                                    @error('logo')
                                        <ul class="parsley-errors-list filled" id="parsley-id-5">
                                            <li class="parsley-required">{{ $message }}</li>
                                        </ul>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">Light Logo <span class="tx-danger">*</span></label>
                                    <input type="file" class="dropify" name="light_logo" data-height="200"
                                        data-default-file="{{ asset($data->light_logo) }}" />
                                    @error('light_logo')
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
                                    <textarea name="deskripsi" class="form-control @error('deskripsi') parsley-error @enderror" id="summernote" cols="10"
                                        rows="3"> {{ $data->deskripsi }}</textarea>

                                    @error('deskripsi')
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
                                    <label for="">Alamat <span class="tx-danger">*</span></label>
                                    <textarea name="deskripsi" class="form-control @error('alamat') parsley-error @enderror" id="summernote" cols="10"
                                        rows="3"> {{ $data->alamat }}</textarea>

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
                                <button type="submit" onclick="" class="btn btn-primary">Simpan</button>
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
