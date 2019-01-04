@extends('backLayout.app')
@section('title')
Satuan
@stop
@section('title')
Preview Satuan
@stop
@section('content')
@section('style')
{{ HTML::style('assets_back/css/plugins/dataTables/datatables.min.css') }}
@endsection

    <div class="wrapper wrapper-content">
  <div class="row detail_content3">
    <div class="col-lg-12 detail_content2" style="background-color: white">
      <style>
        .ibox { margin: 1px 2px 0px 0px !important }
        .ibox.float-e-margins{ margin: 0px 2px !important}
      </style>
      <div class="row ibox-title">
        <ol class="breadcrumb col-sm-6 col-xs-12" style="font-size: 14px; padding-top: 6px; ">
          <li class="">
            <a href="{{ url('satuan') }}">
              Satuan
            </a>
          </li>
          <li class="active">
              {{ $node->name }}       
          </li>
         
        </ol>
        <a href="{{ url()->previous() }}">
          <button class="btn btn-sm btn-outline btn-primary pull-right">
            <i class="fa fa-arrow-circle-o-left" style="margin-right: 5px"></i> Back
          </button>
        </a>
      </div>
      <div class="row ibox-content" style="min-height: 65vh; ">
        <h2>{{ $node->name }}</h2>
        <small>
          <i class="fa fa-clock-o"></i>
          Last updated at {{ $node->updated_at }} by <strong>
          </strong>
        </small>
        <div class="row" style="padding-top: 10px">
          <div class="col-md-12">
            @if(session()->has('alert-success'))
                <div class="alert alert-success">
                    {{ session()->get('alert-success') }}
                </div>
            @endif
            <a id="pilihDetail" class="btn btn-sm btn-outline btn-primary">
            <i class="fa fa-info-circle"></i> Detail</a>
            <a id="pilihLog" class="btn btn-sm btn-outline btn-primary">  <i class="fa fa-book"></i> Logs</a>
            <div class="pull-right">
              @if (Sentinel::getUser()->hasAccess(['satuan.edit']))
              <a href="{{ url('satuan/'.$node->id.'/edit') }}" class="btn btn-sm btn-outline btn-success">  <i class="fa fa-edit" ></i> Edit</a>
              @endif
               @if (Sentinel::getUser()->hasAccess(['satuan.destroy']))
        {!! Form::open([
                            'method'=>'DELETE',
                            'url' => ['satuan', $node->id],
                            'style' => 'display:inline',
                            'id'=>'formfield'
                        ]) !!}
                            {!! Form::button('<i class="fa fa-trash" ></i> Delete', ['class' => 'btn btn-sm btn-outline btn-danger',
                            'name' => 'btn', 'value' => 'Submit', 'id' => 'submitBtn', 'data-toggle' =>'modal', 'data-target' => '#confirm-submit' ]) !!}
                        {!! Form::close() !!}
                        
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
                        <th>Kode</th>
                        <td >: {{$node->code}}</td>
                    </tr>
                    <tr>
                        <th>Nama</th>
                        <td>: {{$node->name}}</td>
                    </tr>
                    <tr>
                        <th>Keterangan</th>
                        <td>: {!! empty($penadah->name)?"<i>Tidak ada keterangan</i>": $penadah->name !!}</td>
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
        @endif

            </div>
            </a>
          </div>
          <div class="col-md-12">
            <div id="tabDetail">
              <br/>
              <div class="col-sm-12 col-xs-12 row">
                <div class="col-sm-6 col-xs-12">
                  <p class="col-sm-4 col-xs-3 row">Code</p>
                  <p class="col-sm-8 col-xs-9 row">: <strong>{{ $node->code }} </strong></p>
                </div>
                <div class="col-sm-6 col-xs-12">
                  <p class="col-sm-4 col-xs-3 row">Name</p>
                  <p class="col-sm-8 col-xs-9 row">: <strong>{{ $node->name }} </strong></p>
                </div>
              </div>
              <div class="col-sm-12 col-xs-12 row">
                <div class="col-sm-6 col-xs-12">
                  <p class="col-sm-4 col-xs-3 row">Nilai Standar</p>
                  <p class="col-sm-8 col-xs-9 row">: <strong> {{ $node->standard_value }} {{ empty($node->getbasis->name)? $node->code : $node->getbasis->code }}</strong></p>
                </div>
                <div class="col-sm-6 col-xs-12">
                  <p class="col-sm-4 col-xs-3 row">Status</p>
                  <p class="col-sm-8 col-xs-9 row">: <strong>{{ empty($node->getstatus->name)?"": $node->getstatus->name }} </strong></p>
                </div>
              </div>
              <div class="col-sm-12 col-xs-12 row">
                <div class="col-sm-6 col-xs-12">
                  <p class="col-sm-4 col-xs-3 row">Created At</p>
                  <p class="col-sm-8 col-xs-9 row">: {{ $node->created_at}} </p>
                </div>
                <div class="col-sm-6 col-xs-12">
                  <p class="col-sm-4 col-xs-3 row">Updated At</p>
                  <p class="col-sm-8 col-xs-9 row">:  {{ $node->updated_at }} </p>
                </div>
              </div>
              <div class="col-sm-12 col-xs-12 row">
                <div class="col-sm-6 col-xs-12">
                  <p class="col-sm-4 col-xs-3 row">Created By</p>
                  <p class="col-sm-8 col-xs-9 row">:  {!! empty($node->created_by)?"":$node->createdby->first_name !!} </p>
                </div>
                <div class="col-sm-6 col-xs-12">
                  <p class="col-sm-4 col-xs-3 row">Updated By</p>
                  <p class="col-sm-8 col-xs-9 row">:  {!! empty($node->updated_by)?"":$node->updatedby->first_name !!} </p>
                </div>
              </div>
              <div class="col-sm-12 col-xs-12 row">
                <div class="col-sm-6 col-xs-12">
                  <p class="col-sm-4 col-xs-3 row">Deskripsi</p>
                  <p class="col-sm-8 col-xs-9 row">:  {!! empty($node->desc)?"Tidak ada deskripsi":$node->desc !!} </p>
                </div>
              </div>
            
            </div>
            <div id="tabLog">
              <br/>
              <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover" id="editable2">
                  <thead>

                    <tr>
                      <th>No.</th>
                      <th>Description</th>
                      <th>Created By</th>
                      <th>Created At</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $x = 0 ?>
                    @foreach($logs as $log)
                      <?php $x++ ;
                      ?>
                      <tr>
                        <td>{{ $x }}</td>
                        <td>{{ $log->description }}
                        </td>
                        <td>{{ $log->causer->first_name." ".$log->causer->last_name }}</td>
                        
                        <td>{{ $log->created_at }}</td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
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


        $('#tabLog').hide();
        $('#tabDetail').show();
        $('#pilihDetail').addClass("active");

        $('#pilihDetail').click(function(){
          $('#tabDetail').show();
          $('#tabLog').hide();

            $('#pilihLog').removeClass("active");
            $('#pilihDetail').addClass("active");
        });

        $('#pilihLog').click(function(){
          $('#tabDetail').hide();
          $('#tabLog').show();

            $('#pilihLog').addClass("active");
            $('#pilihDetail').removeClass("active");
        });

        var oTable = $('#editable2').DataTable({order: [ 3, 'desc' ]});

                $('#submit').click(function(){
  //  alert('submitting');
    $('#formfield').submit();
});

    });
</script>
@endsection