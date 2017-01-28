<div class="col-md-12">
    <div class="panel panel-default box-shadow-default">
        <div class="panel-heading">Categorieen</div>
        <div class="panel-body">
            {{--Rowan -> om een prioriteid toe te voegen gebruik volgede code file_row_background@{{file.priority}}
                        binnen het ng-repeat functie van angularjs 0->laag1 1->Gemiddelde 2->Hoog
                        --}}
            <style>
                .file_row_background0 {

                    background-color: #fff;
                }

                .file_row_background1 {

                    background-color: lightcyan;
                }

                .file_row_background2 {

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
                        <div ng-click="get_file_for_category(category.id)">
                            <span>@{{category.type}}</span><i
                                    class="pull-right glyphicon"
                                    ng-class="{'glyphicon-chevron-down': status.open, 'glyphicon-chevron-right': !status.open}"></i>
                        </div>
                    </uib-accordion-heading>
                    <div ng-repeat="file in files"
                         class="row file_row_background@{{file.priority}}">

                        {{--uib-popover="@{{file.description}}"--}}
                        {{--popover-trigger="'mouseenter'"--}}
                        {{--popover-placement="bottom-left"--}}

                        <div class="col-md-12 carr-document ">
                            <a href=""><p class="col-md-9" style="padding:0; margin:0;" data-toggle="modal"
                                          data-target="#myModal" ng-click="ang_modal(file.id)">
                                    @{{file.title}}
                                </p></a>
                            <div class="carr-glyph glyph-desktop">
                                <a href="{{url('/')}}@{{ file.url}}"><span
                                            class="col-md-1 glyphicon glyphicon-download-alt"></span>
                                </a>
                            </div>
                        </div>

                    </div>
                </div>
            </uib-accordion>
        </div>
    </div>
</div>