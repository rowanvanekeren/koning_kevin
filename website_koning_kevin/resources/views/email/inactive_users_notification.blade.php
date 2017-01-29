<!DOCTYPE html>
<html>
<head>
    <title>Page Title</title>
</head>
<body>


<h1 class="float-right">Nieuwe vrijwilligers</h1>
<table width="1200" border="0" cellspacing="0" cellpadding="0" style="border:1px solid #ccc;">
    @foreach($users as $key=>$user)

        <tr>

            <td width="20">{{$key}}</td>
            <td width="100"><img width="90" height="90"
                                 src="{{url('/').'/images/profile_pictures/'.$user->url}}"></td>
            <td><a href="{{url('/').'/profiel/'.$user->id}}">{{$user->first_name}} {{$user->last_name}}</a></td>

        </tr>

    @endforeach
</table>


</body>
</html>