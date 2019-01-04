@extends('backLayout.app')
@section('title')
Log
@stop

@section('content')

    <h1>Log</h1>
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th>ID.</th> 
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $log->id }}</td> 
                </tr>
            </tbody>    
        </table>
    </div>

@endsection