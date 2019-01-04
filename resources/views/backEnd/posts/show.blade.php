@extends('backLayout.app')
@section('title')
Post
@stop

@section('content')
    <div class="wrapper wrapper-content article">
    					<div class="row detail_content3">
    	<div class="col-lg-12 detail_content2" style="background-color: white"><style>
    						.ibox { margin: 1px 2px 0px 0px !important }
    						.ibox.float-e-margins{ margin: 0px 2px !important}
    						</style>
          <div class="row ibox-title">
       <ol class="breadcrumb col-sm-6 col-xs-12" style="font-size: 14px; padding-top: 6px; ">
            <li class="">
                <a href="{{ url('posts') }}">  Post
            </li>
            /
            <li class="">
                    <a href="#">
                        Show Post
                    </a>
            </li>
        </ol>
                <a href="{{ url('posts') }}">
                <button class="btn btn-sm btn-outline btn-warning pull-right">
                <i class="fa fa-arrow-circle-o-left" style="margin-right: 5px"></i> Back
                </button>
                </a>
        </div>
        <div class="ibox">
                            <div class="ibox-content">
                                <div class="text-center article-title">
                                <span class="text-muted"><i class="fa fa-clock-o"></i> {{date('d F Y H:i',strtotime($post->date_posted))}}</span>
                                    <h1>
                                        {{$post->title}}
                                    </h1>
                                    <img src="{{url('/'.$post->thumbnail)}}" style="width:70%">
                                </div>
                                {!! $post->content !!}
                                <hr>

                            </div>
                        </div>
    </div>
@endsection
