@extends('layouts.app')

@section('content-app')
    <div class="container mt-4">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title mb-1">Tambah Data Jasa</h4>
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
                    <form class="form-horizontal"
                        action="{{ $data->type == 'create' ? route('voucher.store') : route('voucher.update', $data->id) }}"
                        method="POST" enctype="multipart/form-data" data-parsley-validate="">
                        @csrf
                        @if ($data->type != 'create')
                            @method('PUT')
                        @endif
                        <div class="row">

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Nama Jasa <span class="tx-danger">*</span></label>
                                    <input type="text" name="nama_voucher"
                                        class="form-control @error('nama_voucher') parsley-error @enderror" placeholder="Nama Voucher"
                                        value="{{ $data->nama_voucher }}">
                                    @error('nama_voucher')
                                        <ul class="parsley-errors-list filled" id="parsley-id-5">
                                            <li class="parsley-required">{{ $message }}</li>
                                        </ul>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Tipe Potongan  <span class="tx-danger">*</span></label>

                                    @php $status = $data->tipe; @endphp
                                    <select name="tipe" id="" class="form-control" >
                                        <option value="">Pilih tipe potongan</option>
                                        <option {{ $data->tipe == 'nominal' ? 'selected' : '' }} value="nominal">Nominal</option>
                                        <option {{ $data->tipe == 'persentase' ? 'selected' : '' }} value="persentase">Persentase
                                        </option>
                                    </select>
                                    @error('tipe')
                                        <ul class="parsley-errors-list filled" id="parsley-id-5">
                                            <li class="parsley-required">{{ $message }}</li>
                                        </ul>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Besaran Potongan <span class="tx-danger">*</span></label>
                                    <input type="number" name="besaran"
                                        class="form-control @error('besaran') parsley-error @enderror"
                                        placeholder="Besaran Potongan" value="{{ $data->besaran }}">
                                    @error('besaran')
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
                                @if ($data->type == 'create')
                                    <button type="reset" class="btn btn-secondary">Batal</button>
                                @endif
                                <a href="{{ route('supplier.index') }}" class="btn btn-info">Kembali</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
