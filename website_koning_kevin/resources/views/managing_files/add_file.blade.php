@extends('layouts.app')

@section('content')

    <div class="container">
        <h1>Show projects</h1>
        <p>Voor deze pagina moet je geregistreerd + active gebruiker + admin zijn</p>
        <div class="row">
            <div class="col-md-12">

                {{Form::open(array('url'=>'/add_file'))}}

                <div class="form-group{{ $errors->has('birth_date') ? ' has-error' : '' }}">
                   {{ Form::label('email', 'E-Mail Address', array('class' => 'awesome'));}}

                    <div class="col-md-6">
                        {{Form::date('birth_date', old('birth_date'),array('class'=>'form-control'))}}
                        @if ($errors->has('birth_date'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('birth_date') }}</strong>
                                    </span>
                        @endif
                    </div>

                <div class="form-group{{ $errors->has('birth_date') ? ' has-error' : '' }}">
                    <label for="birth_date" class="col-md-4 control-label">Geborte datum</label>

                    <div class="col-md-6">
                        {{Form::date('birth_date', old('birth_date'),array('class'=>'form-control'))}}
                        @if ($errors->has('birth_date'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('birth_date') }}</strong>
                                    </span>
                        @endif
                    </div>
                    {{ Form::close()}}
                </div>
            </div>
        </div>
    </div>

@endsection