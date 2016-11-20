@extends('layouts.app')
@section('content')
    <div class="container" ng-controller="Show_file">
        <div class="row">
            <div class="col-md-12">
                <h1>Show Files</h1>

                <div class="form-group">
                    <div class="col-md-12">
                        {{Form::text('title', old('title'),array('class'=>'form-control', 'placeholder'=>'search', 'ng-model'=>"searchText"))}}
                    </div>
                </div>
                @if(Auth::user()->is_admin)
                    <div class="row">
                        <div class="col-md-12">
                            <p class="label label-success" ng-if="message.success">@{{message.success}}</p>
                            <p class="label label-danger" ng-if="message.error">@{{message.error}}</p>
                        </div>
                    </div>
                    {{--| filter:searchText--}}
                    <div class="row" ng-repeat="category in files  ">
                        <div class="col-md-12">
                            {{--@{{ file.type }}--}}
                            <button class="btn btn-primary col-md-12 col-xs-12" type="button" data-toggle="collapse"
                                    data-target="#@{{ $index }}" aria-expanded="false"
                                    aria-controls="@{{ $index }}">
                                @{{ category.category.type }}
                            </button>

                            <div class="collapse col-md-12" id="@{{ $index }}">
                                <div class="card card-block">
                                    <div class="col-md-12 col-xs-12" ng-repeat="file in category.files.all">
                                        <h3 class="col-md-12">
                                            <a class="col-md-10" href="@{{ file.url}}">@{{file.title}}</a>
                                            <a><span  class="col-md-1 glyphicon glyphicon-pencil" ></span></a>
                                           <a><span ng-click="delete_document(file.id)" class="col-md-1 glyphicon glyphicon-trash"></span></a>
                                        </h3>
                                        <div class="col-md-10"><p >@{{file.description}}</p></div>
                                        {{--<div class="col-md-2">--}}
                                            {{--<p ng-repeat="role in category.files.roles">--}}
                                                {{--@{{ role.type }}--}}
                                            {{--</p>--}}
                                        {{--</div>--}}
                                        {{--<div class="col-md-2">--}}
                                            {{--<p ng-repeat="tags in category.files.tags">--}}
                                                {{--@{{ tags.type }}--}}
                                            {{--</p>--}}
                                        {{--</div>--}}

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