@section('style')
  <style>
    .ibox { margin: 1px 2px 0px 0px !important }
    .ibox.float-e-margins{ margin: 0px 2px !important}
  </style>
  {{ HTML::style('assets_back/css/plugins/chosen/chosen.css')}}
  {{ HTML::style('assets_back/css/plugins/datapicker/datepicker3.css')}}
@endsection
@extends('backLayout.app')
@section('title')
@if($id == 0) Kategori @else Barang @endif
@stop
@section('desc')
Tambah Baru
@stop
@section('content')
  <div class="wrapper wrapper-content">
  	<div class="row detail_content3">
  	  <div class="col-lg-12 detail_content2" style="background-color: white">
        <div class="row ibox-title">
         <ol class="breadcrumb col-sm-6 col-xs-12" style="font-size: 14px; padding-top: 6px; ">
            <li class="">
            @if($id == 0) <a href="{{ url('kategori') }}"> Data Kategori</a> @else <a href="{{ url('item') }}"> Data Barang</a> @endif
             
            </li>
            <li class="active">
              Tambah Baru
            </li>
          </ol>
          <a href="{{ url()->previous() }}">
            <button class="btn btn-sm btn-outline btn-primary pull-right">
              <i class="fa fa-arrow-circle-o-left" style="margin-right: 5px"></i> Back
            </button>
          </a>
        </div>
        <div class="row ibox-content" style="min-height: 65vh; ">
          <div class="col-xs-12 col-sm-12">
            {!! Form::open(['url' => 'item', 'class' => 'form-horizontal','files'=>'true']) !!}
              {!! Form::hidden('created_by', Sentinel::getUser()->id, ['class' => 'form-control']) !!}
              <h4>Informasi Umum</h4>
              <div class="form-group ">
                {!! Form::label('code', 'Kode*', ['class' => 'col-sm-1 control-label']) !!}
                <div class="col-sm-5 {{ $errors->has('code') ? 'has-error' : ''}}">
                  {!! Form::text('code', null, ['class' => 'form-control', 'placeholder' => 'Kode/Singkatan.']) !!}
                  {!! $errors->first('code', '<p class="help-block">:message</p>') !!}
                </div>
                @if($id != 0 )
                 {!! Form::label('categories', 'Kategori*', ['class' => 'col-sm-1 control-label']) !!}
                <div class="col-sm-5 {{ $errors->has('item') ? 'has-error' : ''}}">
                  <div class="input-group col-sm-12 col-xs-12 ">
                    <select class="form-control m-b chosen-select" name="item">
                        @foreach($categories  as $item)
                              @if($item->nesting==0)
                                   <option value="{{$item->id}}">{{$item->name}}</option> 
                              @endif
                        @endforeach
                    </select>
                  </div>
                  {!! $errors->first('item', '<p class="help-block">:message</p>') !!}
                </div>
                @endif
              </div>
              <div class="form-group">
               {!! Form::label('name', 'Nama*', ['class' => 'col-sm-1 control-label']) !!}
                <div class="col-sm-5 {{ $errors->has('name') ? 'has-error' : ''}}">
                  {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Nama [Max: 50 Katakter]']) !!}
                  {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
                </div>
                @if($id != 0 )
                {!! Form::label('satuan', 'Satuan*', ['class' => 'col-sm-1 control-label']) !!}
                <div class="col-sm-5 {{ $errors->has('satuan') ? 'has-error' : ''}}">
                  {{ Form::select('satuan', $satuans, null, ['class' => 'form-control chosen-select','placeholder' => 'Pilih Satuan']) }}
                  {!! $errors->first('satuan', '<p class="help-block">:message</p>') !!}
                </div>
                @endif
                
              </div>
            
              <div class="form-group">
                {!! Form::label('note', 'Deskripsi', ['class' => 'col-sm-1 control-label']) !!}
                <div class="col-sm-5 col-xs-12">
                  {!! Form::textarea('note', null, ['class' => 'form-control', 'rows' => '2', 'placeholder' => 'Deskripsi [Max: 500 Katakter]']) !!}
                  {!! $errors->first('note', '<p class="help-block">:message</p>') !!}
                </div>
                @if($id != 0 )
                {!! Form::label('supplier', 'Supplier', ['class' => 'col-sm-1 control-label']) !!}
                <div class="col-sm-5 col-xs-12">
                  {{ Form::select('supplier', $suppliers, null, ['class' => 'form-control chosen-select','placeholder' => 'Pilih Supplier']) }}
                  {!! $errors->first('supplier', '<p class="help-block">:message</p>') !!}
                  <small>*khusus supplier obat&pakan</small>
                </div>
                @endif
                
              </div>
              @if($id != 0 )
                <br/>
              <h4>Informasi Atribut</h4>
              <div class="form-group ">
                {!! Form::label('dimensi', 'Dimensi', ['class' => 'col-sm-1 control-label']) !!}
                <div class="col-sm-2 {{ $errors->has('panjang') ? 'has-error' : ''}}">
                  {!! Form::text('panjang', null, ['class' => 'form-control', 'placeholder' => 'Panjang']) !!}
                  {!! $errors->first('panjang', '<p class="help-block">:message</p>') !!}
                </div>
                <div class="col-sm-2 {{ $errors->has('lebar') ? 'has-error' : ''}}">
                  {!! Form::text('lebar', null, ['class' => 'form-control', 'placeholder' => 'Lebar']) !!}
                  {!! $errors->first('lebar', '<p class="help-block">:message</p>') !!}
                </div>
                <div class="col-sm-2 {{ $errors->has('tinggi') ? 'has-error' : ''}}">
                  {!! Form::text('tinggi', null, ['class' => 'form-control', 'placeholder' => 'Tinggi']) !!}
                  {!! $errors->first('tinggi', '<p class="help-block">:message</p>') !!}
                </div>
              </div>
              <div class="form-group ">
              <div class="col-sm-1"></div>
              <div class="col-sm-3 col-xs-12">
                  {{ Form::select('dimensi_unit', ['cm','m'], null, ['class' => 'form-control','placeholder' => 'Ukuran Dimensi']) }}
                  {!! $errors->first('dimensi_unit', '<p class="help-block">:message</p>') !!}
              </div>
              </div>

              <div class="form-group ">
                {!! Form::label('berat', 'Berat', ['class' => 'col-sm-1 control-label']) !!}
                <div class="col-sm-2 {{ $errors->has('panjang') ? 'has-error' : ''}}">
                  {!! Form::text('berat', null, ['class' => 'form-control', 'placeholder' => 'Berat']) !!}
                  {!! $errors->first('berat', '<p class="help-block">:message</p>') !!}
                </div>
              </div>
              <div class="form-group ">
              <div class="col-sm-1"></div>
              <div class="col-sm-3 col-xs-12">
                  {{ Form::select('berat_unit', ['gr','kg'], null, ['class' => 'form-control','placeholder' => 'Ukuran Berat']) }}
                  {!! $errors->first('satuan', '<p class="help-block">:message</p>') !!}
              </div>
              </div>

              <div class="form-group ">
                {!! Form::label('kapasitas', 'Kapasitas', ['class' => 'col-sm-1 control-label']) !!}
                <div class="col-sm-2 {{ $errors->has('kapasitas') ? 'has-error' : ''}}">
                  {!! Form::text('kapasitas', null, ['class' => 'form-control', 'placeholder' => 'Kapasitas']) !!}
                  {!! $errors->first('kapasitas', '<p class="help-block">:message</p>') !!}
                </div>
              </div>
              <div class="form-group ">
              <div class="col-sm-1"></div>
              <div class="col-sm-3 col-xs-12">
                  {{ Form::select('kapasitas_unit', ['ml','l'], null, ['class' => 'form-control','placeholder' => 'Ukuran Kapasitas']) }}
                  {!! $errors->first('kapasitas_unit', '<p class="help-block">:message</p>') !!}
              </div>
              </div>
              <br/>
              <h4>Informasi Kendali Persediaan</h4>
              <div class="form-group">
               {!! Form::label('minimum_stock', 'Minimun', ['class' => 'col-sm-1 control-label']) !!}
                <div class="col-sm-5 {{ $errors->has('minimum_stock') ? 'has-error' : ''}}">
                  {!! Form::text('minimum_stock', null, ['class' => 'form-control', 'placeholder' => 'Minimun Stock']) !!}
                  {!! $errors->first('minimum_stock', '<p class="help-block">:message</p>') !!}
                </div>
              </div>
              <div class="form-group">
              {!! Form::label('maksimum_stock', 'Maksimum', ['class' => 'col-sm-1 control-label']) !!}
                <div class="col-sm-5 {{ $errors->has('maksimum_stock') ? 'has-error' : ''}}">
                  {!! Form::text('maksimum_stock', null, ['class' => 'form-control', 'placeholder' => 'Maksimum Stock']) !!}
                  {!! $errors->first('maksimum_stock', '<p class="help-block">:message</p>') !!}
                </div>
              </div>
              @endif
              <div class="form-group">
                <a href="{{ url()->previous() }}" class="detail2 btn btn-md btn-outline btn-danger pull-right">  <i class="fa fa-times-circle" ></i> Batal</a>
                  <button type="submit" class="create_mdl btn btn-outline btn-success pull-right" style="margin-right: 10px; ">
                    <i class="fa fa-plus-circle"></i>  Simpan
                  </button>
                </a>
              </div>
            {!! Form::close() !!}
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
@section('script')
 {{ HTML::script('assets_back/js/plugins/chosen/chosen.jquery.js') }}
 {{ HTML::script('assets_back/js/plugins/inputmask/jquery.inputmask.bundle.js') }}
 {{ HTML::script('assets_back/js/plugins/datapicker/bootstrap-datepicker.js') }}
<!-- Page-Level Scripts -->
<script>
    $(document).ready(function(){
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

$('#price').inputmask("numeric", {
    radixPoint: ".",
    groupSeparator: ",",
    digits: 2,
    autoGroup: true,
    prefix: 'Rp.', 
    rightAlign: false,
    removeMaskOnSubmit: true,
    oncleared: function () { self.Value(''); }
});
$('#price2').inputmask("numeric", {
    radixPoint: ".",
    groupSeparator: ",",
    digits: 2,
    autoGroup: true,
    prefix: 'Rp.', 
    rightAlign: false,
    removeMaskOnSubmit: true,
    oncleared: function () { self.Value(''); }
});
$("#expire_date").datepicker({
              format :  'yyyy-mm-dd',
              keyboardNavigation : false,
              forceParce: false,
              todayBtn: 'linked',
              todayHighlight :  true,
              daysOfWeekDisabled : [0],
            });

      function readURL(input) {

if (input.files && input.files[0]) {
    var reader = new FileReader();

    reader.onload = function (e) {
        $('#imagePreview').attr('src', e.target.result);
    }

    reader.readAsDataURL(input.files[0]);
}
}

$("#inputImage").change(function(){
readURL(this);
});
        });
</script>
@endsection
