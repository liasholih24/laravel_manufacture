@extends('backLayout.app')
@section('title')
Tabungan
@stop

@section('content')

    <h1>Tabungan</h1>
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th>ID.</th> <th>Norek</th><th>Code</th><th>Debit</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $tabungan->id }}</td> <td> {{ $tabungan->norek }} </td><td> {{ $tabungan->code }} </td><td> {{ $tabungan->debit }} </td>
                </tr>
            </tbody>    
        </table>
    </div>

@endsection