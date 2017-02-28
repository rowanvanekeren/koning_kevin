<!DOCTYPE html>
<html>
<head>
    <title>Page Title</title>
</head>
<body>

<p>Geachte,</p><br>
<p class="float-right">Nieuwe vrijwilligers {{$user->first_name}} {{$user->last_name}} heeft zich aangemeld </p>
<img width="90" height="90"
     src="{{url('/').'/images/profile_pictures/'.$user->url}}">

<p>MVG</p>

<p>Admin</p>


</body>
</html>

