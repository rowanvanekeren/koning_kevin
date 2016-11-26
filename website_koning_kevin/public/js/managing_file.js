angular.module("myapp").controller("Managing_file", function ($scope, $http) {

    $scope.title = "maneging file titel by angularjs";
    $scope.category = '0';
    $scope.tags = "";

    $scope.init = function (tag_string) {
        $scope.tags = tag_string;
        console.log("geinitialiseerd", tag_string);
    }
    $scope.CategoryChange = function () {
        console.log('changed');
    }
    $scope.tags_enter = function (input_value) {
        if (input_value.slice(-1) !== ',') {
            $scope.tags = input_value + ", ";
        }
    }
});

angular.module("myapp").controller("Show_file", function ($scope, $http) {
    $scope.files;
    $scope.message;
    $scope.file;
    $scope.search_files;
    $scope.file_info;
    $scope.categories;
    $scope.open = false;
    $scope.oneAtATime = true;
    get_categories();
    get_all_files_search();

    $scope.delete_document = function (document_id) {
        $http.post('./api/delete_file',
            {
                id: document_id,
            })
            .success(function (data) {
                console.log(data);
                if (data.success) {
                    get_all_files();
                    get_all_files_search();
                }
                $scope.message = data;
            })
            .error(function (response) {
                var error = [];
                error["error"] = "Er ging iets fout, probeer later nog eens";
                $scope.message = error;
            });
    }

    function get_all_files() {
        $.getJSON("./api/get_all_files", function (data) {
            console.log('get_all_files',data);
            $scope.files = data;
            $scope.$apply();
        });
    }
    function get_categories() {
        $.getJSON("./api/get_categories", function (data) {
            console.log('get_categories',data);

            $scope.categories = data;
            $scope.$apply();
        });
    }


    function get_all_files_search() {
        $.getJSON("./api/get_all_files_search", function (data) {
            $scope.search_files = data;
            console.log('get_all_files_search',data);
            $scope.$apply();
        });
    }

    function get_all_files_for_category($id) {
        $.getJSON("./api/get_all_files_for_category/"+$id, function (data) {
            $scope.files = data;
            console.log('get_all_files_for_category',data);
            $scope.$apply();
        });
    }

    $scope.ang_modal = function ($id) {
        console.log($id);
    
        $.getJSON("./api/file_info/"+$id, function (data) {
            $scope.file_info = data;
            $scope.$apply();
            console.log($scope.file_info);
        });

    }
    $scope.get_file_for_category = function ($id) {
        $scope.files="";
        get_all_files_for_category($id);
    }




});


angular.module("myapp").controller("Dashboard", function ($scope, $http) {
    $scope.open = false;
    $scope.oneAtATime = true;
    $scope.rol_files;
    $scope.file_info;
    $.getJSON("./api/get_files_belongs_to_user", function (data) {
        $scope.rol_files = data;
        $scope.$apply();
        console.log($scope.rol_files);
    });


    $scope.ang_modal = function ($id) {
        console.log($id);

        $.getJSON("./api/file_info/"+$id, function (data) {
            $scope.file_info = data;
            $scope.$apply();
            console.log($scope.file_info);
        });

    }


});