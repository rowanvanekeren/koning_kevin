@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="row">

            <div class="col-md-12" ng-controller="Managing_projects">
                <div class="panel panel-default box-shadow-default z-index-fix">
                    <div class="panel-heading text-center"><strong>Zit je met een vraag voor Koning Kevin? Laat het
                            dan achter in dit formulier en we zorgen ervoor dat je
                            vraag bij de juiste persoon terecht komt<br> Binnen de week mag je een antwoord verwachten.</strong></div>
                    <div class="panel-body">
                        @if(Session::has('success'))
                            <div class="col-md-12 alert alert-success">

                                {{ Session::get('success')}}

                            </div>
                        @endif

                        {{Form::open(array('url'=>'/contact','files' => true))}}
                        <div class="form-group col-lg-12{{ $errors->has('title') ? 'has-error' : '' }}">
                            <div class="col-md-12">
                                {{ Form::label('title', 'Titel van bericht', array('class' => 'control-label col-md-12'))}}
                                {{Form::text('title', old('title'),array('class'=>'form-control'))}}                                @if ($errors->has('description'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group col-lg-12{{ $errors->has('bericht') ? 'has-error' : '' }}">
                            <div class="col-md-12">

                                {{ Form::label('bericht', 'Bericht', array('class' => 'control-label col-md-12'))}}
                                {{Form::textarea('bericht', old('description'),array('class'=>'form-control','size' => '30x5'))}}
                                @if ($errors->has('bericht'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('bericht') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        {{Form::submit('Verzenden',['class'=>'btn btn-primary btn-margin-custom'])}}
                        {{Form::close()}}

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection