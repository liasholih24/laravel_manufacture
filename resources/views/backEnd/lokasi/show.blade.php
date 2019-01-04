@extends('backLayout.app')
@section('title')
Lokasi
@stop
@section('desc')
Preview
@stop
@section('style')
{{ HTML::style('assets_back/css/plugins/dataTables/datatables.min.css') }}
@endsection
@section('content')
<div class="wrapper wrapper-content">
  <div class="row detail_content3">
    <div class="col-lg-12 detail_content2" style="background-color: white">
      <style>
        .ibox { margin: 1px 2px 0px 0px !important }
        .ibox.float-e-margins{ margin: 0px 2px !important}
      </style>
      <div class="row ibox-title">
        <ol class="breadcrumb col-sm-6 col-xs-12" style="font-size: 14px; padding-top: 6px; ">
          @if($node->depth == 0)
          <li class="">
            <a href="{{ url('organization/'. $node->parent_id .'/filter') }}">
              {{$node->first()->name}}
            </a>
          </li>
          @endif
          @if($node->depth != 0)
          @if($node->depth > 1) <li class="">
            <a href="{{ url('organization/'.$node->root()->id.'/show') }}">{{$node->root()->name}}</a>
          </li>@endif
          <li class="">
            <a href="{{ url('organization/'.$node->root()->id.'/show') }}">{{$node->parent()->get()->first()->name}}</a>
          </li>
          <li class="">
            <a href="{{ url('organization/'.$node->root()->id.'/show') }}">{{$node->name}}</a>
          </li>
          @endif
        </ol>
        <a href="{{ url()->previous() }}">
          <button class="btn btn-sm btn-outline btn-primary pull-right">
            <i class="fa fa-arrow-circle-o-left" style="margin-right: 5px"></i> Back
          </button>
        </a>
      </div>
      <div class="row ibox-content" style="min-height: 65vh; ">
        @foreach (['danger', 'warning', 'success', 'info'] as $msg)
      @if(Session::has('alert-' . $msg))
      <div class="alert alert-{{ $msg }} alert-dismissable">
        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
        {{ Session::get('alert-' . $msg) }}.
      </div>
      @endif
    @endforeach
        <h2>{{ $node->name }}</h2>
        <small>
          <i class="fa fa-clock-o"></i>
          Last updated at {{ $node->updated_at }} by {!! empty($node->updated_by)?"":$node->updatedby->first_name !!} {!! empty($node->updated_by)?"":$node->updatedby->last_name !!} <strong>
          </strong>
        </small>
        <div class="row" style="padding-top: 10px">
          <div class="col-md-12">
            <a id="pilihDetail" class="btn btn-sm btn-outline btn-primary">
            <i class="fa fa-info-circle"></i> Detail</a>
            <a id="pilihLog" class="btn btn-sm btn-outline btn-primary">  <i class="fa fa-book"></i> Logs</a>
            <div class="pull-right">
             
              @if (Sentinel::getUser()->hasAccess(['lokasi.edit']))
              <a href="{{ url('lokasi/'.$node->id.'/edit') }}" class="btn btn-sm btn-outline btn-success">  <i class="fa fa-edit" ></i> Edit</a>
              @endif
              @if (Sentinel::getUser()->hasAccess(['lokasi.destroy']))
        {!! Form::open([
                            'method'=>'DELETE',
                            'url' => ['lokasi', $node->id],
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
                  <p class="col-sm-4 col-xs-3 row">Kode</p>
                  <p class="col-sm-8 col-xs-9 row">: <strong>{{ $node->code }} </strong></p>
                </div>
                <div class="col-sm-6 col-xs-12">
                  <p class="col-sm-4 col-xs-3 row">Wilayah</p>
                  <p class="col-sm-8 col-xs-9 row">: <strong>{!! empty($node->getwilayah->name)?"<i></i>":$node->getwilayah->name !!} </strong></p>
                </div>
              </div>
              <div class="col-sm-12 col-xs-12 row">
                <div class="col-sm-6 col-xs-12">
                  <p class="col-sm-4 col-xs-3 row">Nama</p>
                  <p class="col-sm-8 col-xs-9 row">: <strong>{{ $node->name }} </strong></p>
                </div>
                <div class="col-sm-6 col-xs-12">
                  <p class="col-sm-4 col-xs-3 row">Status</p>
                  <p class="col-sm-8 col-xs-9 row">:  {!! empty($node->getstatus->name)?"<i></i>":$node->getstatus->name !!}</p>
                </div>
              </div>
              <div class="col-sm-12 col-xs-12 row">
                
              </div>

              <div class="col-sm-12 col-xs-12 row">
                <div class="col-sm-6 col-xs-12">
                  <p class="col-sm-4 col-xs-3 row">Created At</p>
                  <p class="col-sm-8 col-xs-9 row">:  {{ $node->created_at}} </p>
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
                  <p class="col-sm-8 col-xs-9 row">:  {!! empty($node->notes)?"<i>Tidak ada Deskripsi</i>":$node->notes !!}</p>
                </div>
              </div>

                  </div>

            <div id="tabLog">
              <br>
              <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover" id="tablog">
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
                      <?php $x++ ?>
                      <tr>
                        <td>{{ $x }}</td>
                        <td>{{ $log->description }}</td>
                        <td>{{ $log->user()->first()->first_name.' '.$log->user()->first()->last_name }}</td>
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
</div>
@stop
@section('script')
{{ HTML::script('assets_back/js/plugins/dataTables/datatables.min.js') }}
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


       var oTable = $('#tablog').DataTable();
        // Tab

        $('#tabLog').hide();
        $('#pilihDetail').addClass("active");

        // Klik Tab
        $('#pilihModules').click(function(){
          $('#tabDetail').hide();
          $('#tabLog').hide();

          $('#pilihDetail').removeClass("active");
          $('#pilihLog').removeClass("active");

        });

        $('#pilihDetail').click(function(){
          $('#tabDetail').show();
          $('#tabLog').hide();

          $('#pilihDetail').addClass("active");
          $('#pilihLog').removeClass("active");
        });
        $('#pilihLog').click(function(){
          $('#tabDetail').hide();
          $('#tabLog').show();

          $('#pilihLog').addClass("active");
            $('#pilihDetail').removeClass("active");
        });

     




    });

            $('#submit').click(function(){
  //  alert('submitting');
    $('#formfield').submit();
    });
</script>
@endsection
