@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <h1>Dashboard</h1>
            <p>wacht tot je geaccepteerd wordt. Dan pas kan je app werder gebruiken</p>
            <p id="jock"></p>
        </div>
    </div>
</div>

    <script>
        var mamjoks=["Yo momma is so fat, I took a picture of her last Christmas and it's still printing.",'Yo mamma is so fat, her pants size is Bitch lose some weight','Yo mama so stupid she got locked in a grocery store and starved','Yo mama so old her birth certificate says expired on it.','Yo mama so stupid she got hit by a parked car','Yo mama so stupid she thinks a quarterback is a refund','Yo mama is so stupid she sat on the TV and watched the couch'];
        document.getElementById('jock').innerHTML=mamjoks[ Math.floor((Math.random() * mamjoks.length))];
        setInterval(function () {
           document.getElementById('jock').innerHTML=mamjoks[ Math.floor((Math.random() * mamjoks.length))];
       },7000);
    </script>
@endsection
