<!DOCTYPE html>
<html>
<head>
    <title>Page Title</title>
</head>
<body>
<h1 class="float-right">Aangemeld voor project</h1>
<table width="1200" border="0" cellspacing="0" cellpadding="0" style="border:1px solid #ccc;">
    @foreach($projects as $key=>$project)
        <tr>
            <td width="20">{{$key}}</td>
            <td width="100"><img width="90" height="90"
                                 src="{{url('/').'/images/project_pictures/'.$project->image}}"></td>
            <td><a href="{{url('/').'/project_info/'.$project->id}}">{{$project->name}}</a></td>
            <td>
                @foreach($project->users as $user)
                    <p><a href="{{url('/').'/profiel/'.$user->id}}">{{$user->first_name}} {{$user->last_name}}</a></p>
                @endforeach
            </td>
        </tr>
    @endforeach
</table>
</body>
</html>