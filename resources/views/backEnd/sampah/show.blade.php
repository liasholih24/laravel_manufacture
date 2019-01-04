@extends('backLayout.app')
@section('title')
{{$node->title}}
@stop
@section('desc')
{{$node->subtitle}}
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
          @if($node->nesting == 0 )
          <li class="">
            <a href="{{ url('kategori/'. $node->root()->id .'/show') }}">
              {{$node->root()->name}}
            </a>
          </li>
          @elseif($node->nesting != 0)
          <li class="">
            <a href="{{ url('kategori/'. $node->parent()->first()->id .'/show') }}">
              {{ $node->parent()->first()->name }}
            </a>
          </li>
          <li class="">
            <a href="{{ url('kategori/'. $node->id .'/show') }}">
              {{ $node->name }}
            </a>
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
        <h2>{{ $node->name }}</h2>
        <small>
          <i class="fa fa-clock-o"></i>
          Last updated at {{ $node->updated_at }} by {!! empty($node->updated_by)?"":$node->updatedby->first_name !!} {!! empty($node->updated_by)?"":$node->updatedby->last_name !!}<strong>
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
            @if($node->nesting == 0)
            <a id="pilihDescendant" class="btn btn-sm btn-outline btn-primary">  <i class="fa {{$node->depthicon}}"></i> {{$node->depthname}}</a>
            @endif
            <a id="pilihLog" class="btn btn-sm btn-outline btn-primary">  <i class="fa fa-book"></i> Logs</a>
            <div class="pull-right">
              @if (Sentinel::getUser()->hasAccess(['sampah.edit']))
              <a href="{{ url('kategori/'.$node->id.'/edit') }}" class="btn btn-sm btn-outline btn-success">  <i class="fa fa-edit" ></i> Edit</a>
              @endif
            

               @if (Sentinel::getUser()->hasAccess(['sampah.destroy']))
        {!! Form::open([
                            'method'=>'DELETE',
                            'url' => ['sampah', $node->id],
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
                  <p class="col-sm-4 col-xs-3 row">Type</p>
                  <p class="col-sm-8 col-xs-9 row">: <strong>{!! empty($node->gettype->name)? "<i>Tidak ada Data</i>": $node->gettype->name !!}</strong></p>
                </div>
                
              </div>
              <div class="col-sm-12 col-xs-12 row">
                  <div class="col-sm-6 col-xs-12">
                  <p class="col-sm-4 col-xs-3 row">Name</p>
                  <p class="col-sm-8 col-xs-9 row">: <strong>{{ $node->name }} </strong></p>
                </div>
                <div class="col-sm-6 col-xs-12">
                  <p class="col-sm-4 col-xs-3 row">Status</p>
                  <p class="col-sm-8 col-xs-9 row">: <strong>{{{ ($node->status == 3 ? 'Active' : 'Inactive') }}}</strong></p>
                </div>
              </div>

              <div class="col-sm-12 col-xs-12 row">
                <div class="col-sm-6 col-xs-12">
                  <p class="col-sm-4 col-xs-3 row">Description</p>
                  <p class="col-sm-8 col-xs-9 row">: {!! empty($node->note)?"<i>No Description</i>":$node->note !!} </p>
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
                  <p class="col-sm-8 col-xs-9 row">:  {!! empty($node->created_by)?"":$node->createdby->first_name !!} {!! empty($node->created_by)?"":$node->createdby->last_name !!} </p>
                </div>
                <div class="col-sm-6 col-xs-12">
                  <p class="col-sm-4 col-xs-3 row">Updated By</p>
                  <p class="col-sm-8 col-xs-9 row">:  {!! empty($node->updated_by)?"":$node->updatedby->first_name !!} {!! empty($node->updated_by)?"":$node->updatedby->last_name !!}</p>
                </div>
              </div>

                  </div>
                  <div id="tabDescendant">
                    <br>
                    <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover" id="editable">
                        <thead>
                          <tr>
                              <th>No.</th>
                              <th>Code</th>
                              <th>Name</th>
                              <th>Description</th>
                              <th>Last Update</th>
                              <th>Updated By</th>
                              <th>Actions</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php $i=0 ?>
                          @foreach($nodes as $item)


                          <?php $i++ ?>
                            <tr>
                                <td>{{$i}}</td>
                                <td>{{$item->code}}</td>
                                <td>{{$item->name}}</td>
                                <td>{!! empty($item->note)?"<i>No Description</i>":$item->note !!}</td>
                                {{-- <td>{{count($item->children()->get())}}</td> --}}
                                <td>{{$item->updated_at}}</td>
                                <td>{{$item->updatedby->first_name}} {{$item->updatedby->last_name}}</td>
                                <td>
                                  @if( $item->status == 3)
                                  <a href="#" class="btn btn-xs btn-primary btn-outline active">Active</a>
                                  @else
                                  <a href="#" class="btn btn-xs btn-default btn-outline">Inactive</a>
                                  @endif
                                  @if( $item->nesting != 3)
                                  @if (Sentinel::getUser()->hasAccess(['sbu.show']))
                                  <a href="{{ url('kategori/' . $item->id . '/show') }}" class="btn btn-primary btn-outline btn-xs">View</a>
                                  @endif
                                  @endif

                                  @if (Sentinel::getUser()->hasAccess(['sbu.edit']))
                                  <a href="{{ url('kategori/' . $item->id . '/edit') }}" class="btn btn-outline btn-primary btn-xs">Edit</a>
                                  @endif
                                </td>
                            </tr>

                          @endforeach
                        </tbody>


                      </table>
                    </div>
                  </div>

            <div id="tabLog">
              <br>
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
</div>
@stop
@section('script')
{{ HTML::script('assets_back/js/plugins/dataTables/datatables.min.js') }}
<!-- Page-Level Scripts -->
<script>
    $(document).ready(function(){

      //function u_diff
      function myfunction($a,$b)
      {
        if ($a===$b)
      {
        return 0;
      }
      return ($a>$b)?1:-1;
      }



      /* Init DataTables */
      var oTable = $('#editable').DataTable({order: [ 4, 'desc' ]});
      var oTable = $('#editable2').DataTable({order: [ 3, 'desc' ]});
        // Tab
        $('#tabDescendant').hide();
        $('#tabLog').hide();
        $('#tabLeaves').hide();
        $('#pilihDetail').addClass("active");
        $('#pilihLeaves').hide();

        // Klik Tab
        $('#pilihModules').click(function(){
          $('#tabDetail').hide();
          $('#tabDescendant').hide();
          $('#tabLog').hide();
          $('#tabLeaves').hide();

          $('#pilihLeaves').hide();

          $('#pilihDescendant').removeClass("active");
          $('#pilihDetail').removeClass("active");
          $('#pilihLog').removeClass("active");

        });
        $('#pilihDescendant').click(function(){
          $('#tabDetail').hide();
          $('#tabDescendant').show();
          $('#tabLog').hide();
          $('#tabLeaves').hide();


          $('#pilihLeaves').show();

          $('#pilihDescendant').addClass("active");
          $('#pilihDetail').removeClass("active");
          $('#pilihLog').removeClass("active");
          $('#pilihLeaves').removeClass("active");
        });
        $('#pilihLeaves').click(function(){
          $('#tabDetail').hide();
          $('#tabDescendant').hide();
          $('#tabLeaves').show();
          $('#tabLog').hide();


          $('#pilihLeaves').show();

          $('#pilihLeaves').addClass("active");
          $('#pilihDescendant').removeClass("active");
          $('#pilihDetail').removeClass("active");
          $('#pilihLog').removeClass("active");
        });
        $('#pilihDetail').click(function(){
          $('#tabDetail').show();
          $('#tabDescendant').hide();
          $('#tabLog').hide();
          $('#tabLeaves').hide();
          $('#pilihLeaves').hide();

          $('#pilihDetail').addClass("active");
          $('#pilihDescendant').removeClass("active");
          $('#pilihLog').removeClass("active");
        });
        $('#pilihLog').click(function(){
          $('#tabDetail').hide();
          $('#tabDescendant').hide();
          $('#tabLog').show();
          $('#tabLeaves').hide();

          $('#pilihLeaves').hide();
            $('#pilihLog').addClass("active");
            $('#pilihDetail').removeClass("active");
            $('#pilihDescendant').removeClass("active");
        });

    });


$('#submit').click(function(){
  //  alert('submitting');
    $('#formfield').submit();
});
</script>
@endsection
