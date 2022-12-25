@extends('layouts.app')

@section('content-app')
    <div class="container mt-4">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title mb-1">Tambah Data Barang</h4>
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
                        action="{{ $data->type == 'create' ? route('product.store') : route('product.update', $data->id) }}"
                        method="POST" enctype="multipart/form-data" data-parsley-validate="">
                        @csrf
                        @if ($data->type != 'create')
                            @method('PUT')
                        @endif
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Kode Barang</label>
                                    <input type="text" name="kode"
                                        class="form-control @error('kode') parsley-error @enderror"
                                        placeholder="kode(Opsional)" value="{{ $data->kode }}" readonly>
                                    @error('kode')
                                        <ul class="parsley-errors-list filled" id="parsley-id-5">
                                            <li class="parsley-required">{{ $message }}</li>
                                        </ul>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Nama Barang <span class="tx-danger">*</span></label>
                                    <input type="text" name="nama"
                                        class="form-control @error('nama') parsley-error @enderror"
                                        placeholder="Nama Barang" value="{{ $data->nama }}">
                                    @error('nama')
                                        <ul class="parsley-errors-list filled" id="parsley-id-5">
                                            <li class="parsley-required">{{ $message }}</li>
                                        </ul>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Harga Beli <span class="tx-danger">*</span></label>
                                    <input type="number" name="harga_beli"
                                        class="form-control @error('harga_beli') parsley-error @enderror"
                                        placeholder="Harga Beli" value="{{ $data->harga_beli }}">
                                    @error('harga_beli')
                                        <ul class="parsley-errors-list filled" id="parsley-id-5">
                                            <li class="parsley-required">{{ $message }}</li>
                                        </ul>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Harga Jual <span class="tx-danger">*</span></label>
                                    <input type="number" name="harga_jual"
                                        class="form-control @error('harga_jual') parsley-error @enderror"
                                        placeholder="Harga Beli" value="{{ $data->harga_jual }}">
                                    @error('harga_jual')
                                        <ul class="parsley-errors-list filled" id="parsley-id-5">
                                            <li class="parsley-required">{{ $message }}</li>
                                        </ul>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Kategori/Jenis <span class="tx-danger">*</span></label>
                                    <select name="kategori" required
                                        class="form-control @error('kategori') parsley-error @enderror" id="">
                                        <option value="">Pilih Kategori {{$data->kategori_id}}</option>
                                        @foreach ($kategori as $item)
                                            <option {{ $data->kategori_id == $item->id ? 'selected' : ''}} value="{{ $item->id }}">{{ $item->kategori }}</option>
                                        @endforeach
                                    </select>
                                    @error('kategori')
                                        <ul class="parsley-errors-list filled" id="parsley-id-5">
                                            <li class="parsley-required">{{ $message }}</li>
                                        </ul>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Satuan <span class="tx-danger">*</span></label>
                                    <select name="satuan" required
                                        class="form-control @error('satuan') parsley-error @enderror" id="">
                                        <option value="">Pilih Satuan</option>
                                        @foreach ($satuan as $item)
                                            <option {{$data->satuan_id == $item->id ? 'selected' : ''}} value="{{ $item->id }}">{{ $item->satuan }}</option>
                                        @endforeach
                                    </select>
                                    @error('satuan')
                                        <ul class="parsley-errors-list filled" id="parsley-id-5">
                                            <li class="parsley-required">{{ $message }}</li>
                                        </ul>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Stok <span class="tx-danger">*</span></label>
                                    <input type="number" name="stok"
                                        class="form-control @error('stok') parsley-error @enderror"
                                        placeholder="Stok Barang" value="{{ $data->stok }}">
                                    @error('stok')
                                        <ul class="parsley-errors-list filled" id="parsley-id-5">
                                            <li class="parsley-required">{{ $message }}</li>
                                        </ul>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Tanggal Kedaluarsa <span class="tx-danger">*</span></label>
                                    <input type="date" name="expired_date"
                                        class="form-control @error('expired_date') parsley-error @enderror"
                                        placeholder="Tanggal Kedaluarsa" value="{{ $data->expired_date }}">
                                    @error('expired_date')
                                        <ul class="parsley-errors-list filled" id="parsley-id-5">
                                            <li class="parsley-required">{{ $message }}</li>
                                        </ul>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Status </label>
                                    @php $status = $data->status; @endphp
                                    <select name="status" id="" class="form-control">
                                        <option value="">Pilih Status</option>
                                        <option {{ $status == 'Aktif' ? 'selected' : '' }} value="Aktif">Aktif</option>
                                        <option {{ $status == 'Nonaktif' ? 'selected' : '' }} value="Nonaktif">Nonaktif
                                        </option>
                                    </select>
                                    @error('status')
                                        <ul class="parsley-errors-list filled" id="parsley-id-5">
                                            <li class="parsley-required">{{ $message }}</li>
                                        </ul>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Foto </label>
                                    @if ($data->type != 'create')
                                    <a href="{{ $data->foto }}">Lihat Foto Produk</a>
                                    @endif
                                    <input type="file" class="form-control @error('foto') parsley-error @enderror" name='foto'>
                                    @error('foto')
                                        <ul class="parsley-errors-list filled" id="parsley-id-5">
                                            <li class="parsley-required">{{ $message }}</li>
                                        </ul>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Tersedia Di(Nama Platform) <span class="tx-danger">* Nama Platform dapat dipilih dan di inputkan</span></label>
                                    <select name="is_available_in" required id='item_1' class="form-control select2Input @error('is_available_in') parsley-error @enderror">
                                        @foreach ($available as $avail)
                                            <option {{$avail->name == $data->is_available_in ? 'selected' : ''}} value="{{$avail->name}}">{{$avail->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('is_available_in')
                                        <ul class="parsley-errors-list filled" id="parsley-id-5">
                                            <li class="parsley-required">{{ $message }}</li>
                                        </ul>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Nama Toko <span class="tx-danger">* Nama Toko dapat dipilih dan di inputkan</span></label>
                                    <select name="store" required id='item' class="form-control select2InputSecond @error('store') parsley-error @enderror">
                                        @foreach ($store as $st)
                                            <option {{$st->name == $data->store ? 'selected' : ''}} value="{{$st->name}}">{{$st->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('foto')
                                        <ul class="parsley-errors-list filled" id="parsley-id-5">
                                            <li class="parsley-required">{{ $message }}</li>
                                        </ul>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">Deskripsi <span class="tx-danger">*</span></label>
                                        <textarea name="deskripsi" class="form-control @error('deskripsi') parsley-error @enderror" id="" cols="30" rows="10">
                                            {{ $data->deskripsi }}
                                        </textarea>
                                    @error('deskripsi')
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
