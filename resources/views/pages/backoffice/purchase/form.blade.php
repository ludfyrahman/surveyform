@extends('layouts.app')

@section('content-app')
    <div class="container mt-4">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title mb-1">{{$title}}</h4>
                @if (session('failed'))
                    <div class="alert alert-danger mg-b-0" role="alert">
                        <button aria-label="Close" class="close" data-bs-dismiss="alert" type="button">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        {{ session('failed') }}
                    </div>
                @endif
                <div class="alert alert-warning text-black">
                    <h3>Perhatian</h3>
                    <ol>
                        <li>Isi form barang atau jasa pada inputan terlebih dahulu untuk menambahkan pada tabel data barang / jasa</li>
                        <li>Subtotal harga barang ditampilkan dibawah form data / barang</li>
                        <li>Data barang / jasa ditampilkan pada tabel data barang / jasa</li>
                        <li>Dapat memilih diskon yang sedang aktif untuk memperoleh diskon transaksi</li>
                        <li>Total dapat ditampilkan sesuai dengan barang / jasa yang di transaksi</li>
                        <li>Customer menampilkan data customer yang ber transaksi di </li>
                    </ol>
                </div>
            </div>
            <div class="card-body">

                <div class="card-body pt-0">
                    <form class="form-horizontal" action="{{ route('purchase.store')}}" method="POST"
                        enctype="multipart/form-data" data-parsley-validate="">
                        @csrf
                        <h4>Form Barang / Jasa</h4>
                        <div class="row justify-content-end">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Tipe <span class="tx-danger">*</span></label>
                                    <select name="tipe" id='tipe' class="form-control @error('tipe') parsley-error @enderror">
                                        <option value="">Pilih Tipe</option>
                                        <option value="Jasa">Jasa</option>
                                        <option value="Barang">Barang</option>
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

                                    <label for="">Item <span class="tx-danger">*</span></label>
                                    <select name="item_id" id='item' class="form-control select2 @error('item_id') parsley-error @enderror">
                                    </select>
                                    @error('item_id')
                                        <ul class="parsley-errors-list filled" id="parsley-id-5">
                                            <li class="parsley-required">{{ $message }}</li>
                                        </ul>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Jumlah <span class="tx-danger">*</span></label>
                                    <input type="number" min='0' id='jumlah' name="jumlah"
                                        class="form-control @error('jumlah') parsley-error @enderror"
                                        placeholder="jumlah" value="{{old('jumlah')}}">
                                    @error('jumlah')
                                        <ul class="parsley-errors-list filled" id="parsley-id-5">
                                            <li class="parsley-required">{{ $message }}</li>
                                        </ul>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3 text-left">
                                <h3 id='subtotal'>Rp </h3>
                            </div>
                            <div class="col-md-3 text-right">
                                <button class="btn btn-primary"><i class="fas fa-plus"></i> Tambahkan</button>
                            </div>

                        </div>
                    </form>
                        <div class="row">
                            <div class="col-md-12">
                                <form action="{{route('submitPurchase')}}" method="post">
                                    @csrf
                                    <div class="table-responsive mt-2">
                                        <h4>Data Transaksi Barang / Jasa</h4>
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>#</th><th>Item</th><th>Jenis</th><th>Jumlah</th><th>Harga</th><th>Subtotal</th><th>Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php $subtotal=0; @endphp
                                                @foreach ($items as $item)
                                                @php
                                                    $subtotal +=$item->sub_total;
                                                @endphp
                                                <tr>
                                                    <td>{{$loop->iteration}}</td>
                                                    <td>{{ $item->tipe == \App\Constants\ItemType::BARANG ? $item->product->nama : $item->service->nama}}</td>
                                                    <td>{{ $item->tipe}} </td>
                                                    <td>{{ $item->jumlah}} </td>
                                                    <td class="text-right">{{ Helper::rupiah($item->harga)}} </td>
                                                    <td class="text-right">{{ Helper::rupiah($item->sub_total)}} </td>
                                                    <td>
                                                        <a href="{{route('destroyDetailPurchase', $item->id)}}" onclick="return confirm('Apakah anda yakin ingin menghapus data')"><i class="fas fa-trash text-danger"></i></a>
                                                    </td>
                                                </tr>
                                                @endforeach
                                                <tfoot>
                                                    <tr>
                                                        <td colspan='5' class="text-right"><h5>Subtotal</h5></td>
                                                        <td class="text-right"><h5>{{Helper::rupiah($subtotal)}}</h5></td>
                                                        <td></td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan='5' class="text-right"><h5>Total</h5></td>
                                                        <td class="text-right">
                                                            <h5 id='total'>{{Helper::rupiah($subtotal)}}</h5>
                                                            <input type="hidden" name='total' id='totalValue' value="{{$subtotal}}">
                                                            <input type="hidden" name='diskon' id='diskon' >
                                                        </td>
                                                        <td></td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan='5' class="text-right"><h5>Supplier <span class="tx-danger">*</span></h5></td>
                                                        <td class="text-right">
                                                            <select name="supplier_id" id="supplier_id" class="form-control" required>
                                                                <option value="">Pilih Customer</option>
                                                                @foreach ($suppliers as $supplier)
                                                                    <option value="{{$supplier->id}}" >{{$supplier->nama}}</option>
                                                                @endforeach
                                                            </select>
                                                        </td>
                                                        <td></td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan='5' class="text-right"><h5>Jenis Transaksi <span class="tx-danger">*</span></h5></td>
                                                        <td class="text-right">
                                                            <select name="tipe_transaksi" id="tipe_transaksi" class="form-control" required>
                                                                <option value="">Pilih Jenis</option>
                                                                @foreach (\App\Constants\TransactionType::TRANSAKSI as $type)
                                                                    <option value="{{$type}}" >{{$type}}</option>
                                                                @endforeach
                                                            </select>
                                                        </td>
                                                        <td></td>
                                                    </tr>
                                                </tfoot>
                                            </tbody>
                                        </table>
                                        <h2>Invoice : {{ $invoice}}</h2>
                                        <input type="hidden" name="invoice" value="{{ $invoice }}">
                                        <p class="text-danger"><i>* Wajib Di isi</i></p>
                                        <div class="form-group mb-0 mt-3 justify-content-end">
                                            <div>
                                                <button type="submit" class="btn btn-primary" onclick="return confirm('apakah anda yakin ingin menambahkan transaksi ini?')">Simpan</button>
                                                <button type="reset" class="btn btn-secondary">Batal</button>
                                                <a href="{{ route('type.index') }}" class="btn btn-info">Kembali</a>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>



                </div>
            </div>
        </div>
    </div>
