@extends('layouts.app')
@section('styles')
    <link rel="stylesheet" type="text/css" href="{{url('/css/show-file.css')}}">
@stop
@section('content')


    <div class="container-fluid" ng-controller="Show_file">
        <div class="row">
            {{--   <h1 class="col-md-12">Documenten</h1>
               <h3 class="col-md-12">Bij het zoeken: getypte woord wordt gezocht op categorieen, tags, rollen, ook als
                   woord in beschrijving voorkomt: verwijder mij na het stylen (-:</h3>
               <h3 class="col-md-12">bij categorie: background worden weergegeven in bepalde kleur -> priority-> daar moet
                   nog iets op gevonden worden </h3>--}}
            @if(Auth::user()->is_admin)
                <div class="col-md-6 ">
                    <div class="panel panel-default">
                        <div class="panel-heading">Categorieen</div>
                        <div class="panel-body">
                            {{--Rowan -> om een prioriteid toe te voegen gebruik volgede code file_row_background@{{file.priority}}
                                        binnen het ng-repeat functie van angularjs 0->laag1 1->Gemiddelde 2->Hoog
                                        --}}
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
                            <div class="row">
                                <div class="col-md-12">
                                    <p class="label label-success" ng-if="message.success">@{{message.success}}</p>
                                    <p class="label label-danger" ng-if="message.error">@{{message.error}}</p>
                                </div>
                            </div>
                            <uib-accordion close-others="oneAtATime">
                                <div uib-accordion-group class="panel-default" is-open="status.open"
                                     ng-repeat="category in categories">
                                    <uib-accordion-heading>
                                        <span ng-click="get_file_for_category(category.id)">@{{category.type}}</span><i
                                                class="pull-right glyphicon"
                                                ng-class="{'glyphicon-chevron-down': status.open, 'glyphicon-chevron-right': !status.open}"></i>
                                    </uib-accordion-heading>
                                    <div ng-repeat="file in files"
                                         class="row file_row_background@{{file.priority}}">

                                        <div class="col-md-12 carr-document">
                                            <p uib-popover="@{{file.description}}"
                                               popover-trigger="'mouseenter'"
                                               popover-placement="bottom-left" class="col-md-9" data-toggle="modal"
                                               data-target="#myModal" ng-click="ang_modal(file.id)">
                                                @{{file.title}}
                                            </p>
                                        </div>
                                        <div class="col-md-12 carr-glyph">
                                            <a href="{{url('/')}}@{{ file.url}}"><span
                                                        class="col-md-1 glyphicon glyphicon-download-alt"></span>
                                            </a>
                                            <a href="#"><span
                                                        class="col-md-1 glyphicon glyphicon-pencil"></span></a>
                                            <a href="#"><span ng-click="delete_document(file.id)"
                                                              class="col-md-1 glyphicon glyphicon-trash"></span></a>
                                        </div>

                                    </div>
                                </div>
                            </uib-accordion>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 ">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Zoeken
                        </div>
                        <div class="panel-body">
                            {{Form::text('title', old('title'),array('class'=>'form-control', 'placeholder'=>'Zoek over alle bestanden', 'ng-model'=>"query[queryBy]"))}}
                            {{Form::select('category', array('$'=>'alles','title'=>'Titel','description'=>'Beschrijving','roles.type'=>'Rollen',
                            'categories.type'=>'Categorieen','tags.type'=>'Tag'),
                            '0',array('class' => 'form-control','ng-model'=>'queryBy','ng-click'=>'query=""'))}}
                            {{--er voord gelimiteerde antaal bestanden getond maar als je zoekt gaan andere getoond worden--}}
                            <div class="row carr-document "
                                 ng-repeat="file in search_files|filter:query ">

                                <p uib-popover="@{{file.description}}" popover-trigger="'mouseenter'"
                                   popover-placement="bottom-left" class="col-md-9" ng-click="ang_modal(file.id)"
                                   data-toggle="modal"
                                   data-target="#myModal">@{{file.title}}</p>

                                <div class="col-md-3">
                                    <div class="pull-right">
                                        <a href="{{url('/')}}@{{ file.url}}"><span
                                                    class=" glyphicon glyphicon-download-alt"></span>
                                        </a>
                                        <a href="#"><span
                                                    class=" glyphicon glyphicon-pencil"></span></a>
                                        <a href="#"><span ng-click="delete_document(file.id)"
                                                          class="glyphicon glyphicon-trash"></span></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <h1>Deze optie is momenteel alleen zichtbaar voor andmin->zie dat je admin bent!</h1>
            @endif
            <div class="modal fade" id="myModal" role="dialog">
                <div class="modal-dialog">
                    <!-- Modal content-->
                    <div class="modal-content" ng-if="file_info">
                        <div class="modal-header" ng-if="file_info">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">@{{ file_info.file.title }}</h4>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <h5>Beschrijving</h5>
                                    <p>@{{ file_info.file.description }}</p>
                                </div>
                                <div class="col-md-6">
                                    <h5>Categorieen</h5>
                                    <p ng-repeat="category in file_info.categories">
                                        @{{ category.type }}
                                    </p>
                                </div>
                                <div class="col-md-6">
                                    <h5>Rollen</h5>
                                    <p ng-repeat="rol in file_info.roles">
                                        @{{ rol.type }}
                                    </p>
                                </div>
                                <div class="col-md-12">
                                    <h5>Tags</h5>
                                    <p ng-repeat="tag in file_info.tags">
                                        <span ng-if="tag.type">#</span>@{{ tag.type }}
                                    </p>
                                </div>
                            </div>


                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close
                            </button>
                        </div>
                    </div>
                    <div class="modal-content" ng-if="!file_info">
                        <div class="modal-header" ng-if="file_info">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Er ging iets mis, maak een printscreen van deze pagina
                                en stuur door aan de moderator.</h4>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    </div>
@endsection