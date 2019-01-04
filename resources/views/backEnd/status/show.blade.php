@extends('backLayout.app')
@section('title')
Status
@stop
@section('desc')
Manage Status
@stop
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
          <button class="btn btn-sm btn-outline btn-warning pull-right">
            <i class="fa fa-arrow-circle-o-left" style="margin-right: 5px"></i> Back
          </button>
        </a>
      </div>
      <div class="row ibox-content" style="min-height: 65vh; ">
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
             
              @if (Sentinel::getUser()->hasAccess(['status.edit']))
              <a href="{{ url('status/'.$node->id.'/edit') }}" class="btn btn-sm btn-outline btn-primary">  <i class="fa fa-edit" ></i> Edit</a>
              @endif

            </div>
            </a>
          </div>
          <div class="col-md-12">
            <div id="tabDetail">
              <br/>
              <div class="col-sm-12 col-xs-12 row">
                <div class="col-sm-6 col-xs-12">
                  <p class="col-sm-4 col-xs-3 row">Name</p>
                  <p class="col-sm-8 col-xs-9 row">: <strong>{{ $node->name }} </strong></p>
                </div>
              </div>

              <div class="col-sm-12 col-xs-12 row">
                <div class="col-sm-6 col-xs-12">
                  <p class="col-sm-4 col-xs-3 row">Description</p>
                  <p class="col-sm-8 col-xs-9 row">:  {!! empty($node->desc)?"<i>No Description</i>":$node->desc !!}</p>
                </div>
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

                  </div>

            <div id="tabLog">
              <br>
              <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover dataTables-example2" >
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
<!-- Page-Level Scripts -->
<script>
    $(document).ready(function(){
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

        $('.dataTables-example').DataTable({
            dom: '<"html5buttons"B>lTfgitp',
            buttons: [
                { extend: 'copy'},
                {extend: 'csv'},
                {extend: 'excel', title: 'ExampleFile'},
                {extend: 'pdf', title: 'ExampleFile'},

                {extend: 'print',
                 customize: function (win){
                        $(win.document.body).addClass('white-bg');
                        $(win.document.body).css('font-size', '10px');

                        $(win.document.body).find('table')
                                .addClass('compact')
                                .css('font-size', 'inherit');
                }
                }
            ]

        });
        $('.dataTables-example2').DataTable({
            dom: '<"html5buttons"B>lTfgitp',
            buttons: [

            ]

        });




    });


    function ConfirmDelete()
  {
  var x = confirm("Are you sure you want to delete?");
  if (x)
    return true;
  else
    return false;
  }
</script>
@endsection
