angular.module("myapp").controller("Managing_file", function ($scope, $http) {

    $scope.title = "maneging file titel by angularjs";
    $scope.category = '0';
    $scope.tags = "";
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

    $.getJSON("/api/get_all_files", function (data) {

        console.log(data);
        $scope.inactive_users = data;
        // $scope.$apply();
    });
    console.log('ready');
});