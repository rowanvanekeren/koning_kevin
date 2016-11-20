@extends('layouts.app')
@section('content')
    <div class="container" ng-controller="Show_file">
        <div class="row">
            <div class="col-md-12">
                <h1>Show Files</h1>

                <div class="form-group">
                    <div class="col-md-12">
                        {{Form::text('title', old('title'),array('class'=>'form-control', 'placeholder'=>'search'))}}
                    </div>
                </div>
                @if(Auth::user()->is_admin)
                @else
                @endif
            </div>
        </div>
    </div>
@endsection