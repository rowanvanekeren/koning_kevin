angular.module("myapp").controller("Managing_file", function ($scope, $http) {

    $scope.title = "maneging file titel by angularjs";
    $scope.category = '0';
    $scope.tags ="";
    $scope.CategoryChange = function () {
        console.log('changed');
    }
    $scope.tags_enter = function (input_value) {


        if(input_value.slice(-1) !== ','){
            $scope.tags = input_value+", ";
        }

    }

});