@endsection
@push('script')
    <script>
        $(function(){
            $('#tipe').change(function(){
                var val = $(this).val();
                $.ajax({
                    type:'GET',
                    url:'/api/getItem/'+val,
                    success:function(response){
                        var result = '<option>Pilih Item</option>';
                        for (let index = 0; index < response.length; index++) {
                            result+="<option price='"+response[index].price+"' value='"+response[index].id+"'>"+response[index].nama+"</option>";
                        }
                        $('#item').html(result);
                    },
                    error:function(response){
                        console.log(response);
                    }
                })
            });

            $('#jumlah').keyup(function(){
                var val = $(this).val();
                var item = $('#item');
                var option = $('option:selected', item).attr('price');

                $('#subtotal').text(option * val);
            });

            $('#voucher').change(function(){
                var val = $(this).val();
                var item = $('#item');
                var amount = $('option:selected', this).attr('price');
                var tipe = $('option:selected', this).attr('tipe');
                var subtotal = '{{$subtotal}}';
                var diskon = tipe == 'nominal' ? amount : subtotal * amount / 100;
                var total = subtotal  - diskon;
                if(val !=''){
                    $('#total').text(formatRupiah(total, 'Rp '));
                    $('#totalValue').val(total);
                    $('#diskon').val(diskon);
                }
            })
        })
    </script>
@endpush
