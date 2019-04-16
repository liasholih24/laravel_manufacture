@extends('backLayout.app')

@section('title')
    Customer
@stop

@section('desc')
    Ubah Customer
@stop

@section('content')
    <div class="wrapper wrapper-content">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Ubah Customer</h5>
                        <a href="{{ url('customer') }}" class="btn btn-sm btn-outline btn-primary pull-right" style="margin-top: -7px">
                            <i class="fa fa-arrow-circle-o-left"></i> Kembali
                        </a>
                    </div>
                    <div class="ibox-content">
                        <form action="{{ url('customer/'.$customer->id) }}" method="POST" class="form-horizontal">
                            {{ csrf_field() }}
                            {{ method_field('PUT') }}
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Nama</label>
                                <div class="col-sm-4">
                                    <input type="text" name="name" class="form-control" placeholder="Nama" value="{{ $customer->name }}" autocomplete="off" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Alamat</label>
                                <div class="col-sm-4">
                                    <textarea name="address" class="form-control" rows="3" placeholder="Alamat">{{ $customer->address }}</textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Kontak</label>
                                <div class="col-sm-4">
                                    <input type="text" name="contact" class="form-control" placeholder="Kontak" value="{{ $customer->contact }}" autocomplete="off">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Deskripsi</label>
                                <div class="col-sm-4">
                                    <textarea name="desc" class="form-control" rows="3" placeholder="Deskripsi">{{ $customer->desc }}</textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Pajak/Non Pajak</label>
                                <div class="col-sm-4">
                                    <select name="pajak" class="form-control">
                                        <option value="Pajak">Pajak</option>
                                        <option value="Non Pajak" @if($customer->pajak=='Non Pajak') selected @endif>Non Pajak</option>
                                    </select>
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <div class="col-sm-4 col-sm-offset-2">
                                    <button class="btn btn-outline btn-primary" type="submit"><i class="fa fa-plus-circle"></i> Simpan Perubahan</button>
                                    <a href="{{ url('customer') }}" class="btn btn-outline btn-danger"><i class="fa fa-times-circle"></i> Batal</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
