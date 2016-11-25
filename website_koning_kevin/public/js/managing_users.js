

angular.module("myapp").controller("Managing_users", function ($scope, $http) {

    $scope.selected;
    $scope.testje;
    
    
    $scope.get_inactive_users = function() {
        //
        
        $.getJSON( "./api/get_inactive_users", function( data ) {
                
            //console.log(data);
            $scope.inactive_users = data;
            $scope.$apply();

        });
        
    }
    
    
    
    $scope.accept_user = function ($event, user_id, selected) {
        //console.log('user accepted ' + user_id);
        //console.log($event.currentTarget.parentElement.parentElement);
        
        console.log(selected);
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
                console.log(response.user_id);
            })
            .error(function(response) {
            console.log(response);
            }); 
        
        //after 0.5 second, remove user from inactive list
        setTimeout(function(){ 
            $scope.get_inactive_users(); 
        }, 500);
        
        //connect each selected role to volunteer
        
        angular.forEach(selected, function(value, key) {
          console.log(key);
            $http.post('./api/add_role_to_user', 
            {
            id: user_id,
            role_id: key
            })
            .success(function(response) {
                console.log(response);
            })
            .error(function(response) {
            console.log(response);
            }); 
        });
        
        /*var myElement = document.querySelector(".user");
        myElement.style.backgroundColor = "#D93600";*/
    }
    
    
    $scope.decline_user = function ($event, user_id) {
        
        var selected_user = $event.currentTarget;
        console.log(selected_user);
        //turn element red
        selected_user.style.backgroundColor = "#dda399";
        /*
        $http.post('./api/decline_user', 
            {
            id: user_id,
            active: 1
            })
            .success(function(response) {
                console.log(response.user_id);
            })
            .error(function(response) {
            console.log(response);
            }); 
        
        //after 0.5 second, remove user from inactive list
        setTimeout(function(){ 
            $scope.get_inactive_users(); 
        }, 500);
        */
    }

});