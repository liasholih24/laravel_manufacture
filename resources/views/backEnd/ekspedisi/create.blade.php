@extends('backLayout.app')

@section('title')
    Ekspedisi
@stop

@section('desc')
    Tambah Ekspedisi
@stop

@section('content')
    <div class="wrapper wrapper-content">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Tambah Ekspedisi</h5>
                        <a href="{{ url('ekspedisi') }}" class="btn btn-sm btn-outline btn-primary pull-right" style="margin-top: -7px">
                            <i class="fa fa-arrow-circle-o-left"></i> Kembali
                        </a>
                    </div>
                    <div class="ibox-content">
                        <form action="{{ url('ekspedisi') }}" method="POST" class="form-horizontal">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Nama</label>
                                <div class="col-sm-4">
                                    <input type="text" name="name" class="form-control" placeholder="Nama" autocomplete="off" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Deskripsi</label>
                                <div class="col-sm-4">
                                    <textarea name="desc" class="form-control" rows="3" placeholder="Deskripsi"></textarea>
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <div class="col-sm-4 col-sm-offset-2">
                                    <button class="btn btn-outline btn-primary" type="submit"><i class="fa fa-plus-circle"></i> Simpan</button>
                                    <a href="{{ url('ekspedisi') }}" class="btn btn-outline btn-danger"><i class="fa fa-times-circle"></i> Batal</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
