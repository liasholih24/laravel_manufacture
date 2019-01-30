@extends('backLayout.app')
@section('title')
Harga Pokok
@stop
@section('desc')
Buat Baru
@stop
@section('style')
  {{ HTML::style('assets_back/css/plugins/select2/select2.min.css')}}
  {{ HTML::style('assets_back/css/plugins/datapicker/datepicker3.css')}}
  {{ HTML::script('assets_back/js/inputmask/jquery.inputmask.bundle.js') }}
@endsection
@section('content')
<div class="wrapper wrapper-content">
					<div class="row detail_content3">
	<div class="col-lg-12 detail_content2" style="background-color: white"><style>
						.ibox { margin: 1px 2px 0px 0px !important }
						.ibox.float-e-margins{ margin: 0px 2px !important}
						</style>
      <div class="row ibox-title">
   <ol class="breadcrumb col-sm-4 col-xs-12" style="font-size: 14px; padding-top: 6px; ">
        <li class="">
            <a href="{{ url('hargapokok') }}"> Hargapokok
        </li>
        /
        <li class="">
                <a href="#">
                    Add New
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
    {!! Form::open(['url' => 'hargapokok', 'class' => 'form-horizontal']) !!}
    {!! Form::hidden('created_by', Sentinel::getUser()->id, ['class' => 'form-control']) !!}
    <h4>TOTAL & HPP</h4>
            <div class="form-group">
                {!! Form::label('tgl_hpp', 'Tanggal', ['class' => 'col-sm-2 control-label']) !!}
                <div class="col-sm-4">
                    {!! Form::text('tgl_hpp', $datenow, ['id'=>'tgl_hpp','class' => 'form-control']) !!}
                    {!! $errors->first('tgl_hpp', '<p class="help-block">:message</p>') !!}
                </div>
                {!! Form::label('ttl_biaya', 'Total Biaya', ['class' => 'col-sm-2 control-label']) !!}
                <div class="col-sm-4">
                    {!! Form::text('ttl_biaya', null, ['class' => 'form-control Numeric','id'=>'t_biaya','placeholder'=>'Total Biaya','readonly'=>'readonly']) !!}
                    {!! $errors->first('ttl_biaya', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group ">
                {!! Form::label('hpp', 'HPP', ['class' => 'col-sm-2 control-label']) !!}
                <div class="col-sm-4">
                    {!! Form::text('hpp', null, ['class' => 'form-control Numeric','id'=>'hpp','placeholder'=>'HPP','readonly'=>'readonly']) !!}
                    {!! $errors->first('hpp', '<p class="help-block">:message</p>') !!}
                </div>
                {!! Form::label('ttl_produksi', 'Total Produksi', ['class' => 'col-sm-2 control-label']) !!}
                <div class="col-sm-4">
                    {!! Form::text('ttl_produksi', null, ['class' => 'form-control Numeric','id'=>'t_produksi','placeholder'=>'Total Produksi','readonly'=>'readonly']) !!}
                    {!! $errors->first('ttl_produksi', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="hr-line-dashed"></div>

            <h4>Produksi (Kg)</h4>
             <div class="form-group {{ $errors->has('t_utuh') ? 'has-error' : ''}}">
                {!! Form::label('t_utuh', 'Telur Utuh', ['class' => 'col-sm-2 control-label']) !!}
                <div class="col-sm-4">
                    {!! Form::text('t_utuh', null, ['class' => 'form-control Numeric Produksi ','placeholder'=>'Telur Utuh']) !!}
                    {!! $errors->first('t_utuh', '<p class="help-block">:message</p>') !!}
                </div>
                {!! Form::label('t_rusak', 'Telur Rusak', ['class' => 'col-sm-2 control-label']) !!}
                <div class="col-sm-4">
                    {!! Form::text('t_rusak', null, ['class' => 'form-control Numeric Produksi','placeholder'=>'Telur Rusak']) !!}
                    {!! $errors->first('t_rusak', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="hr-line-dashed"></div>
            <h4>Biaya Produksi</h4>
            <div class="form-group {{ $errors->has('b_gaji_kandang') ? 'has-error' : ''}}">
                {!! Form::label('b_gaji_kandang', 'Gaji Kandang', ['class' => 'col-sm-2 control-label']) !!}
                <div class="col-sm-4">
                    {!! Form::text('b_gaji_kandang', null, ['class' => 'form-control Numeric Biaya ','placeholder'=>'Gaji Mingguan Kandang']) !!}
                    {!! $errors->first('b_gaji_kandang', '<p class="help-block">:message</p>') !!}
                </div>
                {!! Form::label('b_pakan', 'Pakan', ['class' => 'col-sm-2 control-label']) !!}
                <div class="col-sm-4">
                    {!! Form::text('b_pakan', null, ['class' => 'form-control Numeric Biaya ','placeholder'=>'Pemakaian Pakan']) !!}
                    {!! $errors->first('b_pakan', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('b_gaji_angkutan') ? 'has-error' : ''}}">
                {!! Form::label('b_gaji_angkutan', 'Gaji Angkutan', ['class' => 'col-sm-2 control-label']) !!}
                <div class="col-sm-4">
                    {!! Form::text('b_gaji_angkutan', null, ['class' => 'form-control Numeric Biaya ','placeholder'=>'Gaji Mingguan Angkutan']) !!}
                    {!! $errors->first('b_gaji_angkutan', '<p class="help-block">:message</p>') !!}
                </div>
                {!! Form::label('b_obat', 'Obat', ['class' => 'col-sm-2 control-label']) !!}
                <div class="col-sm-4">
                    {!! Form::text('b_obat', null, ['class' => 'form-control Numeric Biaya ','placeholder'=>'Pemakaian Obat']) !!}
                    {!! $errors->first('b_obat', '<p class="help-block">:message</p>') !!}
                </div>
               
            </div>
            <div class="form-group {{ $errors->has('b_lembur') ? 'has-error' : ''}}">
                {!! Form::label('b_lembur', 'Lembur', ['class' => 'col-sm-2 control-label']) !!}
                <div class="col-sm-4">
                    {!! Form::text('b_lembur', null, ['class' => 'form-control Biaya Numeric','placeholder'=>'Lembur Karyawan']) !!}
                    {!! $errors->first('b_lembur', '<p class="help-block">:message</p>') !!}
                </div>
                {!! Form::label('b_listrik', 'Listrik', ['class' => 'col-sm-2 control-label']) !!}
                <div class="col-sm-4">
                    {!! Form::text('b_listrik', null, ['class' => 'form-control Biaya Numeric','placeholder'=>'Listrik Industri']) !!}
                    {!! $errors->first('b_listrik', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('b_transpakan') ? 'has-error' : ''}}">
                {!! Form::label('b_transpakan', 'Transport', ['class' => 'col-sm-2 control-label']) !!}
                <div class="col-sm-4">
                    {!! Form::text('b_transpakan', null, ['class' => 'form-control Biaya Numeric','placeholder'=>'Transport Pakan']) !!}
                    {!! $errors->first('b_transpakan', '<p class="help-block">:message</p>') !!}
                </div>
                {!! Form::label('b_servis', 'Servis', ['class' => 'col-sm-2 control-label']) !!}
                <div class="col-sm-4">
                    {!! Form::text('b_servis', null, ['class' => 'form-control Biaya Numeric','placeholder'=>'Servis Listrik']) !!}
                    {!! $errors->first('b_servis', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('b_prodadmin') ? 'has-error' : ''}}">
                {!! Form::label('b_prodadmin', 'Administrasi', ['class' => 'col-sm-2 control-label']) !!}
                <div class="col-sm-4">
                    {!! Form::text('b_prodadmin', null, ['class' => 'form-control Biaya Numeric','placeholder'=>'Biaya Produksi + Administrasi']) !!}
                    {!! $errors->first('b_prodadmin', '<p class="help-block">:message</p>') !!}
                </div>
                {!! Form::label('b_bongkar', 'Bongkar Muat', ['class' => 'col-sm-2 control-label']) !!}
                <div class="col-sm-4">
                    {!! Form::text('b_bongkar', null, ['class' => 'form-control Biaya Numeric','placeholder'=>'Bongkar Muat']) !!}
                    {!! $errors->first('b_bongkar', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('b_penyusutan') ? 'has-error' : ''}}">
                {!! Form::label('b_penyusutan', 'Penyusutan', ['class' => 'col-sm-2 control-label']) !!}
                <div class="col-sm-4">
                    {!! Form::text('b_penyusutan', null, ['class' => 'form-control Biaya Numeric','placeholder'=>'Biaya Produksi + Administrasi + Penyusutan']) !!}
                    {!! $errors->first('b_penyusutan', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
      
        <div class="hr-line-dashed"></div>


    <div class="form-group">
<a href="{{ url('hargapokok') }}" class="detail2 btn btn-md btn-outline btn-danger pull-right">  <i class="fa fa-times-circle" ></i> Cancel</a>
      <button type="submit" class="create_mdl btn btn-outline btn-primary pull-right" style="margin-right: 20px; ">
                        <i class="fa fa-plus-circle"></i>  Create
                      </button>
      </a>
    </div>
    </div>
    </div>
    {!! Form::close() !!}
  </div>
</div>
</div>

@endsection
@section('script')
{{ HTML::script('assets_back/js/inputmask/jquery.inputmask.bundle.js') }}
{{ HTML::script('assets_back/js/plugins/datapicker/bootstrap-datepicker.js') }}
<script>
$(document).ready(function () {

    $('.Numeric').inputmask("numeric", {
    radixPoint: ".",
    groupSeparator: ",",
    digits: 2,
    autoGroup: true,
    rightAlign: false,
    removeMaskOnSubmit: true,
    oncleared: function () { self.Value(''); }
});

    function calc(){
        var sum1 = 0;
        $('.Biaya').each(function() {
            sum1 += Number(String($(this).val()).replace(/[^0-9]/g, ''));
        
        });
        $('#t_biaya').val(sum1);

        var sum2 = 0;

        $('.Produksi').each(function() {
            sum2 += Number(String($(this).val()).replace(/[^0-9]/g, ''));
        });
        $('#t_produksi').val(sum2);


        var hpp = 0;
        hpp = Number(sum1) / Number(sum2) ;
        $('#hpp').val(hpp.toFixed(0));
    }

    $(".Biaya").on("change", function(){

        calc();
    });

    $(".Produksi").on("change", function(){

        calc();
    });


});
$("#tgl_hpp").datepicker({
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
