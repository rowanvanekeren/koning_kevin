angular.module("myapp").controller("Managing_file", function ($scope, $http) {

    $scope.title = "maneging file titel by angularjs";
    $scope.category = '0';
    $scope.tags = "";

    $scope.init =function (tag_string) {
        $scope.tags= tag_string;
        console.log("geinitialiseerd",tag_string);
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
    get_all_files();
    $scope.show_more_info = function show_more_info($id) {

        $.getJSON("/api/file_info/"+$id, function (data) {
            $scope.file = data;
            console.log($scope.file );
            $scope.$apply();
        });
    }
    $scope.delete_document = function (document_id) {
        $http.post('/api/delete_file',
            {
                id: document_id,
            })
            .success(function (data) {
                console.log(data);
                if (data.success) {
                    get_all_files();
                }
                $scope.message =data;
            })
            .error(function (response) {
                var error = [];
                error["error"]="Er ging iets fout, probeer later nog eens";
                $scope.message =error;
            });
    }

    function get_all_files() {
        $.getJSON("/api/get_all_files", function (data) {
            $scope.files = data;
            $scope.$apply();
        });
    }

});