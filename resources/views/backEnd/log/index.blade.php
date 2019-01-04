@extends('backLayout.app')
@section('title')
Activity Log
@stop
@section('desc')
View Activity of Users
@stop
@section('style')
{{ HTML::style('assets_back/css/plugins/dataTables/datatables.min.css') }}
@endsection
@section('content')
<div class="wrapper wrapper-content">
    <div class="row detail_content3">
    <div class="col-lg-12 detail_content2" style="background-color: white">
    <div class="ibox-title row">
        <ol class="breadcrumb col-sm-6 col-xs-12" style="font-size: 14px; padding-top: 6px; ">
          <li class="active">
              <a class="detail2" href="">
                <strong>Log Activity</strong>
              </a>
          </li>
         </ol>
          <a href="{{ url()->previous() }}" class="btn btn-sm btn-outline btn-warning pull-right">
              <i class="fa fa-arrow-circle-o-left" style="margin-right: 5px"></i> Back
          </a>
    </div>
  <div class="col-xs-12 col-sm-12 ibox-content row" style="min-height:65vh;">
    @if(session()->has('alert-success'))
        <div class="alert alert-success">
            {{ session()->get('alert-success') }}
        </div>
    @endif
    <div class="table-responsive">

<table class="table table-striped table-bordered table-hover" id="editable">
<thead>
    <tr>
        <th>No.</th>
        <th>Description</th>
        <th>Change</th>
        <th>Module</th>
        <th>Causer By</th>
        <th>Created At</th>
    </tr>
</thead>
<tbody>
  <?php $x = 0 ?>
  @foreach($logs as $log)

    <?php $x++ ;
    $preg = preg_replace('/[^a-zA-Z0-9_ %\[\]\.\(\)%&-]/s', '', $log->subject_type);
    ?>
    <tr>
      <td>{{ $x }}</td>
      <td>{{ $log->description }}
      </td>
      <td></td>
      <td>{!! str_replace('App','', $preg) !!}</td>
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
@endsection
@section('script')
{{ HTML::script('assets_back/js/plugins/dataTables/datatables.min.js') }}
<!-- Page-Level Scripts -->
<script>
    $(document).ready(function(){

        /* Init DataTables */
        var oTable = $('#editable').DataTable(
         {order: [ 5, 'desc' ]}
        );

    });

</script>


@endsection
