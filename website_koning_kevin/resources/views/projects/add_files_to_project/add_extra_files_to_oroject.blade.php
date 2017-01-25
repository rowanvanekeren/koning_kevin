<div class="col-md-12">
    <hr>
    <div class="form-group{{ $errors->has('name') ? 'has-error' : '' }}">
            {{ Form::label('file_title', 'Bestand titel::', array('class' => 'control-label col-md-12'))}}
            {{Form::text('file_title', old('file_title'), array('class'=>'form-control'))}}
            @if ($errors->has('file_title'))
                <span class="help-block">
                    <strong>{{$errors->first('file_title') }}</strong>
                </span>
            @endif
    </div>
    <div class="form-group{{ $errors->has('image') ? 'has-error' : '' }}">
        {{Form::label('file', 'Voeg exclusive bestanden aan project', array('class' => 'control-label col-md-12'))}}
        {{Form::file('file',array('class' => 'form-control'))}}
        @if ($errors->has('file'))
            <span class="help-block">
                <strong>{{ $errors->first('file') }}</strong>
            </span>
        @endif
    </div>

</div>