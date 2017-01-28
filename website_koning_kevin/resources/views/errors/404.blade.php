<!DOCTYPE html>
<html>
<head>
    <title>404 lanter.io</title>
</head>
<body>
<style>
    body{
        background-color: #fcf7e3;
    }
    .page_404{
        position: fixed; /* or absolute */
        top: 50%;
        left: 50%;
        width: 75%;
        height: auto;
        transform: translate(-50%, -50%);
    }
</style>

<div class="container">
    <div class="col-md-12">
        <a href="{{url('/')}}" class="thumbnail">
            <img class="page_404" src="{{url('/images/error/404.jpg')}}" >
        </a>
    </div>
</div>




</div>
</body>
</html>
