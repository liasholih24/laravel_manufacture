@extends('backLayout.app')
@section('title')
Edit Tabungan
@stop

@section('content')

    <h1>Edit Tabungan</h1>
    <hr/>

    {!! Form::model($tabungan, [
        'method' => 'PATCH',
        'url' => ['tabungan', $tabungan->id],
        'class' => 'form-horizontal'
    ]) !!}

                <div class="form-group {{ $errors->has('norek') ? 'has-error' : ''}}">
                {!! Form::label('norek', 'Norek: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::text('norek', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('norek', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('code') ? 'has-error' : ''}}">
                {!! Form::label('code', 'Code: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::text('code', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('code', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('debit') ? 'has-error' : ''}}">
                {!! Form::label('debit', 'Debit: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::number('debit', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('debit', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('kredit') ? 'has-error' : ''}}">
                {!! Form::label('kredit', 'Kredit: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::number('kredit', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('kredit', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('saldo') ? 'has-error' : ''}}">
                {!! Form::label('saldo', 'Saldo: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::number('saldo', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('saldo', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('saldo_sampah') ? 'has-error' : ''}}">
                {!! Form::label('saldo_sampah', 'Saldo Sampah: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::number('saldo_sampah', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('saldo_sampah', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('keterangan') ? 'has-error' : ''}}">
                {!! Form::label('keterangan', 'Keterangan: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::textarea('keterangan', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('keterangan', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('created_by') ? 'has-error' : ''}}">
                {!! Form::label('created_by', 'Created By: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::number('created_by', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('created_by', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('updated_by') ? 'has-error' : ''}}">
                {!! Form::label('updated_by', 'Updated By: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::number('updated_by', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('updated_by', '<p class="help-block">:message</p>') !!}
                </div>
            </div>


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