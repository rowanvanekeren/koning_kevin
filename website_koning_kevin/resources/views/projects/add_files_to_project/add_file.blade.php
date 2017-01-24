<div class="col-md-12">
    {{--@include('managing_files.add_unic_file_to_project')--}}
    <div ng-controller="Add_file_to_project">
        <div ng-if="selected_file.length > 0">
            {{--toon aantal geselecteerde bestanden--}}
            <div>@{{ selected_file.length }} bestanden geselecteerd</div>
            {{--toon error massage als er geen bestanden geselecteerd zijn--}}
            @if ($errors->has('selected_file'))
                <span class="help-block">
                                        <strong>{{ $errors->first('selected_file') }}</strong>
                    </span>
            @endif
            {{--<input type="text" name="selected_file[]" ng-moedel="selected">--}}
        </div>
        <!-- Trigger the modal with a button -->
        <button type="button" class="btn btn-primary" data-toggle="modal"
                data-target="#myModal"
                ng-click="add_file()">Kies bestanden
        </button>
        <!--Modal show all files-->
        <div class="modal fade" id="myModal" role="dialog">
            <div class="modal-dialog modal-lg">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close"
                                data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Kies bestanden</h4>
                    </div>
                    <div class="modal-body">
                        <div class="row" ng-repeat="file in files">
                            <div class="col-md-12">
                                <input type="checkbox" name="selected_file[]"
                                       ng-click="select_file(file.id)"
                                       ng-checked="selected_file.indexOf(file.id)>-1"
                                       ng-value="file.id">@{{ file.title }}
                                <span class="pull-right">@{{ file.categories[0].type }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-dismiss="modal">
                            Selecteer
                        </button>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>