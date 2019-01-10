@extends('backLayout.app')
@section('title')
Edit Produksi
@stop

@section('content')
<div class="wrapper wrapper-content">
					<div class="row detail_content3">
	<div class="col-lg-12 detail_content2" style="background-color: white"><style>
						.ibox { margin: 1px 2px 0px 0px !important }
						.ibox.float-e-margins{ margin: 0px 2px !important}
						</style>
      <div class="row ibox-title">
   <ol class="breadcrumb col-sm-6 col-xs-12" style="font-size: 14px; padding-top: 6px; ">
        <li class="">
            <a href="{{ url('produksi') }}">  Produksi
        </li>
        /
        <li class="">
                <a href="#">
                    Edit Produksi
                </a>
        </li>
    </ol>
            <a href="{{ url('produksi') }}">
            <button class="btn btn-sm btn-outline btn-warning pull-right">
            <i class="fa fa-arrow-circle-o-left" style="margin-right: 5px"></i> Back
            </button>
            </a>
    </div>
<div class="row ibox-content" style="min-height: 65vh; ">
	<div class="col-xs-12 col-sm-12">
  {!! Form::model($produksi, [
      'method' => 'PATCH',
      'url' => ['produksi', $produksi->id],
      'class' => 'form-horizontal'
  ]) !!}

                        <div class="form-group {{ $errors->has('prod_tgl') ? 'has-error' : ''}}">
                {!! Form::label('prod_tgl', 'Prod Tgl: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::date('prod_tgl', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('prod_tgl', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('kandang') ? 'has-error' : ''}}">
                {!! Form::label('kandang', 'Kandang: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::number('kandang', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('kandang', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('umur') ? 'has-error' : ''}}">
                {!! Form::label('umur', 'Umur: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::number('umur', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('umur', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('jml_mati') ? 'has-error' : ''}}">
                {!! Form::label('jml_mati', 'Jml Mati: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::number('jml_mati', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('jml_mati', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('jml_masuk') ? 'has-error' : ''}}">
                {!! Form::label('jml_masuk', 'Jml Masuk: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::number('jml_masuk', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('jml_masuk', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('jml_akhir') ? 'has-error' : ''}}">
                {!! Form::label('jml_akhir', 'Jml Akhir: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::number('jml_akhir', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('jml_akhir', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('pakan_jenis') ? 'has-error' : ''}}">
                {!! Form::label('pakan_jenis', 'Pakan Jenis: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::number('pakan_jenis', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('pakan_jenis', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('pakan_qty') ? 'has-error' : ''}}">
                {!! Form::label('pakan_qty', 'Pakan Qty: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::number('pakan_qty', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('pakan_qty', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('pakan_satuan') ? 'has-error' : ''}}">
                {!! Form::label('pakan_satuan', 'Pakan Satuan: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::number('pakan_satuan', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('pakan_satuan', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('p_utuh_butir') ? 'has-error' : ''}}">
                {!! Form::label('p_utuh_butir', 'P Utuh Butir: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::number('p_utuh_butir', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('p_utuh_butir', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('p_utuh_kg') ? 'has-error' : ''}}">
                {!! Form::label('p_utuh_kg', 'P Utuh Kg: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::number('p_utuh_kg', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('p_utuh_kg', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('p_retak_butir') ? 'has-error' : ''}}">
                {!! Form::label('p_retak_butir', 'P Retak Butir: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::number('p_retak_butir', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('p_retak_butir', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('p_retak_kg') ? 'has-error' : ''}}">
                {!! Form::label('p_retak_kg', 'P Retak Kg: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::number('p_retak_kg', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('p_retak_kg', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('gr_butir') ? 'has-error' : ''}}">
                {!! Form::label('gr_butir', 'Gr Butir: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::number('gr_butir', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('gr_butir', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('kg_1000') ? 'has-error' : ''}}">
                {!! Form::label('kg_1000', 'Kg 1000: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::number('kg_1000', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('kg_1000', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('hd') ? 'has-error' : ''}}">
                {!! Form::label('hd', 'Hd: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::number('hd', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('hd', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('fc') ? 'has-error' : ''}}">
                {!! Form::label('fc', 'Fc: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::number('fc', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('fc', '<p class="help-block">:message</p>') !!}
                </div>
            </div>


    <div class="form-group">

      <a href="{{ url('produksi') }}" class="detail2 btn btn-md btn-outline btn-danger pull-right">  <i class="fa fa-times-circle" ></i> Cancel</a>

            <button type="submit" class="create_mdl btn btn-outline btn-primary pull-right" style="margin-right: 20px; ">
                              <i class="fa fa-save"></i>  Update
                            </button>
    </div>
    </div>
    </div>
    {!! Form::close() !!}
  </div>
</div>
</div>
@endsection
