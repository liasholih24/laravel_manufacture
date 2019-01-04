@extends('backLayout.app')
@section('title')
Show user  {{$user->first_name}}
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
          <li class="">
            <a href="{{ url('user') }}"> User
          </li>
          /
          <li class="">
            <a href="#">
              <strong>{{ $user->first_name }} {{ $user->last_name }}</strong>
            </a>
          </li>
        </ol>
        <a href="{{ url()->previous() }}">
          <button class="btn btn-sm btn-outline btn-warning pull-right">
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
        <h2>{{ $user->first_name }} {{ $user->last_name }}</h2>
        <small>
          <i class="fa fa-clock-o"></i>
          Last updated at {{ $user->updated_at }} by {{ $user->updatedby->first_name }} {{ $user->updatedby->last_name }}<strong>
          </strong>
        </small>
        <div class="row" style="padding-top: 10px">
          <div class="col-md-12">
            <a id="pilihDetail" class="btn btn-sm btn-outline btn-primary">
              <i class="fa fa-info-circle"></i> Detail</a>
            <a id="pilihModules" class="btn btn-sm btn-outline btn-primary">  <i class="fa fa-list"></i> Modules</a>
            <a id="pilihActivity" class="btn btn-sm btn-outline btn-primary">  <i class="fa fa-book"></i> Activities</a>
            <a id="pilihLog" class="btn btn-sm btn-outline btn-primary">  <i class="fa fa-book"></i> Logs</a>
            <div class="pull-right">
              <!--@if($user->id !== 1)
              {!! Form::open([
                'method'=>'DELETE',
                'url' => ['user', $user->id],
                'style' => 'display:inline',
                'onsubmit' => 'return ConfirmDelete()'
              ]) !!}
              <button type="submit" class="btn btn-sm btn-outline btn-danger"><i class="fa fa-times-circle"></i> Delete</button>
              {!! Form::close() !!}
              @endif -->
              @if (Sentinel::getUser()->hasAccess(['user.edit']))
              <a href="{{ url('user/'.$user->id.'/edit') }}" class="btn btn-sm btn-outline btn-primary">  <i class="fa fa-edit" ></i> Edit</a>
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
                  <p class="col-sm-8 col-xs-9 row">: <strong>
                    {{$user->first_name}} {{$user->last_name}}</strong></p>
                </div>
                   <div class="col-sm-6 col-xs-12">
                          <p class="col-sm-4 col-xs-3 row">
                              Status
                          </p>
                          <p class="col-sm-7 col-xs-9 row">
                            : <strong>{{{ ($user->status == 3 ? 'Active' : 'Inactive') }}}</strong>
                          </p>
                            </div>


                            <div class="col-sm-6 col-xs-12">
                                <p class="col-sm-4 col-xs-3 row">
                                    Roles
                                </p>
                                <p class="col-sm-7 col-xs-9 row">
                                    : <strong>{!! empty($user->roles()->first())?"<b>No Roles</b>":$user->roles()->first()->name !!}</strong>
                                </p>
                            </div>
                        <div class="col-sm-6 col-xs-12">
                          <p class="col-sm-4 col-xs-3 row">
                              Last Login
                          </p>
                          <p class="col-sm-7 col-xs-9 row">
                            : {{empty($user->last_login)? "No Login Data" : $user->last_login }}
                          </p>
                            </div>
                            <div class="col-sm-6 col-xs-12">
                              <p class="col-sm-4 col-xs-3 row">
                                  Unit Kerja
                              </p>
                              <p class="col-sm-7 col-xs-9 row">
                                : <strong><?php if($user->mobile_id == 0 ){ echo "Web Apps Only";} elseif($user->mobile_id == 1) {echo "Mobile Apps Only";} elseif($user->mobile_id == 2) { echo "Web & Mobile Apps";} ?></strong>
                              </p>
                              <p class="col-sm-4 col-xs-3 row">
                                  Permission
                              </p>
                              <p class="col-sm-7 col-xs-9 row">
                                : <strong>{!! empty($user->getunit->name)?"<i>Not Set</i>": $user->getunit->name!!}</strong>
                              </p>
                              </div>
                          <div class="col-sm-6 col-xs-12">
                              <p class="col-sm-4 col-xs-3 row">
                                  Created By
                              </p>
                              <p class="col-sm-7 col-xs-9 row">
                                  : {{$user->createdby->first_name}} {{$user->createdby->last_name}}
                              </p>
                          </div>
                          <div class="col-sm-6 col-xs-12">
                              <p class="col-sm-4 col-xs-3 row">
                                  Last Update
                              </p>
                              <p class="col-sm-8 col-xs-9 row">
                                  :   {{$user->updated_at}}        </p>
                          </div>
                          <div class="col-sm-6 col-xs-12">
                              <p class="col-sm-4 col-xs-3 row">
                                  Updated By
                              </p>
                              <p class="col-sm-7 col-xs-9 row">
                                  : {{$user->updatedby->first_name}} {{$user->updatedby->last_name}}     </p>
                          </div>
                          <div class="col-sm-6 col-xs-12">
                              <p class="col-sm-4 col-xs-3 row">
                                  Created At
                              </p>
                              <p class="col-sm-7 col-xs-9 row">
                                  : {{ $user->created_at }}    </p>
                          </div>

                              </div>

                  </div>
            <div id="tabModules">
              <br>
              <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover" id="editable">
                  <thead>
                    <tr>
                      <th>No.</th>
                      <th>Module</th>
                      <th>Function</th>
                    </tr>
                  </thead>

                <tbody>
                  <?php $x = 0 ?>
                      @foreach($actions as $action)
                      <?php $x++ ?>
                      <?php

                      $first= array_values($action)[0];
                      $firstname =explode(".", $first)[0];
                      ?>
                <tr>
                    <td>{{ $x }}</td>
                    <td>{{$firstname}}</td>
                    <td>
                        @foreach($action as $act)
                            @if (array_key_exists($act, $user->roles()->first()->permissions))

                                  {!! explode(".", $act)[1] !!}
                            @endif
                        @endforeach
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
            <div id="tabActivity">
              <br>
              <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover" id="editable3">
                  <thead>

                    <tr>
                      <th>No.</th>
                      <th>Modul</th>
                      <th>Description</th>
                      <th>Created At</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $x = 0 ?>
                    @foreach($activities as $activity)
                      <?php $x++?>
                      <?php
                      $char = str_replace('App', '', $activity->subject_type);
                      $modul = preg_replace('/[^A-Za-z0-9\-]/', '', $char);
                      ?>
                      <tr>
                        <td>{{ $x }}</td>
                        <td> <?=$modul?></td>
                        <td>{{ $activity->description }}</td>
                        <td>{{ $activity->created_at }}</td>
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
        $('#tabModules').hide();
        $('#tabLog').hide();
        $('#tabActivity').hide();

        $('#pilihDetail').addClass("active");

        // Klik Tab
        $('#pilihModules').click(function(){
          $('#tabDetail').hide();
          $('#tabModules').show();
          $('#tabPOP').hide();
          $('#tabLog').hide();
          $('#tabActivity').hide();

          $('#pilihModules').addClass("active");
          $('#pilihDetail').removeClass("active");
          $('#pilihLog').removeClass("active");
          $('#pilihActivity').removeClass("active");

        });

        $('#pilihDetail').click(function(){
          $('#tabDetail').show();
          $('#tabModules').hide();
          $('#tabLog').hide();
          $('#tabActivity').hide();

          $('#pilihDetail').addClass("active");
          $('#pilihModules').removeClass("active");
          $('#pilihLog').removeClass("active");
          $('#pilihActivity').removeClass("active");
        });
        $('#pilihActivity').click(function(){
          $('#tabDetail').hide();
          $('#tabModules').hide();
          $('#tabLog').hide();
            $('#tabActivity').show();
            $('#pilihLog').removeClass("active");
            $('#pilihDetail').removeClass("active");
            $('#pilihModules').removeClass("active");
            $('#pilihActivity').addClass("active");
        });
        $('#pilihLog').click(function(){
          $('#tabDetail').hide();
          $('#tabModules').hide();
          $('#tabLog').show();
            $('#tabActivity').hide();
            $('#pilihLog').addClass("active");
            $('#pilihDetail').removeClass("active");
            $('#pilihModules').removeClass("active");
            $('#pilihActivity').removeClass("active");
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
        $('#editable').DataTable();
        $('#editable2').DataTable({order: [ 3, 'desc' ]});
        $('#editable3').DataTable({order: [ 2, 'desc' ]});




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
