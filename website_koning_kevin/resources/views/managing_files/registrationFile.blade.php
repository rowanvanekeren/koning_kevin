@extends('layouts.app')
@section('styles')
    <link rel="stylesheet" type="text/css" href="{{url('/css/show-file.css')}}">
@stop
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">

                <div class="panel panel-default box-shadow-default">
                    <div class="panel-heading">Registratiebestand</div>
                    <div class="panel-body">
                        <div class="row">
                            @if(Session::has('success'))
                                <div class="col-md-12 alert alert-success">
                                    {{ Session::get('success')}}
                                </div>
                            @endif
                            {{Form::open(array('url'=>'/registratiebestand','files' => true))}}
                            <div class="form-group col-md-12 {{ $errors->has('title') ? 'has-error' : '' }}">

                                <div class="col-md-12">
                                    <legend>Oude bestand</legend>
                                    <a href="{{url('/leesmij')}}"><h3 >Lezen van de voorwaarde<span
                                                    class="pull-right glyphicon glyphicon-download-alt"></span></h3></a>
                                </div>
                                {{ Form::label('file', 'Kies nieuw bestand', array('class' => 'control-label col-md-12'))}}
                                {{Form::file('file',array('class' => 'form-control'))}}
                                @if ($errors->has('file'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('file') }}</strong>
                                    </span>
                                @endif
                            </div>
                            </div>
                        {{Form::submit('opslaan',['class'=>'btn btn-primary float-right btn-margin-custom'])}}
                            {{Form::close()}}

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection