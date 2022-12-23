@extends('layouts.app')

@section('content-app')
    <div class="container mt-4">
        <div class="card card-invoice">
            <div class="card-body">
                <div class="invoice-header">
                    <h1 class="invoice-title">Invoice</h1>
                    <div class="billed-from">
                        <h6>{{Helper::profile()->nama_perusahaan}}</h6>
                        <p>{{Helper::profile()->deskripsi}}</p>
                    </div><!-- billed-from -->
                </div><!-- invoice-header -->
                <div class="row mg-t-20">
                    <div class="col-md">
                        <label class="tx-gray-600">Billed To</label>
                        <div class="billed-to">
                            <h6>{{$data->customer->nama}}</h6>
                            <p>{{$data->customer->alamat}}<br>
                            Tel No: {{$data->customer->telepon}}<br></p>
                        </div>
                    </div>
                    <div class="col-md">
                        <label class="tx-gray-600">Invoice Information</label>
                        <p class="invoice-info-row"><span>Invoice No</span> <span>{{$data->invoice}}</span></p>
                        <p class="invoice-info-row"><span>Date:</span> <span>{{$data->created_at->format('d M, Y')}}</span></p>
                        <p class="invoice-info-row"><span>Type:</span> <span class="badge bg-primary">{{$data->tipe_transaksi}}</span></p>
                    </div>
                </div>
                <div class="table-responsive mg-t-40">
                    <table class="table table-invoice border text-md-nowrap mb-0">
                        <thead>
                            <tr>
                                <th>#</th><th>Item</th><th>Jenis</th><th>Jumlah</th><th>Harga</th><th>Subtotal</th>
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
                            </tr>
                            @endforeach
                            <tfoot>
                                <tr>
                                    <td colspan='5' class="text-right"><h5>Subtotal</h5></td>
                                    <td class="text-right"><h5>{{Helper::rupiah($subtotal)}}</h5></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td colspan='5' class="text-right"><h5>Diskon</h5></td>
                                    <td class="text-right">{{Helper::rupiah($data->diskon)}}</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td colspan='5' class="text-right"><h5>Total</h5></td>
                                    <td class="text-right">
                                        <h5 id='total' class="text-primary">{{Helper::rupiah($subtotal)}}</h5>
                                        <input type="hidden" name='total' id='totalValue' value="{{$subtotal}}">
                                        <input type="hidden" name='diskon' id='diskon' >
                                    </td>
                                    <td></td>
                                </tr>
                            </tfoot>
                        </tbody>
                    </table>
                </div>
                <hr class="mg-b-40">
                <a href="{{ route('sale.index') }}" class="btn btn-info float-end mt-3 ms-2">
                    <i class="mdi mdi-back me-1"></i>Kembali
                </a>
                <a href="#" class="btn btn-danger float-end mt-3 ms-2"  onclick="javascript:window.print();">
                    <i class="mdi mdi-printer me-1"></i>Print
                </a>
                
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
