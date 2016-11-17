@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <h1>Dashboard</h1>
            <p>Profiel info</p>
            
            <div>
                {{$user->first_name}}
                {{$user->last_name}}<br>
                {{$user->email}}<br>
                {{$user->address}}<br>
                {{$user->country}}<br>
                {{$user->birth_date}}<br>
                {{$user->birth_place}}<br>
                {{$user->job}}<br>
                {{$user->job_function}}<br>
            </div>
            <div>
                Adminstratieve gegevens -> checken of er al administratieve gegevens aan deze user gelinkt zijn
            </div>
        </div>
    </div>
</div>

@endsection