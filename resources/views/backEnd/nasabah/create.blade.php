@extends('backLayout.app')
@section('title')
Nasabah
@stop
@section('desc')
Tambah Baru
@stop
@section('style')
  {{ HTML::style('assets_back/css/plugins/iCheck/custom.css') }}
  {{ HTML::style('assets_back/css/plugins/chosen/chosen.css')}}
@endsection
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
            <a href="{{ url('nasabah') }}"> Nasabah</a>
        </li>
        
        <li class="">
                <a href="#">
                    Tambah Baru
                </a>
        </li>
    </ol>
            <a href="{{ url('nasabah') }}">
            <button class="btn btn-sm btn-outline btn-primary pull-right">
            <i class="fa fa-arrow-circle-o-left" style="margin-right: 5px"></i> Back
            </button>
            </a>
    </div>
<div class="row ibox-content" style="min-height: 65vh; ">
	<div class="col-xs-12 col-sm-12">
    {!! Form::open(['url' => 'nasabah', 'class' => 'form-horizontal']) !!}
    {!! Form::hidden('created_by', Sentinel::getUser()->id, ['class' => 'form-control']) !!}
    {!! Form::hidden('updated_by', Sentinel::getUser()->id, ['class' => 'form-control']) !!}
    {!! Form::hidden('status', 3, ['class' => 'form-control']) !!}
             <div class="form-group {{ $errors->has('group_code') ? 'has-error' : ''}}">
                {!! Form::label('group_code', 'Unit*', ['class' => 'col-sm-2 control-label']) !!}
                <div class="col-sm-3">
                <select  name="group_code" class="col-sm-12 form-control group chosen-select" data-placeholder="Pilih Kelompok Anggota" id="group" width="100%">
                                  <option value=""></option>
                                  @foreach($groups as $group)
                                    <option value="{{$group->code}}">{{$group->code}} - {{$group->name}}</option>
                                  @endforeach
                                </select>
                    {!! $errors->first('group_code', '<p class="help-block">:message</p>') !!}
                </div>
                {!! Form::label('norek', 'No.Rekening', ['class' => 'col-sm-2 control-label']) !!}
                <div class="col-sm-3">
                    {!! Form::text('norek', null, ['class' => 'form-control','id'=>'norek','readonly']) !!}
                    {!! $errors->first('norek', '<p class="help-block">:message</p>') !!}
                </div>

             </div>
             <div class="hr-line-dashed"></div>
            
            <div class="form-group  {{ $errors->has('jenis_nasabah') ? 'has-error' : ''}}">
                {!! Form::label('jenis_nasabah', 'Jenis Nasabah*', ['class' => 'col-sm-2 control-label']) !!}
                    <div class="col-sm-3">
                        <label class="i-checks"> 
                            <input type="radio" value="Perorangan" name="jenis_nasabah" id="Perorangan"> <i></i> Perorangan
                        </label>
                        &nbsp;&nbsp;
                        <label class="i-checks"s> 
                            <input type="radio"  value="Unit" name="jenis_nasabah" id="Binaan"> Unit
                        </label>
                        {!! $errors->first('jenis_nasabah', '<p class="help-block">:message</p>') !!}
                    </div>                                    
            </div>
             <div class="hr-line-dashed"></div>
             <div class="form-group {{ $errors->has('nama_depan') ? 'has-error' : ''}}">
                {!! Form::label('nama_depan', 'Nama Nasabah*', ['class' => 'col-sm-2 control-label']) !!}
                <div class="col-sm-8">
                    {!! Form::text('nama_depan', null, ['class' => 'form-control','placeholder'=>'Nama  Nasabah.']) !!}
                    {!! $errors->first('nama_depan', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class ="dataBinaan">
              <div class="hr-line-dashed"></div>
            <div class="form-group">
                {!! Form::label('pic', 'PIC Unit', ['class' => 'col-sm-2 control-label']) !!}
                <div class="col-sm-8">
                    {!! Form::text('pic', null, ['class' => 'form-control','placeholder'=>'PIC/Penanggung Jawab Nasabah Binaan. ']) !!}
                    {!! $errors->first('pic', '<p class="help-block">:message</p>') !!}
                </div>
                                       
            </div>
            </div>
       
             <div class="hr-line-dashed"></div>
            <div class="form-group {{ $errors->has('tipe_identitas') ? 'has-error' : ''}}">
                {!! Form::label('tipe_identitas', 'Identitas*', ['class' => 'col-sm-2 control-label']) !!}
                    <div class="col-sm-8">
                        <div class="i-checks">
                        <label> 
                            <input type="radio" value="KTP" name="tipe_identitas"> <i></i> KTP
                        </label> &nbsp;
                        <label> 
                            <input type="radio" value="SIM" name="tipe_identitas"> <i></i> SIM
                        </label> &nbsp;
                        <label class="i-checks"s> 
                            <input type="radio" value="Paspor" name="tipe_identitas"> Paspor
                        </label> &nbsp;
                        <label class="i-checks"s> 
                            <input type="radio"  value="Kartu Pelajar/Mahasiswa" name="tipe_identitas"> Kartu Pelajar/Mahasiswa
                        </label>
                        </div>
                        
                        {!! $errors->first('tipe_identitas', '<p class="help-block">:message</p>') !!}
                    </div>
            </div>
            <div class="hr-line-dashed"></div>
            <div class="form-group {{ $errors->has('no_identitas') ? 'has-error' : ''}}">
                {!! Form::label('no_identitas', 'No. Identitas*', ['class' => 'col-sm-2 control-label']) !!}
                <div class="col-sm-8">
                    {!! Form::text('no_identitas', null, ['class' => 'form-control','placeholder'=>'No. Identitas Calon Nasabah/PIC Binaan. ']) !!}
                    {!! $errors->first('no_identitas', '<p class="help-block">:message</p>') !!}
                </div>
                                       
            </div>
          <div class="hr-line-dashed"></div>
         <div class="form-group">
                {!! Form::label('no_telp', 'No.Telepon', ['class' => 'col-sm-2 control-label']) !!}
                <div class="col-sm-8">
                    {!! Form::text('no_telp', null, ['class' => 'form-control','data-mask' => '(999) 999-9999','placeholder'=>'No. Telp Calon Nasabah/PIC Binaan.']) !!}
                    {!! $errors->first('no_telp', '<p class="help-block">:message</p>') !!}
                </div>
               
                                       
            </div>
            <div class="hr-line-dashed"></div>
            <div class="dataPerorangan">
            <div class="form-group {{ $errors->has('pekerjaan') ? 'has-error' : ''}}">
                {!! Form::label('pekerjaan', 'Pekerjaan', ['class' => 'col-sm-2 control-label']) !!}
                <div class="col-sm-8">
                    {!! Form::text('pekerjaan', null, ['class' => 'form-control','placeholder'=>'Pekerjaan.']) !!}
                    {!! $errors->first('pekerjaan', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="hr-line-dashed"></div>
            <div class="form-group {{ $errors->has('organisasi') ? 'has-error' : ''}}">
                {!! Form::label('organisasi', 'Organisasi', ['class' => 'col-sm-2 control-label']) !!}
                <div class="col-sm-8">
                    {!! Form::text('organisasi', null, ['class' => 'form-control','placeholder'=>'Organisasi/Perusahaan.']) !!}
                    {!! $errors->first('organisasi', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
           <div class="hr-line-dashed"></div>
         </div>
           <div class="form-group ">
                {!! Form::label('alamat', 'Alamat', ['class' => 'col-sm-2  control-label']) !!}
                <div class="col-sm-8 col-xs-12 {{ $errors->has('alamat') ? 'has-error' : ''}}">
                  {!! Form::textarea('alamat', null, ['class' => 'form-control', 'rows' => '2', 'placeholder' => 'Alamat Nasabah [Max: 500 Katakter]']) !!}
                  {!! $errors->first('alamat', '<p class="help-block">:message</p>') !!}
                </div>
         </div>
         <div class="hr-line-dashed"></div>
           <div class="form-group ">
                {!! Form::label('keterangan', 'Keterangan', ['class' => 'col-sm-2 control-label']) !!}
                <div class="col-sm-8 col-xs-12 {{ $errors->has('notes') ? 'has-error' : ''}}">
                  {!! Form::textarea('keterangan', null, ['class' => 'form-control', 'rows' => '2', 'placeholder' => 'Keterangan [Max: 500 Katakter]']) !!}
                  {!! $errors->first('keterangan', '<p class="help-block">:message</p>') !!}
                </div>               
            </div>
       
            



    <div class="form-group">
<a href="{{ url('nasabah') }}" class="detail2 btn btn-md btn-outline btn-danger pull-right">  <i class="fa fa-times-circle" ></i> Batal</a>
      <button type="submit" class="create_mdl btn btn-outline btn-success pull-right" style="margin-right: 20px; ">
                        <i class="fa fa-plus-circle"></i>  Tambah
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
{{ HTML::script('assets_back/js/plugins/iCheck/icheck.min.js') }}
{{ HTML::script('assets_back/js/plugins/chosen/chosen.jquery.js') }}
<script>
            $(document).ready(function () {
                var config = {
                              '.chosen-select'           : {search_contains: true },
                              '.chosen-select-deselect'  : {allow_single_deselect:true},
                              '.chosen-select-no-single' : {disable_search_threshold:10},
                              '.chosen-select-no-results': {no_results_text:'Oops, nothing found!'},
                              '.chosen-select-width'     : {width:"95%"}
                              }
                          for (var selector in config) {
                              $(selector).chosen(config[selector]);
                          }
        var APP_URL = {!! json_encode(url('/')) !!}
        $('.group').on('change', function(e){

     if ($(this).find(':selected').val() != '') {
       
            // GET NOREK
         var val     = $(this).find(':selected').val(),
             item_d  = $(this).find(':selected').data(),
             url     =  '{{url("/getnorek?group_id=")}}'+val;

          // alert(val);
           $.ajax({
               url : url,
               type: "GET",
               dataType: 'html',
               success: function(datas){
                   //$('.norek_chosen').html(datas);
                   $('#norek').val(datas);
                   return false;
               }
           });
           //END GET NOREK
 
    
     }


   });
        $('.dataPerorangan').show();
        $('.dataBinaan').hide();

              $('#Perorangan').on('ifClicked', function (event){

                $('.dataPerorangan').slideDown('slow');
                $('.dataBinaan').slideUp('slow');
              
               });

              $('#Binaan').on('ifClicked', function (event){
                $('.dataPerorangan').slideUp('slow');
                $('.dataBinaan').slideDown('slow');
              });


                $('.i-checks').iCheck({
                    checkboxClass: 'icheckbox_square-green',
                    radioClass: 'iradio_square-green',
                });

            });
</script>
@endsection
