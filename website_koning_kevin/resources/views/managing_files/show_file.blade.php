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
                    <div class="row" ng-repeat="category in files">
                        <div class="col-md-12">
                            {{--@{{ file.type }}--}}
                            <button class="btn btn-primary col-md-12" type="button" data-toggle="collapse"
                                    data-target="#@{{ $index }}" aria-expanded="false"
                                    aria-controls="@{{ $index }}">
                                @{{ category.category.type }}
                            </button>

                            <div class="collapse col-md-12" id="@{{ $index }}">
                                <div class="card card-block">
                                    <div class="col-md-12" ng-repeat="file in category.files.all">
                                        <a href="@{{ file.url}}">@{{ file.title}}</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                @endif
            </div>
        </div>
    </div>
@endsection