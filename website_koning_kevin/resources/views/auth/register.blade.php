@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Registreren</div>
                    <div class="panel-body">

                        @if (count($errors) > 0)
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="alert alert-danger">
                                        <strong>Het registratieformulier werd niet correct ingevuld!</strong>
                                    </div>
                                </div>
                            </div>
                        @endif

                        <form class="form-horizontal" role="form" method="POST" action="{{ url('/register') }}"
                              enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label for="name" class="col-md-4 control-label">Voornaam:</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control" name="name"
                                           value="{{ old('name') }}" autofocus>

                                    @if ($errors->has('name'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('last_name') ? ' has-error' : '' }}">
                                <label for="last_name" class="col-md-4 control-label">Achternaam:</label>

                                <div class="col-md-6">
                                    <input id="last_name" type="text" class="form-control" name="last_name"
                                           value="{{ old('last_name') }}">

                                    @if ($errors->has('last_name'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('last_name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label for="email" class="col-md-4 control-label">E-mail:</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control" name="email"
                                           value="{{ old('email') }}">

                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('url') ? ' has-error' : '' }}">
                                <label for="url" class="col-md-4 control-label">Profielfoto:</label>

                                <div class="col-md-6">
                                    <input id="url" type="file" class="form-control" name="url" value="{{ old('url') }}" accept=".jpg,.png">

                                    @if ($errors->has('url'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('url') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
                                <label for="address" class="col-md-4 control-label">Adres:</label>

                                <div class="col-md-6">
                                    <input id="last_name" type="text" class="form-control" name="address"
                                           value="{{ old('address') }}">

                                    @if ($errors->has('address'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('address') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('city') ? ' has-error' : '' }}">
                                <label for="city" class="col-md-4 control-label">Stad:</label>

                                <div class="col-md-6">
                                    <input id="city" type="text" class="form-control" name="city"
                                           value="{{ old('city') }}">

                                    @if ($errors->has('city'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('city') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('country') ? ' has-error' : '' }}">
                                <label for="country" class="col-md-4 control-label">Land:</label>
                                
                                <div class="col-md-6">
                                    <select id="country" class="form-control" name="country" required>
                                        <option value="België" selected>België</option>
                                        <option value="Nederland">Nederland</option>
                                        <option value="Frankrijk">Frankrijk</option>
                                        <option value="Duitsland">Duitsland</option>
                                    </select>
                                    @if ($errors->has('country'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('country') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('birth_place') ? ' has-error' : '' }}">
                                <label for="birth_place" class="col-md-4 control-label">Geboorteplaats:</label>

                                <div class="col-md-6">
                                    <input id="birth_place" type="text" class="form-control" name="birth_place"
                                           value="{{ old('birth_place') }}">
                                    @if ($errors->has('birth_place'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('birth_place') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('birth_date') ? ' has-error' : '' }}">
                                <label for="birth_date" class="col-md-4 control-label">Geboortedatum:</label>

                                <div class="col-md-6">
                                    {{Form::date('birth_date', old('birth_date'),array('class'=>'form-control', 'placeholder'=>'jjjj-mm-dd'))}}
                                    @if ($errors->has('birth_date'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('birth_date') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('gender') ? ' has-error' : '' }}">
                                <label for="gender" class="col-md-4 control-label">Geslacht</label>

                                <div class="col-md-6 gender_input">
                                    <input type="radio" name="gender" id="male" value="M" <?php if(old('gender')){if(old('gender') == "M") {echo('checked');}} ?>><label for="male">Man</label>
                                    <input type="radio" name="gender" id="female" value="V" <?php if(old('gender')){if(old('gender') == "V") {echo('checked');}} ?>><label for="female">Vrouw</label>
                                    <input type="radio" name="gender" id="not_specified" value="X" <?php if(old('gender')){if(old('gender') == "X") {echo('checked');}} ?>><label for="not_specified">Anders</label>
                                    @if ($errors->has('gender'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('gender') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('readme') ? ' has-error' : '' }}">


                                <label for="readme" class="col-md-4 control-label">Voorwaarden gelezen en goedgekeurd</label>
                                <div class="col-md-6 readme_input">

                                    <input id="readme" type="checkbox" name="readme" {{ old('readme')?'checked':""}} value="1"
                                           required><span>(<a href="{{url('/leesmij')}}" target="_blank">Bekijk voorwaarden</a>)</span>
                                    @if ($errors->has('readme'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('readme')}}</strong>
                                    </span>
                                    @endif
                                </div>

                            </div>

                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <label for="password" class="col-md-4 control-label">Paswoord</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control" name="password">

                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="password_confirmation" class="col-md-4 control-label">Bevestig paswoord</label>

                                <div class="col-md-6">
                                    <input id="password_confirmation" type="password" class="form-control"
                                           name="password_confirmation">
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        Registreer
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
