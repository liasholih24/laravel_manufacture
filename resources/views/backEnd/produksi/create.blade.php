@extends('backLayout.app')
@section('title')
Produksi
@stop
@section('desc')
Recording Produksi
@stop
@section('style')
  {{ HTML::style('assets_back/css/plugins/select2/select2.min.css')}}
  {{ HTML::style('assets_back/css/plugins/chosen/chosen.css')}}
  {{ HTML::style('assets_back/css/plugins/datapicker/datepicker3.css')}}
  
@endsection
@section('content')
<div class="wrapper wrapper-content">
					<div class="row detail_content3">
	<div class="col-lg-12 detail_content2" style="background-color: white"><style>
						.ibox { margin: 1px 2px 0px 0px !important }
						.ibox.float-e-margins{ margin: 0px 2px !important}
						</style>
      <div class="row ibox-title">
   <ol class="breadcrumb col-sm-5 col-xs-12" style="font-size: 14px; padding-top: 6px; ">
        <li class="">
            <a href="{{ url('produksi') }}"> Produksi
        </li>
        /
        <li class="">
                <a href="#">
                    Add New
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
	<div class="col-xs-12 col-sm-22">
    {!! Form::open(['url' => 'produksi', 'class' => 'form-horizontal']) !!}
    <h4>Info</h4>
                  <div class="form-group {{ $errors->has('prod_tgl') ? 'has-error' : ''}}">
                {!! Form::label('prod_tgl', 'Tanggal Produksi* ', ['class' => 'col-sm-2 control-label']) !!}
                <div class="col-sm-5">
                    {!! Form::text('prod_tgl', $datenow, ['id' => 'prod_tgl','class' => 'form-control','data-date-format'=>'yyyy-mm-dd','placeholder' => $datenow]) !!}
            
                    {!! $errors->first('prod_tgl', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('kandang') ? 'has-error' : ''}}">
                {!! Form::label('kandang', 'Kandang*', ['class' => 'col-sm-2 control-label']) !!}
                <div class="col-sm-5">
                    {{ Form::select('kandang', $kandangs, null, ['class' => 'form-control chosen-select','placeholder' => 'Pilih Kandang']) }}
                    {!! $errors->first('kandang', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('umur') ? 'has-error' : ''}}">
                {!! Form::label('umur', 'Umur*', ['class' => 'col-sm-2 control-label']) !!}
                <div class="col-sm-5">
                    {!! Form::text('umur', null, ['class' => 'form-control','placeholder' => 'Umur/Minggu']) !!}
                    {!! $errors->first('umur', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <br/>
            <h4>Populasi</h4>
            <div class="form-group {{ $errors->has('jml_akhir') ? 'has-error' : ''}}">
                {!! Form::label('jml_akhir', 'Jml Akhir', ['class' => 'col-sm-2 control-label']) !!}
                <div class="col-sm-5">
                    {!! Form::text('jml_akhir', 0, ['class' => 'form-control','placeholder'=>'Jml. Akhir']) !!}
                    {!! $errors->first('jml_akhir', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('jml_mati') ? 'has-error' : ''}}">
                {!! Form::label('jml_mati', 'Jml Mati', ['class' => 'col-sm-2 control-label']) !!}
                <div class="col-sm-5">
                    {!! Form::text('jml_mati', null, ['class' => 'form-control','placeholder'=>'Pindah/Masuk']) !!}
                    {!! $errors->first('jml_mati', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('jml_masuk') ? 'has-error' : ''}}">
                {!! Form::label('jml_masuk', 'Jml Masuk', ['class' => 'col-sm-2 control-label']) !!}
                <div class="col-sm-5">
                    {!! Form::text('jml_masuk', null, ['class' => 'form-control','placeholder'=>'Jual/Akhir']) !!}
                    {!! $errors->first('jml_masuk', '<p class="help-block">:message</p>') !!}
                </div>
            </div>

            <br/>
            <h4>Pakan</h4>
            
            <div class="form-group {{ $errors->has('pakan_jenis') ? 'has-error' : ''}}">
                {!! Form::label('pakan_jenis', 'Jenis Pakan', ['class' => 'col-sm-2 control-label']) !!}
                <div class="col-sm-5">
                   {{ Form::select('pakan_jenis', $pakans, null, ['class' => 'form-control chosen-select','placeholder' => 'Pilih Pakan']) }}
                   {!! $errors->first('pakan_jenis', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <!--<div class="form-group {{ $errors->has('pakan_satuan') ? 'has-error' : ''}}">
                {!! Form::label('pakan_satuan', 'Satuan', ['class' => 'col-sm-2 control-label']) !!}
                <div class="col-sm-5">
                    {{ Form::select('pakan_satuan', $satuans, null, ['class' => 'form-control chosen-select','placeholder' => 'Pilih Satuan']) }}
                    {!! $errors->first('pakan_satuan', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            -->
            <div class="form-group {{ $errors->has('pakan_qty') ? 'has-error' : ''}}">
                {!! Form::label('pakan_qty', 'Pakan (Kg)', ['class' => 'col-sm-2 control-label']) !!}
                <div class="col-sm-5">
                    {!! Form::text('pakan_qty', null, ['class' => 'form-control','placeholder' => 'Pakan (Kg)']) !!}
                    {!! $errors->first('pakan_qty', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <br/>
            <h4>Hasil Produksi</h4>
            
            <div class="form-group {{ $errors->has('p_utuh_butir') ? 'has-error' : ''}}">
                {!! Form::label('p_utuh_butir', 'Utuh(TB&TS)', ['class' => 'col-sm-2 control-label']) !!}
                <div class="col-sm-4">
                    {!! Form::text('p_utuh_butir', null, ['class' => 'form-control','id'=>'p_utuh_butir','placeholder'=>'Produksi Utuh (TB&TS)']) !!}
                    {!! $errors->first('p_utuh_butir', '<p class="help-block">:message</p>') !!}
                </div>
                {!! Form::label('gr_butir', 'Gram/Butir', ['class' => 'col-sm-2 control-label']) !!}
                <div class="col-sm-4">
                    {!! Form::text('gr_butir', null, ['class' => 'form-control','id'=>'gr_butir','placeholder'=>'Gram/Butir']) !!}
                    {!! $errors->first('gr_butir', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('p_utuh_kg') ? 'has-error' : ''}}">
                {!! Form::label('p_utuh_kg', 'Utuh (Kg)', ['class' => 'col-sm-2 control-label']) !!}
                <div class="col-sm-4">
                    {!! Form::text('p_utuh_kg', null, ['class' => 'form-control','id'=>'p_utuh_kg','placeholder'=>'Produksi Utuh (Kg)']) !!}
                    {!! $errors->first('p_utuh_kg', '<p class="help-block">:message</p>') !!}
                </div>
                {!! Form::label('kg_1000', 'Kg/1000', ['class' => 'col-sm-2 control-label']) !!}
                <div class="col-sm-4">
                    {!! Form::text('kg_1000', null, ['class' => 'form-control','id'=>'kg_1000','placeholder'=>'Kg/1000']) !!}
                    {!! $errors->first('kg_1000', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group">
                
                {!! Form::label('p_putih_butir', 'Putih (Butir)', ['class' => 'col-sm-2 control-label']) !!}
                <div class="col-sm-4">
                    {!! Form::text('p_putih_butir', null, ['class' => 'form-control','id' => 'p_putih_butir','placeholder' => 'Putih (Butir)']) !!}
                    {!! $errors->first('p_putih_butir', '<p class="help-block">:message</p>') !!}
                </div>
                {!! Form::label('hd', 'Hd', ['class' => 'col-sm-2 control-label']) !!}
                <div class="col-sm-4">
                    {!! Form::text('hd', null, ['class' => 'form-control','id' => 'hd','placeholder'=> 'Hd']) !!}
                    {!! $errors->first('hd', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('p_putih_kg') ? 'has-error' : ''}}">
               
                {!! Form::label('p_putih_kg', 'Putih (Kg)', ['class' => 'col-sm-2 control-label']) !!}
                <div class="col-sm-4">
                    {!! Form::text('p_putih_kg', null, ['class' => 'form-control','id' => 'p_putih_kg', 'placeholder'=>'Putih (Kg)']) !!}
                    {!! $errors->first('p_putih_kg', '<p class="help-block">:message</p>') !!}
                </div>
                {!! Form::label('fc', 'Fc', ['class' => 'col-sm-2 control-label']) !!}
                <div class="col-sm-4">
                    {!! Form::text('fc', null, ['class' => 'form-control','id'=>'fc','placeholder'=>'Fc']) !!}
                    {!! $errors->first('fc', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('p_jml_butir') ? 'has-error' : ''}}">
            {!! Form::label('p_retak_butir', 'Retak (Butir)', ['class' => 'col-sm-2 control-label']) !!}
                <div class="col-sm-4">
                    {!! Form::text('p_retak_butir', null, ['class' => 'form-control','id' => 'p_retak_butir','placeholder' => 'Retak (Butir)']) !!}
                    {!! $errors->first('p_retak_butir', '<p class="help-block">:message</p>') !!}
                </div>
            {!! Form::label('p_jml_butir', 'Total (Butir)', ['class' => 'col-sm-2 control-label']) !!}
                <div class="col-sm-4">
                    {!! Form::text('p_jml_butir', null, ['class' => 'form-control','id' => 'p_jml_butir','placeholder' => 'Jml.Akhir (Butir)']) !!}
                    {!! $errors->first('p_jml_butir', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('p_jml_kg') ? 'has-error' : ''}}">
            {!! Form::label('p_retak_kg', 'Retak (Kg)', ['class' => 'col-sm-2 control-label']) !!}
                <div class="col-sm-4">
                    {!! Form::text('p_retak_kg', null, ['class' => 'form-control','id'=>'p_retak_kg','placeholder'=>'Retak (Kg)']) !!}
                    {!! $errors->first('p_retak_kg', '<p class="help-block">:message</p>') !!}
                </div>
            {!! Form::label('p_jml_kg', 'Total (Kg)', ['class' => 'col-sm-2 control-label']) !!}
                <div class="col-sm-4">
                    {!! Form::text('p_jml_kg', null, ['class' => 'form-control','id'=>'p_jml_kg','placeholder'=>'Jml.Akhir (Kg)']) !!}
                    {!! $errors->first('p_jml_kg', '<p class="help-block">:message</p>') !!}
                </div>
            </div>

    <div class="form-group">
<a href="{{ url('produksi') }}" class="detail2 btn btn-md btn-outline btn-danger pull-right">  <i class="fa fa-times-circle" ></i> Cancel</a>
      <button type="submit" class="create_mdl btn btn-outline btn-primary pull-right" style="margin-right: 10px; ">
                        <i class="fa fa-plus-circle"></i>  Create
                      </button>
                      
      </a>

      <a id="kal" class="btn btn-warning btn pull-left  btn-outline "  style="margin-right: 5px;"><i class="fa fa-refresh"></i> Kalkukasi</a>
               
    </div>
    </div>
    </div>
    {!! Form::close() !!}
  </div>
</div>
</div>

@endsection

@section('script')
{{ HTML::script('assets_back/js/plugins/chosen/chosen.jquery.js') }}
{{ HTML::script('assets_back/js/plugins/select2/select2.full.min.js') }}
{{ HTML::script('assets_back/js/plugins/datapicker/bootstrap-datepicker.js') }}

<script>
   $(document).ready(function () {

    var config = {
                '.chosen-select'           : {},
                '.chosen-select-deselect'  : {allow_single_deselect:true},
                '.chosen-select-no-single' : {disable_search_threshold:10},
                '.chosen-select-no-results': {no_results_text:'Oops, nothing found!'},
                '.chosen-select-width'     : {width:"95%"}
                }
            for (var selector in config) {
                $(selector).chosen(config[selector]);
            }


            $("#kal").on("click", function(){

            calc();

            });

            function calc(){

                p_jml_butir =  Number($("#p_utuh_butir").val())  + Number($("#p_putih_butir").val()) + Number($("#p_retak_butir").val());
                $("#p_jml_butir").val(p_jml_butir);

                p_jml_kg =  Number($("#p_utuh_kg").val())  + Number($("#p_putih_kg").val()) + Number($("#p_retak_kg").val());
                $("#p_jml_kg").val(p_jml_kg);

                gr_butir = Number(p_jml_kg/p_jml_butir * 1000);
                $("#gr_butir").val(gr_butir);

                kg_1000 = Number(p_jml_kg/ Number($("#jml_akhir").val()) * 1000);
                $("#kg_1000").val(kg_1000);

                hd = Number(p_jml_butir/ Number($("#jml_akhir").val()) * 100);
                $("#hd").val(hd);

                fc = Number(Number($("#pakan_qty").val()) / p_jml_kg);
                $("#fc").val(fc);

            
            }


});

$("#prod_tgl").datepicker({
              startDate : '-0m',
              format :  'yyyy-mm-dd',
              keyboardNavigation : false,
              forceParce: false,
              todayBtn: 'linked',
              todayHighlight :  true,
              daysOfWeekDisabled : [0],
            });
</script>

@endsection
