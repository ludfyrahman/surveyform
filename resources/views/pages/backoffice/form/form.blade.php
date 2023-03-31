@extends('layouts.app')

@section('content-app')
    <div class="container mt-4">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title mb-1">{{ $title }}</h4>
                @if (session('failed'))
                    <div class="alert alert-danger mg-b-0" role="alert">
                        <button aria-label="Close" class="close" data-bs-dismiss="alert" type="button">
                            <span aria-d-none="true">&times;</span>
                        </button>
                        {{ session('failed') }}
                    </div>
                @endif
            </div>
            <div class="card-body">
                <div class="card-body pt-0">
                    <form class="form-horizontal"
                        action="{{ $data->type == 'create' ? route('form.store') : route('form.update', $data->id) }}"
                        method="POST" enctype="multipart/form-data" data-parsley-validate="">
                        @csrf
                        @if ($data->type != 'create')
                            @method('PUT')
                        @endif
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Nama Field <span class="tx-danger">*</span></label>
                                    <input type="text" id="name" name="name"
                                        class="form-control @error('name') parsley-error @enderror" placeholder="name"
                                        value="{{ $data->name == '' ? old('name') : $data->name }}">
                                    @error('slug')
                                        <ul class="parsley-errors-list filled" id="parsley-id-5">
                                            <li class="parsley-required">{{ $message }}</li>
                                        </ul>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Sub Kategori <span class="tx-danger">*</span></label>
                                    <select name="sub_category_id" class="form-control @error('sub_category_id') parsley-error @enderror" id="">
                                        <option value="">Pilih Sub Kategori</option>
                                        @foreach ($categories as $category)
                                            <option {{$category->id == $data->sub_category_id ? 'selected' : ''}} value="{{ $category->id }}">{{ $category->name }} [{{$category->category->name}}]</option>
                                        @endforeach
                                    </select>
                                    @error('sub_category_id')
                                        <ul class="parsley-errors-list filled" id="parsley-id-5">
                                            <li class="parsley-required">{{ $message }}</li>
                                        </ul>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Tipe <span class="tx-danger">*</span></label>
                                    <select id='type' name="type" class="form-control @error('category_id') parsley-error @enderror" id="">
                                        <option value="">Pilih Tipe</option>
                                        @foreach (\App\Constants\FormType::type as $type => $value)
                                            <option {{$type== $data->type ? 'selected' : ''}} value="{{ $type }}">{{ $type }}</option>
                                        @endforeach
                                    </select>
                                    @error('type')
                                        <ul class="parsley-errors-list filled" id="parsley-id-5">
                                            <li class="parsley-required">{{ $message }}</li>
                                        </ul>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6 d-none @if(in_array($data->type, ['select', 'radio-range'])) 'd-none' @endif" id='multi'>
                                <div class="form-group">
                                    <label for="">Nilai <span class="tx-danger">*</span> <span class="text-muted">Contoh:opsi1,opsi2,opsi3...dst</span></label>
                                    @php
                                        $value = json_decode($data->value);
                                    @endphp
                                    <textarea name="value" class="form-control @error('value') parsley-error @enderror" id="" cols="30" rows="10">-</textarea>
                                </div>
                            </div>
                            <div class='col-md-12'>
                                <h5>Preview</h5>
                                <div id='preview'>
                                </div>
                            </div>


                        </div>
                        <div class="form-group mb-0 mt-3 justify-content-end">
                            <div>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                                <button type="reset" class="btn btn-secondary">Batal</button>
                                <a href="{{ route('form.index') }}" class="btn btn-info">Kembali</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@push('script')
    <script>
        $(document).ready(function() {
            $('#type').change(function(){
                var val = $(this).val();
                if(val == 'radio-range' || val == 'select'){
                    $('#multi').removeClass('d-none');
                }else{
                    $('#multi').addClass('d-none');
                }
                var json = JSON.parse('{!! json_encode(\App\Constants\FormType::type) !!}');
                var html = '<div class="form-group"><label for="">'+$('#name').val()+'</label>'+ json[val] +'</div>';
                $('#preview').html(html);
            });
            $('#option').change(function(){
                var val = $(this).val();
                console.log(val);
            });
        });

    </script>

@endpush
@endsection
