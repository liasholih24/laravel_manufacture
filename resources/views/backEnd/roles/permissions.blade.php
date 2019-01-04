@extends('backLayout.app')
@section('title')
{{$role->is_group ?"Group permissions":"Role permissions"}}
@stop
@section('style')
{{ HTML::style('assets_back/css/plugins/iCheck/custom.css') }}
@endsection
@section('content')
<div class="wrapper wrapper-content">
  <div class="row ibox-title">
<ol class="breadcrumb col-sm-6 col-xs-12" style="font-size: 14px; padding-top: 6px; ">
    <li class="">
        <a href="{{ url('role') }}">  Roles
        </a>
    </li>
    
    <li class="">
            <a href="#">
                Edit Permission
            </a>
    </li>

    <li class="active">
            <a href="{{ url('role/'.$role->id.'/show') }}">
                {{$role->name}}
            </a>
    </li>
    <li class="active">
            <a href="#">
                {{$modules}}
            </a>
    </li>
</ol>
        <a href="{{ url('role') }}">
        <button class="btn btn-sm btn-outline btn-warning pull-right">
        <i class="fa fa-arrow-circle-o-left" style="margin-right: 5px"></i> Back
        </button>
        </a>
</div>
  <div class="row detail_content3">
  <div class="col-lg-12 detail_content2" style="background-color: white">

  <div class="row ibox-content" style="min-height: 65vh; ">
  	<div class="col-xs-12 col-sm-12">
        <div class="panel-heading"></div>
        <div class="panel-body">

{{ Form::open(array('url' => route('role.save', $role->id), 'class' => 'form-horizontal')) }}
    <ul>
    <div class="content form-group col-sm-22 col-xs-12">
    @foreach($actions as $action)
    <?php $first= array_values($action)[0];
      $firstname =explode(".", $first)[0];

    ?>

  @foreach($action as $act)
            @if(explode(".", $act)[0]=="api")
            <!--
            <div class="col-sm-1"> 
              <input type="checkbox" name="permissions[]" value="{{$act}}"  {{array_key_exists($act, $role->permissions)?"checked":""}}>
            </div> -->
            <div class="col-sm-3" style="padding: 10px 0">
                <input type="checkbox" name="permissions[]" value="{{$act}}" class="form-control i-checks" {{array_key_exists($act, $role->permissions)?"checked":""}}> &nbsp;  {{isset(explode(".", $act)[2])?explode(".", $act)[1].".".explode(".", $act)[2]:explode(".", $act)[1]}}
            </div>

            @elseif (explode(".", $act)[0] == $modules)
            <!--<div class="col-sm-1">
              {{explode(".", $act)[1]}}
              <input type="checkbox" name="permissions[]" value="{{$act}}" {{array_key_exists($act, $role->permissions)?"checked":""}}>
              </div>-->
              <div class="col-sm-3" style="padding: 10px 0">
                <input type="checkbox" name="permissions[]" value="{{$act}}" class="form-control i-checks" {{array_key_exists($act, $role->permissions)?"checked":""}}> &nbsp;  {{explode(".", $act)[1]}}
            </div>
              @elseif(explode(".", $act)[0]!= $modules)
              <div class="">

              <input type="checkbox" style="display:none;" name="permissions[]" value="{{$act}}" {{array_key_exists($act, $role->permissions)?"checked":""}}>
                </div>
             @endif
            @endforeach
    @endforeach
      </div>
</div>
 <div class="hr-line-dashed"></div>
    <div class="form-group">
      <a href="{{$role->is_group ? route('group.index'):route('role.index')}}" class="detail2 btn btn-md btn-outline btn-danger pull-right">  
        <i class="fa fa-times-circle" ></i> Cancel</a>
      <button type="submit" class="create_mdl btn btn-outline btn-primary pull-right" style="margin-right: 10px; "> 
        <i class="fa fa-save"></i>  Update
      </button>
      </a>
    </div>
    </div>
    </ul>
    {{ Form::close() }}
</div>
</div>
</div>
</div>
@endsection
@section('script')
{{ HTML::script('assets_back/js/plugins/iCheck/icheck.min.js') }}
<script>
    jQuery(document).ready(function() {

      $('.i-checks').iCheck({
            checkboxClass: 'icheckbox_square-green',
            radioClass: 'iradio_square-green',
        });

      });
</script>
@endsection
