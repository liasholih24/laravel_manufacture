@extends('backLayout.app')
@section('title')
Edit Hargapokok
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
            <a href="{{ url('hargapokok') }}">  Hargapokok
        </li>
        /
        <li class="">
                <a href="#">
                    Edit Hargapokok
                </a>
        </li>
    </ol>
            <a href="{{ url('hargapokok') }}">
            <button class="btn btn-sm btn-outline btn-warning pull-right">
            <i class="fa fa-arrow-circle-o-left" style="margin-right: 5px"></i> Back
            </button>
            </a>
    </div>
<div class="row ibox-content" style="min-height: 65vh; ">
	<div class="col-xs-12 col-sm-12">
  {!! Form::model($hargapokok, [
      'method' => 'PATCH',
      'url' => ['hargapokok', $hargapokok->id],
      'class' => 'form-horizontal'
  ]) !!}

                        <div class="form-group {{ $errors->has('tgl_hpp') ? 'has-error' : ''}}">
                {!! Form::label('tgl_hpp', 'Tgl Hpp: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::date('tgl_hpp', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('tgl_hpp', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('jenis') ? 'has-error' : ''}}">
                {!! Form::label('jenis', 'Jenis: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::text('jenis', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('jenis', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('b_gaji_kandang') ? 'has-error' : ''}}">
                {!! Form::label('b_gaji_kandang', 'B Gaji Kandang: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::number('b_gaji_kandang', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('b_gaji_kandang', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('b_gaji_angkutan') ? 'has-error' : ''}}">
                {!! Form::label('b_gaji_angkutan', 'B Gaji Angkutan: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::number('b_gaji_angkutan', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('b_gaji_angkutan', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('b_lembur') ? 'has-error' : ''}}">
                {!! Form::label('b_lembur', 'B Lembur: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::number('b_lembur', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('b_lembur', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('b_transpakan') ? 'has-error' : ''}}">
                {!! Form::label('b_transpakan', 'B Transpakan: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::number('b_transpakan', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('b_transpakan', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('b_bongkar') ? 'has-error' : ''}}">
                {!! Form::label('b_bongkar', 'B Bongkar: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::number('b_bongkar', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('b_bongkar', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('b_pakan') ? 'has-error' : ''}}">
                {!! Form::label('b_pakan', 'B Pakan: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::number('b_pakan', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('b_pakan', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('b_obat') ? 'has-error' : ''}}">
                {!! Form::label('b_obat', 'B Obat: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::number('b_obat', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('b_obat', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('b_listrik') ? 'has-error' : ''}}">
                {!! Form::label('b_listrik', 'B Listrik: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::number('b_listrik', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('b_listrik', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('b_servis') ? 'has-error' : ''}}">
                {!! Form::label('b_servis', 'B Servis: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::number('b_servis', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('b_servis', '<p class="help-block">:message</p>') !!}
                </div>
            </div>


    <div class="form-group">

      <a href="{{ url('hargapokok') }}" class="detail2 btn btn-md btn-outline btn-danger pull-right">  <i class="fa fa-times-circle" ></i> Cancel</a>

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
