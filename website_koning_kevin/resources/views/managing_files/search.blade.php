<div class="col-md-12 ">
    <div class="panel panel-default">
        <div class="panel-heading">
            Zoeken
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-md-5">
                    <div class="form-group">
                        {{Form::text('title', old('title'),array('class'=>'form-control', 'placeholder'=>'Zoek over alle bestanden', 'ng-model'=>"query"))}}
                    </div>
                </div>
                <div class="col-md-3">
                    <select name="singleSelect" id="singleSelect" ng-model="search_category" class="form-control">
                        <option value="">---Selecteer je category---</option>
                        @foreach($categories as $category)
                            <option value="{{$category}}">{{$category}}</option> <!-- interpolation -->
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <select name="singleSelect" id="singleSelect" ng-model="search_role" class="form-control">
                        <option value="">---Selecteer je rol---</option>
                        @foreach($roles as $role)
                            <option value="{{$role}}">{{$role}}</option> <!-- interpolation -->
                        @endforeach
                    </select>
                </div>
                <button type="button" class="btn btn-default col-md-1"
                        ng-click="search_for_file(query,search_category,search_role)">
                    Zoeken
                </button>
            </div>
            <div ng-repeat="file in search_files ">
                <a href="{{url('/')}}@{{ file.url}}">
                    <div class="row carr-document ">
                        <p class="col-md-5" ng-click="ang_modal(file.id)">@{{file.title}}</p>
                        <p class="col-md-3">@{{ file.categories[0].type }} </p>
                        <p class="col-md-3">@{{ file.roles[0].type }} </p>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>