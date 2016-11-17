angular.module("myapp").controller("Managing_users", function ($scope, $http) {

    $scope.title = "Sarah Test!!!";
    
    
    
    $scope.get_inactive_users = function() {
        //
        
        $.getJSON( "./api/get_inactive_users", function( data ) {
                
            //console.log(data);
            $scope.inactive_users = data;
            $scope.$apply();

        });
        
    }
    
    
    
    $scope.accept_user = function ($event, user_id) {
        //console.log('user accepted ' + user_id);
        //console.log($event.currentTarget.parentElement.parentElement);
        
        
        //get selected user
        var selected_user = $event.currentTarget.parentElement.parentElement;
        //turn element green
        selected_user.style.backgroundColor = "#9d9";
        
        $http.post('./api/accept_user', 
            {
            id: user_id,
            active: 1
            })
            .success(function(response) {
                console.log("gelukt");
            })
            .error(function(response) {
            console.log(response);
            }); 
        
        //after 0.5 second, remove user from inactive list
        setTimeout(function(){ 
            $scope.get_inactive_users(); 
        }, 500);
        
        /*var myElement = document.querySelector(".user");
        myElement.style.backgroundColor = "#D93600";*/
    }

});