@extends('backLayout.app')
@section('title')
Transaksi
@stop
@section('desc')
Sedekah Sampah
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
        <li class="active">
            Sedekah
        </li>
    </ol>
    <a href="{{ url()->previous() }}" class="btn btn-sm btn-outline btn-primary pull-right">
        <i class="fa fa-arrow-circle-o-left" style="margin-right: 5px"></i> Back
    </a>
    <a href="{{ url('sedekah/create') }}">
    <button class="detail2 btn btn-sm btn-outline btn-success pull-right" style="margin-right: 10px">
        <i class="fa fa-plus-circle" style="margin-right: 5px"></i> Tambah Sedekah
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
	<div class="col-xs-12 col-sm-12">
        @if(!empty($sedekah[0]))
    <div class="table-responsive">
<table class="table table-striped table-bordered table-hover" id="table1">
<thead>
    <tr>
        <th>ID</th>
        <th>Kode Transaksi</th>
        <th>Donatur</th>
        <th>Total(kg)</th>
        <th>Total(Rp.)</th>
        <th>Keterangan</th>
        <th>Tgl. Transaksi</th>
        <th>Diproses oleh</th>

        <th>Actions</th>
    </tr>
</thead>
<tbody>
<?php $i = 0 ?>
@foreach($sedekah as $item)
<?php $i++ ?>
    <tr>
        <td>{{ $item->id }}</td>
        <td>{{ $item->code }}</td>
        <td>{{ $item->perusahaan }}</td>
        <td>{{ $item->total_kg }}</td>
        <td>{{ $item->total_rp }}</td>
        <td>{!! empty($item->keterangan)?"<i>Tidak ada keterangan</i>": $item->keterangan !!}</td>
        <td>{{ $item->updated_at }}</td>
        <td>{{ empty($item->createdby->first_name)?"": $item->createdby->first_name }} {{ empty($item->createdby->last_name)?"": $item->createdby->last_name }}</td>
        <td>
            <a href="{{ url('sedekah/' . $item->id . '/print') }}" class="btn btn-outline btn-success btn-xs" target="_blank">Cetak Bukti</a>
            <a href="{{ url('sedekah/' . $item->id . '/edit') }}" class="btn btn-outline btn-primary btn-xs" target="_blank">Edit</a>
            
        </td>
    </tr>
@endforeach
</tfoot>
</table>
        </div>
        @else
         <div class="jumbotron">
                        <h1>Data Kosong ... </h1>
                        <p>Mohon maaf, tidak ada data transaksi sedekah untuk bulan ini.</p>
                        <p><a href="{{ url('sedekah/create') }}" class="btn btn-primary btn-lg" role="button">Tambah Sedekah</a>
                        </p>
        </div>
        @endif
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
        var oTable = $('#table1').DataTable();

    });

</script>
@endsection
