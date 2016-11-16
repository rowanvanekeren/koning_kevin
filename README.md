# Koning Kevin - vrijwilligersapplicatie
	Koning Kevin vroeg ons een webapplicatie te maken waarop vrijwilligers zich makkelijk kunnen aanmelden voor projecten en de bijhorende docementen voor die projecten bekijken.

Documentatie-------------------------------------

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