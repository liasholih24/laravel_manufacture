@extends('backLayout.app')
@section('title')
Satuan
@stop
@section('desc')
Kelola Data Satuan
@stop
@section('style')
{{ HTML::style('assets_back/css/plugins/select2/select2.min.css') }}
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
    <div class="ibox-title row">
        <ol class="breadcrumb col-sm-8 col-xs-12" style="font-size: 14px; padding-top: 6px; ">
          <li class="active">
              <a class="detail2" href="">
                Satuan
              </a>
          </li>
          </ol>
          <a href="{{ url()->previous() }}" class="btn btn-sm btn-outline btn-primary pull-right">
              <i class="fa fa-arrow-circle-o-left" style="margin-right: 5px"></i> Back
          </a>
          @if (Sentinel::getUser()->hasAccess(['satuan.create']))
          <a href="{{ url('satuan/create') }}">
          <button class="detail2 btn btn-sm btn-outline btn-success pull-right" style="margin-right: 10px">
              <i class="fa fa-plus-circle" style="margin-right: 5px"></i>
                  Tambah Satuan

          </button>
          </a>
          @endif

    </div>
    <div class="col-xs-12 col-sm-12 ibox-content row" style="min-height:65vh;">
      @foreach (['danger', 'warning', 'success', 'info'] as $msg)
      @if(Session::has('alert-' . $msg))
      <div class="alert alert-{{ $msg }} alert-dismissable">
        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
        {{ Session::get('alert-' . $msg) }}.
      </div>
      @endif
    @endforeach
    <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover" id="tblsatuan">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Kode</th>
                    <th>Nama</th>
                    <th>Nilai Standar</th>
                    <th>Last Update</th>
                    <th>Updated By</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
            @foreach($satuan as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->code }}</td>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->standard_value }} {{ empty($item->getbasis->name)? $item->code : $item->getbasis->code }}</td>
                   
                    <td>{!! empty($item->updated_at)? "<i>No Updated</i>" : $item->updated_at !!}</td>
                    <td>{!! empty($item->updatedby->first_name)?"<i>No Updated</i>": $item->updatedby->first_name !!} {!! empty($item->updatedby->last_name)?"<i></i>" : $item->updatedby->last_name !!}</td>
                    <td>
                    @if( $item->status == "3")
                    <a href="#" class="btn btn-xs btn-success btn-outline active">Active</a>
                   @else
                  <a href="#" class="btn btn-xs btn-default btn-outline">Inactive</a>
                  @endif
                </td>
                    <td>
                        <a href="{{ url('satuan/' . $item->id . '/edit') }}" class="btn btn-primary btn-outline btn-xs">Edit</a> 
                        <a href="{{ url('satuan/' . $item->id . '') }}" class="btn btn-primary  btn-outline btn-xs">View</a> 
                       
                    </td>
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
{{ HTML::script('assets_back/js/plugins/select2/select2.full.min.js') }}
<script type="text/javascript">
    $(document).ready(function(){
        var oTable = $('#tblsatuan').DataTable();


    });
</script>
@endsection