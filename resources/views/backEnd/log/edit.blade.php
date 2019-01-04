@extends('backLayout.app')
@section('title')
Edit Log
@stop

@section('content')

    <h1>Edit Log</h1>
    <hr/>

    {!! Form::model($log, [
        'method' => 'PATCH',
        'url' => ['log', $log->id],
        'class' => 'form-horizontal'
    ]) !!}

    

    <div class="form-group">
        <div class="col-sm-offset-3 col-sm-3">
            {!! Form::submit('Update', ['class' => 'btn btn-primary form-control']) !!}
        </div>
    </div>
    {!! Form::close() !!}

    @if ($errors->any())
        <ul class="alert alert-danger">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

@endsection