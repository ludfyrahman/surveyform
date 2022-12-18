@extends('layouts.app')

@section('content-app')
    <div class="container mt-4">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title mb-1">{{ $title }}</h4>
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
                        action="{{ $data->type == 'create' ? route('unit.store') : route('unit.update', $data->id) }}"
                        method="POST" enctype="multipart/form-data" data-parsley-validate="">
                        @csrf
                        @if ($data->type != 'create')
                            @method('PUT')
                        @endif
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Satuan <span class="tx-danger">*</span></label>
                                    <input type="text" name="satuan"
                                        class="form-control @error('satuan') parsley-error @enderror" placeholder="satuan"
                                        value="{{ $data->satuan == '' ? old('satuan') : $data->satuan }}">
                                    @error('satuan')
                                        <ul class="parsley-errors-list filled" id="parsley-id-5">
                                            <li class="parsley-required">{{ $message }}</li>
                                        </ul>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Akronim <span class="tx-danger">*</span></label>
                                    <input type="text" name="akronim"
                                        class="form-control @error('akronim') parsley-error @enderror" placeholder="akronim"
                                        value="{{ $data->akronim == '' ? old('akronim') : $data->akronim }}">
                                    @error('akronim')
                                        <ul class="parsley-errors-list filled" id="parsley-id-5">
                                            <li class="parsley-required">{{ $message }}</li>
                                        </ul>
                                    @enderror
                                </div>
                            </div>
                            @if (Auth::user()->role === 'Super Admin')
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Status <span class="tx-danger">*</span></label>
                                        {{-- @php $status = $data->status == '' ? old('status') : $data->status; @endphp --}}
                                        <select name="status" id="" class="form-control" required>
                                            <option value="">Pilih Status</option>
                                            <option {{ old('status') == 'Aktif' ? 'selected' : '' }} selected value="Aktif">Aktif</option>
                                            <option {{ old('status') == 'Nonaktif' ? 'selected' : '' }} value="Nonaktif">Nonaktif
                                            </option>
                                        </select>
                                        @error('status')
                                            <ul class="parsley-errors-list filled" id="parsley-id-5">
                                                <li class="parsley-required">{{ $message }}</li>
                                            </ul>
                                        @enderror
                                    </div>
                                </div>
                            @endif


                        </div>
                        <div class="form-group mb-0 mt-3 justify-content-end">
                            <div>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                                <button type="reset" class="btn btn-secondary">Batal</button>
                                <a href="{{ route('unit.index') }}" class="btn btn-info">Kembali</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
