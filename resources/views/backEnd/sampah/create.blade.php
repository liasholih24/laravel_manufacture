@section('style')
  <style>
    .ibox { margin: 1px 2px 0px 0px !important }
    .ibox.float-e-margins{ margin: 0px 2px !important}
  </style>
  {{ HTML::style('assets_back/css/plugins/chosen/chosen.css')}}
@endsection
@extends('backLayout.app')
@section('title')
Data Barang
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
              <a href="{{ url('sampah') }}"> Data Barang</a>
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
            {!! Form::open(['url' => 'sampah', 'class' => 'form-horizontal']) !!}
              {!! Form::hidden('created_by', Sentinel::getUser()->id, ['class' => 'form-control']) !!}
                {!! Form::hidden('updated_by', Sentinel::getUser()->id, ['class' => 'form-control']) !!}

              <div class="form-group ">
                {!! Form::label('code', 'Kode*', ['class' => 'col-sm-1 control-label']) !!}
                <div class="col-sm-5 {{ $errors->has('code') ? 'has-error' : ''}}">
                  {!! Form::text('code', null, ['class' => 'form-control', 'placeholder' => 'Kode/Singkatan.']) !!}
                  {!! $errors->first('code', '<p class="help-block">:message</p>') !!}
                </div>
                 {!! Form::label('categories', 'Kategori', ['class' => 'col-sm-1 control-label']) !!}
                <div class="col-sm-5">
                  <div class="input-group col-sm-12 col-xs-12 ">
                    <select class="form-control m-b chosen-select" name="sampah">
                      
                        <option value="uncategories">Choose Category</option>
                        @foreach($categories  as $sampah)
                          
                              @if($sampah->nesting==0)
                                   <option value="{{$sampah->id}}">{{$sampah->name}}</option> 
                              @endif
                     
                        @endforeach
                     
                   
                    </select>
                  </div>
                  {!! $errors->first('sampah', '<p class="help-block">:message</p>') !!}
                </div>
              </div>
              <div class="form-group">
               {!! Form::label('name', 'Nama*', ['class' => 'col-sm-1 control-label']) !!}
                <div class="col-sm-5 {{ $errors->has('name') ? 'has-error' : ''}}">
                  {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Nama [Max: 50 Katakter]']) !!}
                  {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
                </div>

                {!! Form::label('status', 'Status*', ['class' => 'col-sm-1 control-label']) !!}
                <div class="col-sm-5 col-xs-12">
                  <div class="input-group col-sm-12 col-xs-12 ">
                    {{ Form::select('status', $activations, null, ['class' => 'form-control chosen-select']) }}
                  </div>
                  {!! $errors->first('status', '<p class="help-block">:message</p>') !!}
                </div>
              </div>
              @if(!empty($id))
              <div class="form-group ">
                {!! Form::label('sell_price', 'Nilai Jual*', ['class' => 'col-sm-1 control-label']) !!}
                <div class="col-sm-5 {{ $errors->has('sell_price') ? 'has-error' : ''}}">
                   {!! Form::number('sell_price', null, ['class' => 'form-control', 'placeholder' => 'Nilai Jual','step'=>'any']) !!}
                  {!! $errors->first('sell_price', '<p class="help-block">:message</p>') !!}
                </div>
                {!! Form::label('satuan', 'Satuan*', ['class' => 'col-sm-1 control-label']) !!}
                <div class="col-sm-5 col-xs-12">
                  <div class="input-group col-sm-12 col-xs-12 ">
                    {{ Form::select('satuan', $satuans, null, ['class' => 'form-control chosen-select','placeholder'=>'Pilih Satuan']) }}
                  </div>
                  {!! $errors->first('satuan', '<p class="help-block">:message</p>') !!}
                </div>
                
              </div> 
           
              <div class="form-group">
              
                {!! Form::label('buy_price', 'Nilai Beli*', ['class' => 'col-sm-1 control-label']) !!}
                <div class="col-sm-5 {{ $errors->has('buy_price') ? 'has-error' : ''}}">
                  {!! Form::number('buy_price', null, ['class' => 'form-control', 'placeholder' => 'Nilai Beli','step'=>'any']) !!}
                  {!! $errors->first('buy_price', '<p class="help-block">:message</p>') !!}
                </div>
              {!! Form::label('type', 'Type*', ['class' => 'col-sm-1 control-label']) !!}
                <div class="col-sm-5 col-xs-12">
                  <div class="input-group col-sm-12 col-xs-12 ">
                    {{ Form::select('type', $types, null, ['class' => 'form-control chosen-select','placeholder'=>'Pilih Type']) }}
                  </div>
                  {!! $errors->first('satuan', '<p class="help-block">:message</p>') !!}
                </div>
                
              </div>
                 @endif
              <div class="form-group">
                {!! Form::label('note', 'Deskripsi', ['class' => 'col-sm-1 control-label']) !!}
                <div class="col-sm-5 col-xs-12">
                  {!! Form::textarea('note', null, ['class' => 'form-control', 'rows' => '2', 'placeholder' => 'Deskripsi [Max: 500 Katakter]']) !!}
                  {!! $errors->first('status', '<p class="help-block">:message</p>') !!}
                </div>
              </div>
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
        });
</script>
@endsection
