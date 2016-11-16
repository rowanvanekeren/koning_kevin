# Koning Kevin - vrijwilligersapplicatie
	Koning Kevin vroeg ons een webapplicatie te maken waarop vrijwilligers zich makkelijk kunnen aanmelden voor projecten en de bijhorende docementen voor die projecten bekijken.

Documentatie-------------------------------------

Constants --------------------------------
Voor categoien
 	$alle_categorien = config('categorys');
	$een_category_onder_index = config('categorys.0'); of $alle_categorien[$index];
op zelfde manier voor rollen
	config('roles');
constanten ligen onder het map config/roles.php of categorys.php

Heb je eigen constanten nodig maak een file aan in config return en array en you rady to go (-:
Gebruik bij dropDowns -> geef door me met view " return view('jouw_view',['variabel_name'=>config('roles')]";
{{Form::select('category', $categorys, '$index_of_first_element',array('class'=>'form-control'))}}


middleware----------------------------------
kan direct aan de routes gegeven worden of als constructor in controller 

voor ingelogde -> niet active gebruikers 
	$this->middleware('auth');

voor ingelogde ->active gebruikers
	$this->middleware('auth');
	$this->middleware('is_active');

voor ingelogde -> admin hoeft niet active zijn (-: 
	$this->middleware('auth');
	$this->middleware('is_admin');





laravel forms ----------------------------------

usage

{{Form::open(array('url'=>'/add_file','files' => true))}}
	{{ Form::label('title', 'Titel van het bestand', array('class' => 'control-label col-md-12'))}}
        {{Form::text('title', old('title'),array('class'=>'form-control'))}}
{{Form::close()}}

composer require "laravelcollective/html":"^5.2.0"

in config file--> config/app.php:
'providers' => [
    // ...
    Collective\Html\HtmlServiceProvider::class,
    // ...
  ],

 'aliases' => [
    // ...
      'Form' => Collective\Html\FormFacade::class,
      'Html' => Collective\Html\HtmlFacade::class,
    // ...
  ],

