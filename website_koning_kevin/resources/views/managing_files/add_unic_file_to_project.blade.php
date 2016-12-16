<div>
    {{Form::open(array('url'=>'/add_unic_file_to_project','files' => true))}}
    <div class="col-md-12">
        <legend>Bestand selecteren</legend>
        {{ Form::label('title', 'Titel van het bestand', array('class' => 'control-label col-md-12'))}}
        {{Form::text('title', old('title'),array('class'=>'form-control'))}}
        @if ($errors->has('title'))
            <span class="help-block">
                                <strong>{{ $errors->first('title') }}</strong>
                            </span>
        @endif
    </div>
    <div class="col-md-12">
        {{ Form::label('file', 'Selecteer een bestand', array('class' => 'control-label col-md-12'))}}
        {{Form::file('file',array('class' => 'form-control'))}}
        @if ($errors->has('file'))
            <span class="help-block">
                                <strong>{{ $errors->first('file') }}</strong>
                            </span>
        @endif
    </div>
    <div class="col-md-12">
        {{Form::submit('Bestand toevoegen',array('class'=>'btn btn-primary btn-margin-custom') )}}
    </div>
    {{Form::close()}}
</div>
