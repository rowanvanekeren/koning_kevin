@extends('layouts.app')
@section('styles')
    <link rel="stylesheet" type="text/css" href="{{url('/css/managing-files.css')}}">
@stop
@section('content')
    <div {{--style="margin-top: 80px;"--}} class="container" ng-controller="Managing_file">
        <div class="panel panel-default box-shadow-default">
            <div class="panel-heading text-center"><strong>{{--@{{ title }}--}}Bestand toevoegen</strong></div>

            {{-- <p>Voor deze pagina moet je geregistreerd + active gebruiker + admin zijn</p>--}}

            @if(Session::has('success'))
                <h1>
                    {{ Session::get('success')}}
                </h1>
            @endif
            <div class="row">
                <div class="col-md-12">

                    {{Form::open(array('url'=>'/add_file','files' => true))}}
                    <div class="form-group col-md-12 {{ $errors->has('title') ? 'has-error' : '' }}">

                        <div class="col-md-12">
                            <div class="sequencing">
                                <div>1</div>
                            </div>
                            <legend>Bestands info</legend>
                            {{ Form::label('title', 'Titel van het bestand', array('class' => 'control-label col-md-12'))}}
                            {{Form::text('title', old('title'),array('class'=>'form-control'))}}
                            @if ($errors->has('title'))
                                <span class="help-block">
                                <strong>{{ $errors->first('title') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group col-lg-12{{ $errors->has('description') ? 'has-error' : '' }}">
                        <div class="col-md-12">

                            {{ Form::label('description', 'Beschrijving', array('class' => 'control-label col-md-12'))}}
                            {{Form::textarea('description', old('description'),array('class'=>'form-control','size' => '30x5'))}}
                            @if ($errors->has('description'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>

                    <fieldset class="form-group col-md-12">

                        {{--<div class="col-md-6">--}}
                        {{--{{ Form::label('url', 'Google docs url', array('class' => 'control-label col-md-12'))}}--}}
                        {{--{{Form::text('url', old('url'),array('class'=>'form-control'))}}--}}
                        {{--@if ($errors->has('url'))--}}
                        {{--<span class="help-block">--}}
                        {{--<strong>{{ $errors->first('url') }}</strong>--}}
                        {{--</span>--}}
                        {{--@endif--}}
                        {{--</div>--}}
                        <div class="col-md-12">
                            <div class="sequencing">
                                <div>2</div>
                            </div>

                            <div>

                                <legend>Kies een bestand of voeg een link toe</legend>
                            </div>
                            {{ Form::label('file', 'Kies een bestand', array('class' => 'control-label col-md-12'))}}
                            {{Form::file('file',array('class' => 'form-control'))}}
                            @if ($errors->has('file'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('file') }}</strong>
                                    </span>
                            @endif
                        </div>
                        <div class="col-md-6">
                            {{ Form::label('category', 'Kies een categorie', array('class' => 'control-label col-md-12'))}}
                            {{Form::select('category', $categories, '0',array('class' => 'form-control'))}}
                            @if ($errors->has('category'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('category') }}</strong>
                                    </span>
                            @endif
                        </div>
                        <div class="col-md-6">
                            {{ Form::label('role', 'Kies een rol', array('class' => 'control-label col-md-12'))}}
                            {{Form::select('role', $roles, '0',array('class' => 'form-control'))}}
                            @if ($errors->has('role'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('role') }}</strong>
                                    </span>
                            @endif
                        </div>
                        {{--</fieldset>--}}
                        {{--<fieldset class="form-group col-md-6">--}}
                        {{--<div class="sequencing">--}}
                        {{--<div>3</div>--}}
                        {{--</div>--}}
                        {{--<div>--}}
                        {{--<legend>Categorie&euml;n</legend>--}}
                        {{--</div>--}}
                        {{--@if ($errors->has('categories'))--}}
                        {{--<span class="help-block">--}}
                        {{--<strong>{{ $errors->first('categories') }}</strong>--}}
                        {{--</span>--}}
                        {{--@endif--}}
                        {{--@foreach($categories as $key=>$category)--}}
                        {{--<div class="form-check col-md-12">--}}
                        {{--<label class="form-check-label">--}}
                        {{--($key == '0'? true:null)--}}
                        {{--{{ Form::checkbox('categories[]',$category->id ,0 , ['class' => 'field']) }}--}}
                        {{--{{$category->type}}--}}
                        {{--</label>--}}
                        {{--</div>--}}
                        {{--@endforeach--}}
                        {{--</fieldset>--}}


                        {{--<fieldset class="form-group col-md-6">--}}
                        {{--<div class="sequencing">--}}
                        {{--<div>4</div>--}}
                        {{--</div>--}}
                        {{--<div>--}}
                        {{--<legend>Rollen</legend>--}}
                        {{--</div>--}}
                        {{--@if ($errors->has('roles'))--}}
                        {{--<span class="help-block">--}}
                        {{--<strong>{{ $errors->first('roles') }}</strong>--}}
                        {{--</span>--}}
                        {{--@endif--}}
                        {{--@foreach($roles as $key=>$role)--}}
                        {{--<div class="form-check col-md-12">--}}
                        {{--<label class="form-check-label">--}}
                        {{--($key == '0'? true:null)--}}
                        {{--{{ Form::checkbox('roles[]',$role->id,0, ['class' => 'field']) }}--}}
                        {{--{{$role->type}}--}}
                        {{--</label>--}}
                        {{--</div>--}}
                        {{--@endforeach--}}
                        {{--</fieldset>--}}

                        <fieldset class="form-group col-md-12">
                            <div class="sequencing">
                                <div>3</div>
                            </div>
                            <div>
                                <legend>Prioriteit</legend>
                            </div>
                            <div class="form-check col-md-4">
                                <label class="form-check-label">
                                    {{Form::radio('priority', 0,true,array('class'=>'form-check-input'))}}
                                    Laag
                                </label>
                            </div>
                            <div class="form-check col-md-4">
                                <label class="form-check-label">
                                    {{Form::radio('priority', 1,null,array('class'=>'form-check-input'))}}
                                    Gemiddeld
                                </label>
                            </div>
                            <div class="form-check col-md-4">
                                <label class="form-check-label">
                                    {{Form::radio('priority', 2,null,array('class'=>'form-check-input'))}}
                                    Hoog
                                </label>
                            </div>
                        </fieldset>
                        <div class="col-md-6">
                            <div class="sequencing">
                                <div>4</div>
                            </div>
                            {{--even aude validatie variabele doorgeven aan angularjs voord niet getoond in vieuw --}}
                            <?php echo "<div ng-init='init(" . '"' . old('tags') . '"' . ")'></div>";?>

                            {{ Form::label('tags', 'Voeg hiet enkele tags', array('class' => 'control-label col-md-12'))}}
                            {{Form::text('tags', old('tags'),array('class'=>'form-control','ng-model'=>'tags','ng-keypress'=>'(($event.keyCode === 32)?tags_enter(tags):"0")'))}}
                            @if ($errors->has('tags'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('tags') }}</strong>
                    </span>
                            @endif
                        </div>

                        <div class="col-md-12">
                            {{Form::submit('Bestand toevoegen',array('class'=>'btn btn-primary btn-margin-custom') )}}
                        </div>

                    {{Form::close()}}
                </div>
            </div>
        </div>
    </div>
@endsection