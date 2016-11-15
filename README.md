# Koning Kevin - vrijwilligersapplicatie
	Koning Kevin vroeg ons een webapplicatie te maken waarop vrijwilligers zich makkelijk kunnen aanmelden voor projecten en de bijhorende docementen voor die projecten bekijken.

Documentatie-------------------------------------

voor form te istelen 
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