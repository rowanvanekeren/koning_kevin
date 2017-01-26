<div class="col-md-6">
    <div class="panel panel-default box-shadow-default">
        <div class="panel-heading" ng-click="togglePanel('yourFilesDashboard')">
            <strong>Bestanden volgens jouw rol</strong> <div  class="toggleCollapse glyphicon @{{yourFilesDashb ? 'glyphicon-chevron-down' : 'glyphicon-chevron-right'}}"></div>
        </div>
        <div class="panel-body" ng-controller="Dashboard" ng-show="yourFilesDashb">
            <uib-accordion close-others="oneAtATime">
                <div uib-accordion-group class="panel-default" is-open="status.open"
                     ng-repeat="rol in rol_files">
                    <uib-accordion-heading>
                        @{{ rol.role.type }} <i class="pull-right glyphicon"
                                                ng-class="{'glyphicon-chevron-down': status.open, 'glyphicon-chevron-right': !status.open}"></i>
                    </uib-accordion-heading>
                    <div ng-repeat="file in rol.files"
                         class="row file_row_background@{{file.priority}}">
                        <p uib-popover="@{{file.description}}"
                           popover-trigger="'mouseenter'"
                           popover-placement="bottom-left" class="col-md-9" data-toggle="modal"
                           data-target="#myModal" ng-click="ang_modal(file.id)">
                            @{{file.title}}
                        </p>
                        <a href="{{url('/')}}@{{file.url}}"><span
                                    class="col-md-1 glyphicon glyphicon-download-alt"></span>
                        </a>
                        {{--        <a href="#"><span
                                            class="col-md-1 glyphicon glyphicon-pencil"></span></a>
                                <a href="#"><span ng-click="delete_document(file.id)"
                                                  class="col-md-1 glyphicon glyphicon-trash"></span></a>--}}
                    </div>
                </div>
            </uib-accordion>
            <!-- Modal -->
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

                                    <p>@{{ file_info.file.title }}</p>
                                </div>
                                <div class="col-md-6">
                                    <h5>Categorie�n</h5>

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
                            <h4 class="modal-title">Er ging iets mis, maak een printscreen van deze
                                pagina
                                en stuur door aan de moderator.</h4>
                        </div>
                    </div>
                </div>
            </div>
            {{--<div class="row" ng-repeat="rol in rol_files">--}}
            {{--<a class="btn btn-primary col-md-12 col-xs-12" type="button"--}}
            {{--data-toggle="collapse"--}}
            {{--data-target="#@{{ $index }}" aria-expanded="false"--}}
            {{--aria-controls="@{{ $index }}">--}}
            {{--@{{ rol.role.type }}--}}
            {{--</a>--}}
            {{--<div class="collapse col-md-12" id="@{{ $index }}">--}}
            {{--<div class="card card-block">--}}
            {{--<div ng-repeat="file in rol.files"--}}
            {{--class="row file_row_background@{{file.priority}}">--}}
            {{--<p uib-popover="@{{file.description}}"--}}
            {{--popover-trigger="'mouseenter'"--}}
            {{--popover-placement="bottom-left" class="col-md-9">--}}
            {{--@{{file.title}}--}}
            {{--</p>--}}
            {{--<a href="@{{ file.url}}"><span--}}
            {{--class="col-md-1 glyphicon glyphicon-download-alt"></span>--}}
            {{--</a>--}}
            {{--<a href="#"><span--}}
            {{--class="col-md-1 glyphicon glyphicon-pencil"></span></a>--}}
            {{--<a href="#"><span ng-click="delete_document(file.id)"--}}
            {{--class="col-md-1 glyphicon glyphicon-trash"></span></a>--}}
            {{--</div>--}}
            {{--<div class="col-md-10"><p>@{{file.description}}</p></div>--}}
            {{--</div>--}}
            {{--</div>--}}
            {{--</div>--}}
        </div>
    </div>
</div>