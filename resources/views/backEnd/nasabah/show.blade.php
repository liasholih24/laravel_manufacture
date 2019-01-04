@extends('backLayout.app')
@section('title')
Nasabah
@stop
@section('desc')
Data Nasabah
@stop
@section('style')
  {{ HTML::style('assets_back/css/plugins/dataTables/datatables.min.css') }}
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
                <a href="{{ url('nasabah') }}">  Nasabah</a>
            </li>
            <li class="active">
                    <a href="#">
                        Preview 
                    </a>
            </li>
        </ol>
                <a href="{{ url('nasabah') }}">
                <button class="btn btn-sm btn-outline btn-primary pull-right">
                <i class="fa fa-arrow-circle-o-left" style="margin-right: 5px"></i> Back
                </button>
                </a>
        </div>

    <div class="row ibox-content" style="min-height: 70vh">
          @foreach (['danger', 'warning', 'success', 'info'] as $msg)
              @if(Session::has('alert-' . $msg))
              <div class="alert alert-{{ $msg }} alert-dismissable">
                                            <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                                            {{ Session::get('alert-' . $msg) }}.
              </div>
              @endif
            @endforeach
          <div class="tabs-container" id="dataTabs">
            <ul class="nav nav-tabs">
                <li class="active"><a data-toggle="tab" href="#dtl" class="dtl" data-status="true">Info Nasabah</a></li>
                <li class=""><a data-toggle="tab" href="#riwayat"  class="attr" d data-status="false">Riwayat Transaksi</a></li>
                <li class=""><a data-toggle="tab" href="#log"  class="attr" d data-status="false">Logs</a></li>
                @if (Sentinel::getUser()->hasAccess(['sampah.destroy']))
                {!! Form::open([
                            'method'=>'DELETE',
                            'url' => ['nasabah', $nasabah->id],
                            'style' => 'display:inline',
                            'id'=>'formfield'
                        ]) !!}
                            {!! Form::button('<i class="fa fa-trash"></i> Delete', ['class' => 'btn btn-sm btn-outline btn-danger pull-right', 'style' => 'margin-left:10px',
                            'name' => 'btn', 'value' => 'Submit', 'id' => 'submitBtn', 'data-toggle' =>'modal', 'data-target' => '#confirm-submit' ]) !!}
                        {!! Form::close() !!}

                  @endif
                  
                  @if (Sentinel::getUser()->hasAccess(['nasabah.edit']))
                <a href="{{ url('nasabah/'. $nasabah->id .'/edit') }}" style="margin-left:10px;" class="btn btn-sm btn-outline btn-success pull-right" id="submitBtn2" data-toogle="modal" data-target="#confirm-submit2"> 
                 <i class="fa fa-edit"></i> Edit</a>
                 
                 {!! Form::button('<i class="fa fa-config"></i> Cetak Buku', ['class' => 'btn btn-sm  btn-success pull-right', 'style' => 'margin-left:10px',
                            'name' => 'btn', 'value' => 'Submit', 'id' => 'submitBtn3', 'data-toggle' =>'modal', 'data-target' => '#confirm-submit3' ]) !!}

                 

                        {!! Form::model($nasabah, [
                                'method' => 'PATCH',
                                'url' => ['nasabah', $nasabah->id],
                                'class' => 'form-horizontal',
                                'id'=>'formfield2'
                            ]) !!}

                  {!! Form::hidden('created_by', Sentinel::getUser()->id, ['class' => 'form-control']) !!}
                  {!! Form::hidden('updated_by', Sentinel::getUser()->id, ['class' => 'form-control']) !!}
                  {!! Form::hidden('email', $nasabah->norek , ['class' => 'form-control']) !!}
                  {!! Form::hidden('password', "resik" , ['class' => 'form-control']) !!}
                  {!! Form::hidden('password_confirmation', "resik" , ['class' => 'form-control']) !!}
                  {!! Form::hidden('first_name', $nasabah->nama_depan , ['class' => 'form-control']) !!}
                  {!! Form::hidden('last_name', $nasabah->nama_belakang , ['class' => 'form-control']) !!}
                  {!! Form::hidden('role', 3, ['class' => 'form-control']) !!}
                  {!! Form::hidden('status', 3, ['class' => 'form-control']) !!}
                  {!! Form::hidden('mobile_id', 1, ['class' => 'form-control']) !!}
                

                        @if(empty($nasabah->login_id))
                            {!! Form::button('<i class="fa fa-config"></i> Aktifkan Mobile', ['class' => 'btn btn-sm  btn-success btn-outline pull-right', 'style' => 'margin-left:10px',
                            'name' => 'btn', 'value' => 'Submit', 'id' => 'submitBtn2', 'data-toggle' =>'modal', 'data-target' => '#confirm-submit2' ]) !!}

                        @endif

                        {!! Form::close() !!}

                @endif
                </ul>
            <div class="tab-content">
                <div id="dtl" class="tab-pane active">
                  <div class="row col-sm-12" style="margin-top: 20px">

                    <div class="col-sm-12 col-xs-12 row">
                      <div class="col-sm-6 col-xs-12">
                        <p class="col-sm-5 col-xs-3 row">No. Rekening</p>
                        <p class="col-sm-8 col-xs-9 row">:  {{$nasabah->norek}}
                        </p>
                      </div>
                      <div class="col-sm-6 col-xs-12">
                        <p class="col-sm-5 col-xs-3 row">Kelompok Anggota</p>
                        <p class="col-sm-8 col-xs-9 row">: {{$nasabah->getgroup->code}} - {{$nasabah->getgroup->name}} 
                        </p>
                      </div>
                    </div>
                    <div class="col-sm-12 col-xs-12 row">
                      <div class="col-sm-6 col-xs-12">
                        <p class="col-sm-5 col-xs-3 row">Nama </p>
                        <p class="col-sm-8 col-xs-9 row">:  {{$nasabah->nama_depan}} {{$nasabah->nama_belakang}}
                        </p>
                      </div>
                      <div class="col-sm-6 col-xs-12">
                       <p class="col-sm-5 col-xs-3 row">Jenis Nasabah </p>
                        <p class="col-sm-8 col-xs-9 row">:  {{$nasabah->jenis_nasabah}} 
                        </p>
                      </div>
                    </div>
                     <div class="col-sm-12 col-xs-12 row">
                      <div class="col-sm-6 col-xs-12">
                        
                        <p class="col-sm-5 col-xs-3 row">Identitas</p>
                        <p class="col-sm-8 col-xs-9 row">: {{$nasabah->tipe_identitas}} - {{$nasabah->no_identitas}} 
                        </p>
                      </div>
                      <div class="col-sm-6 col-xs-12">
                        <p class="col-sm-5 col-xs-3 row">Unit Kerja</p>
                        <p class="col-sm-8 col-xs-9 row">: {!! empty($nasabah->getunit->name)?"<i>No Data</i>": $nasabah->getunit->name  !!}
                        </p>
                      </div>
                    </div>
                    @if($nasabah->jenis_nasabah == "Perorangan")
                    <div class="col-sm-12 col-xs-12 row">
                      <div class="col-sm-6 col-xs-12">
                        
                        <p class="col-sm-5 col-xs-3 row">Pekerjaan</p>
                        <p class="col-sm-8 col-xs-9 row">: {{$nasabah->pekerjaan}} 
                        </p>
                      </div>
                      <div class="col-sm-6 col-xs-12">
                        <p class="col-sm-5 col-xs-3 row">Organisasi</p>
                        <p class="col-sm-8 col-xs-9 row">: {{$nasabah->organisasi}} 
                        </p>
                      </div>
                    </div>
                    @endif
                    <div class="col-sm-12 col-xs-12 row">
                      <div class="col-sm-6 col-xs-12">
                        
                        <p class="col-sm-5 col-xs-3 row">No. Telepon</p>
                        <p class="col-sm-8 col-xs-9 row">: {{$nasabah->no_telp}} 
                        </p>
                      </div>
                      @if($nasabah->jenis_nasabah == "Binaan")
                       <div class="col-sm-6 col-xs-12">
                        <p class="col-sm-5 col-xs-3 row">PIC Binaan</p>
                        <p class="col-sm-8 col-xs-9 row">: {{$nasabah->pic}} 
                        </p>
                      </div>
                      @endif
                     
                    </div>
                     <div class="col-sm-12 col-xs-12 row">
                      <div class="col-sm-6 col-xs-12">
                        
                        <p class="col-sm-5 col-xs-3 row">Alamat</p>
                        <p class="col-sm-8 col-xs-9 row">: {{$nasabah->alamat}} 
                        </p>
                      </div>
                      <div class="col-sm-6 col-xs-12">
                        <p class="col-sm-5 col-xs-3 row">Status</p>
                        <p class="col-sm-8 col-xs-9 row">: {{$nasabah->getstatus->name}} 
                        </p>
                      </div>
                     
                    </div>
                    <div class="col-sm-12 col-xs-12 row">
                      <div class="col-sm-6 col-xs-12">
                        
                        <p class="col-sm-5 col-xs-3 row">Created By</p>
                        <p class="col-sm-8 col-xs-9 row">: {{$nasabah->createdby->first_name}} {{$nasabah->createdby->last_name}} 
                        </p>
                      </div>
                      <div class="col-sm-6 col-xs-12">
                        <p class="col-sm-5 col-xs-3 row">Created At</p>
                        <p class="col-sm-8 col-xs-9 row">: {{$nasabah->created_at}} 
                        </p>
                      </div>
                     
                    </div>
                    <div class="col-sm-12 col-xs-12 row">
                      <div class="col-sm-6 col-xs-12">
                        
                        <p class="col-sm-5 col-xs-3 row">Updated By</p>
                        <p class="col-sm-8 col-xs-9 row">: {{$nasabah->updatedby->first_name}} {{$nasabah->updatedby->last_name}} 
                        </p>
                      </div>
                      <div class="col-sm-6 col-xs-12">
                        <p class="col-sm-5 col-xs-3 row">Updated At</p>
                        <p class="col-sm-8 col-xs-9 row">: {{$nasabah->updated_at}} 
                        </p>
                      </div>
                     
                    </div>
                    <div class="col-sm-12 col-xs-12 row">
                      <div class="col-sm-12 col-xs-12">
                        <h3 class="col-sm-10 col-xs-3 row">Keterangan mengenai {{$nasabah->nama_depan}} {{$nasabah->nama_belakang}}</h3>
                      </div>
                    </div>
                    <div class="col-sm-12 col-xs-12 row">
                      <div class="col-sm-12 col-xs-12">
                        <p class="col-sm-5 col-xs-3 row">{!! empty($nasabah->desc)?"Tidak ada keterangan":$nasabah->desc!!}</p>
                      </div>
                    </div>
                    
           
             
                  </div>
                </div>
                <div id="riwayat" class="tab-pane">
                  <br>
                  @if(!empty($riwayats[0]))
                    <div class="table-responsive" style="margin-top: 20px">
                    <table class="table table-striped table-bordered table-hover" id="table_riwayat">
                      <thead>
                        <tr>
                            <th>No</th>
                            <th>Kode Transaksi</th>
                            <th>Debit</th>
                            <th>Kredit</th>
                            <th>Saldo</th>
                            <th>Keterangan</th>
                            <th>Tgl. Transaksi</th>
                            <th>Diproses oleh</th>
                        </tr>
                    </thead>
                    <tbody>
                       <?php $i=0;?>
                @foreach($riwayats as $item)
                        <?php $i++?>
                <tr>
                    <td>{{$i}}</td>
                    <td>{{ $item->trx_code}}</td>
                    <td>{{ empty($item->debit)? "0" : $item->debit }}</td>
                    <td>{{ empty($item->kredit)? "0" : $item->kredit }}</td>
                    <td>{{ empty($item->saldo)? "0" : $item->saldo }}</td>
                    <td>{!! empty($item->keterangan)? "<i>Tidak ada keterangan</i>" : $item->keterangan !!}</td>
                    <td>{{ $item->created_at}}</td>
                    <td>{{ empty($item->createdby->first_name)?"": $item->createdby->first_name }} {{ empty($item->createdby->last_name)?"": $item->createdby->last_name }}</td>
                
                </tr>
            @endforeach
            </tbody>
                      
                    </table>
                  </div>
                  @else
                  <div class="jumbotron">
                        <h1>Data Kosong ... </h1>
                        <p>Mohon maaf, tidak ada riwayat transaksi untuk nasabah {{$nasabah->nama_depan}}.</p>
                         @if (Sentinel::getUser()->hasAccess(['tabungan.create']))
                        <p><a href="{{ url('tabungan/create') }}" class="btn btn-primary btn-lg" role="button">Tambah Transaksi</a>
                          @endif
                        </p>
        </div>
                  @endif
                  
                </div>
                <div id="log" class="tab-pane">
                  <br>
                    <div class="table-responsive" style="margin-top: 20px">
                    <table class="table table-striped table-bordered table-hover" id="table_log">
                      <thead>

                        <tr>
                          <th>No.</th>
                          <th>Description</th>
                          <th>Created By</th>
                          <th>Created At</th>
                        </tr>
                      </thead>
                      
                    </table>
                  </div>
                </div>

                <div class="modal fade" id="confirm-submit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                Konfirmasi
            </div>
            <div class="modal-body">
                Apakah Anda yakin ingin menghapus data?
                <br/><br/>
                <table class="table">
                    <tr>
                        <th>No. Rekening</th>
                        <td >: {{$nasabah->norek}}</td>
                    </tr>
                    <tr>
                        <th>Nama</th>
                        <td>: {{$nasabah->nama_depan}} {{$nasabah->nama_belakang}}</td>
                    </tr>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <a href="#" id="submit" class="btn btn-danger success">Delete</a>

            </div>
        </div>
    </div>
  </div>
  <div class="modal fade" id="confirm-submit2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                Konfirmasi
            </div>
            <div class="modal-body">
                Apakah Anda yakin ingin mengaktifkan login aplikasi mobile untuk : 
                <br/><br/>
                <table class="table">
                    <tr>
                        <th>No. Rekening</th>
                        <td >: {{$nasabah->norek}}</td>
                    </tr>
                    <tr>
                        <th>Nama</th>
                        <td>: {{$nasabah->nama_depan}} {{$nasabah->nama_belakang}}</td>
                    </tr>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <a href="#" id="submit2" class="btn btn-success success">Aktifkan</a>

            </div>
        </div>
    </div>
  </div>
  <div class="modal fade" id="confirm-submit3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                Konfirmasi
            </div>
             {!! Form::open(['url' => 'prints', 'class' => 'form-horizontal','id'=>'formfield3','target'=>'_blank']) !!}
             {!! Form::hidden('id', $nasabah->id, ['class' => 'form-control' ]) !!}
             {!! Form::hidden('norek', $nasabah->norek, ['class' => 'form-control' ]) !!}
            <div class="modal-body">
               Mohon masukkan baris terakhir dalam buku tabungan.
               <br><br>
                <table class="table">
                    <tr>
                        <td > {!! Form::number('baris', null, ['class' => 'form-control','placeholder'=>'No. Baris.']) !!}</td>
                    </tr>
                   
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-success">
       				 <i class="fa fa-pencil"></i>  Cetak
        		</button>

            </div>
             {!! Form::close() !!}
        </div>
    </div>
  </div>

            </div>
          </div>
        </div>
    </div>
@endsection
@section('script')
{{ HTML::script('assets_back/js/plugins/dataTables/datatables.min.js') }}
<!-- Page-Level Scripts -->
<script>

     $(document).ready(function(){
      /* Init DataTables */
      var oTable = $('#table_riwayat').DataTable( {order: [ 6, 'desc' ]});
      var oTable = $('#table_log').DataTable();

      $('#submit').click(function(){
        $('#formfield').submit(); 
      });

       $('#submit2').click(function(){
        $('#formfield2').submit(); 
      });

       $('#submit3').click(function(){
        $('#formfield3').submit(); 
      });

    });


</script>
@endsection
