<!DOCTYPE html>
<html>
<head>
    <title>Page Title</title>
</head>
<body>

<h1>Geachte,</h1><br>
<h2 class="float-right">Nieuwe vrijwilligers {{$user->first_name}} {{$user->last_name}} heeft zich aangemeld </h2>
<img width="90" height="90"
     src="{{url('/').'/images/profile_pictures/'.$user->url}}">

<p>MVG</p>

<p>Admin</p>


</body>
</html>

