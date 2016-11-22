@extends('layouts.app')
@section('content')

    <div class="container-fluid" ng-controller="Show_file">
        <div class="row">
            <h1 class="col-md-12">Documenten</h1>
            <div class="col-md-6 ">
                <div class="panel panel-default">
                    <div class="panel-heading">Categorieen</div>
                    <div class="panel-body">
                        @if(Auth::user()->is_admin)
                            <div class="row">
                                <div class="col-md-12">
                                    <p class="label label-success" ng-if="message.success">@{{message.success}}</p>
                                    <p class="label label-danger" ng-if="message.error">@{{message.error}}</p>
                                </div>
                            </div>
                            {{--| filter:searchText--}}
                            <div class="row" ng-repeat="category in files  ">
                                <div class="">
                                    {{--@{{ file.type }}--}}
                                    <a class="btn btn-primary col-md-12 col-xs-12" type="button"
                                       data-toggle="collapse"
                                       data-target="#@{{ $index }}" aria-expanded="false"
                                       aria-controls="@{{ $index }}">
                                        @{{ category.category.type }}
                                        <span></span>
                                    </a>
                                    <style>
                                        .file_row_background0 {
                                            padding-top: 3%;
                                            background-color: #fff;
                                        }

                                        .file_row_background1 {
                                            padding-top: 3%;
                                            background-color: lightcyan;
                                        }

                                        .file_row_background2 {
                                            padding-top: 3%;
                                            background-color: lightsalmon;
                                        }

                                        .btn-primary {
                                            border-radius: 0;
                                            text-align: left;
                                        }
                                    </style>

                                    <div class="collapse col-md-12" id="@{{ $index }}">
                                        <div class="card card-block">
                                            <div ng-repeat="file in category.files.all"
                                                 class="row file_row_background@{{file.priority}}">
                                                <p ng-click="show_more_info(file.id)" class="col-md-9">
                                                    @{{file.title}}
                                                </p>
                                                <a href="@{{ file.url}}"><span
                                                            class="col-md-1 glyphicon glyphicon-download-alt"></span>
                                                </a>
                                                <a href="#"><span class="col-md-1 glyphicon glyphicon-pencil"></span></a>
                                                <a href="#"><span ng-click="delete_document(file.id)"
                                                         class="col-md-1 glyphicon glyphicon-trash"></span></a>
                                            </div>
                                            <div class="col-md-10"><p>@{{file.description}}</p></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @else
                        @endif
                    </div>
                </div>
            </div>

            <div class="col-md-6 ">
                <div class="panel panel-default">
                    <div class="panel-heading">


                        {{Form::text('title', old('title'),array('class'=>'form-control', 'placeholder'=>'Zoek over alle bestanden', 'ng-model'=>"searchText"))}}

                    </div>
                    <div class="panel-body">

                    </div>
                </div>
            </div>
        </div>

@endsection