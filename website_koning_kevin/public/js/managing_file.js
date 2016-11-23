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
    $scope.search_files;
    get_all_files();
    get_all_files_search();

    $scope.delete_document = function (document_id) {
        $http.post('/api/delete_file',
            {
                id: document_id,
            })
            .success(function (data) {
                console.log(data);
                if (data.success) {
                    get_all_files();
                    get_all_files_search();
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


    function get_all_files_search() {
        $.getJSON("/api/get_all_files_search", function (data) {
            $scope.search_files = data;
            $scope.$apply();
            console.log($scope.search_files);
        });
    }


});
