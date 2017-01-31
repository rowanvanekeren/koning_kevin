

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
    
    $scope.pass_modal_info = function(user_id) {
        console.log("user id " + user_id);
        $scope.selected_user = user_id;
    }
    
    $scope.accept_user = function ($event, user_id, selected) {
        console.log('user accepted ' + user_id);
        //console.log($event.currentTarget.parentElement.parentElement);
        
        //var roles = Object.keys(selected);
        
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

        /*
        //after 0.5 second, remove user from inactive list
        setTimeout(function(){ 
            $scope.get_inactive_users(); 
        }, 500);
        */

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
        
        $scope.get_inactive_users();
        
        /*var myElement = document.querySelector(".user");
        myElement.style.backgroundColor = "#D93600";*/
    }

    $scope.pass_info_to_decline_user = function ($event, user_id, user_first_name, user_last_name) {
        //console.log(user_first_name);
        $scope.user_id = user_id;
        $scope.user_name = user_first_name + " " + user_last_name;
    }
    
    $scope.decline_user = function ($event, user_id) {

        $http.post('./api/decline_user', 
            {
            id: user_id,
            active: 1
            })
            .success(function(response) {
                //console.log(response.user_id);
                $scope.get_inactive_users();
            })
            .error(function(response) {
            console.log(response);
            }); 


    }
    
    
    $scope.pass_info_to_delete = function($event, user_id) {
        $scope.volunteer_name = $($event.currentTarget).parent().parent().find('td:nth-child(2) a').text() + " " + $($event.currentTarget).parent().parent().find('td:nth-child(1) a').text();
        $scope.selected_user = user_id;
    }
    
    $scope.delete_volunteer = function($event, user_id) {
        console.log(user_id);
        
        $http.post('./api/delete_user', 
            {
            id: user_id
            })
            .success(function(response) {
                console.log(response.user_id);
            })
            .error(function(response) {
            console.log(response);
            }); 
        
    }
    
    
    /* edit project */
    
    $scope.show_accept_message = false;
    
    $scope.add_remove_user_to_project = function ($event, $id, $project_id) {
        $clicked = $($event.currentTarget);
        $class = $clicked.attr('class');
        //check which role was selected
        console.log($(".role" + $id + " select option:selected").val());
        $role_id = $(".role" + $id + " select option:selected").val();
        //$scope.show_accept_message = true;

        //accept volunteer with the selected role (send project_id, role_id and user_id to api)
        $http.post('../api/accept_user_for_project', 
            {
            project_id: $project_id,
            user_id: $id,
            role_id: $role_id
            })
            .success(function(response) {
                console.log(response.user_id);
                console.log(response.project_id);
                console.log(response.role_id);
                if(response.status == "success") {
                    console.log("succesvol geaccepteerd");
                    $scope.show_accept_message = true;
                }
            })
            .error(function(response) {
            console.log("error");
            });
    }

    $scope.manually_add_remove_user_to_project = function ($event, $id, $project_id) {
        $clicked = $($event.currentTarget);
        $class = $clicked.attr('class');
        //check which role was selected
        console.log($(".role" + $id + " select option:selected").val());
        console.log('user is ' + $id + " en project is " + $project_id);
        $role_id = $(".role" + $id + " select option:selected").val();
        //accept volunteer with the selected role (send project_id, role_id and user_id to api)
        $http.post('../api/add_user_to_project',
            {
                project_id: $project_id,
                user_id: $id,
                role_id: $role_id
            })
            .success(function(response) {
                console.log(response.user_id);
                console.log(response.project_id);
                console.log(response.role_id);
                if(response.status == "success") {
                    console.log("succesvol geaccepteerd");
                    location.reload();
                }
            })
            .error(function(response) {
                console.log("error");
            });
    }
    
    
    

    $scope.show_search = false;
    $(".volunteers").hide();
    $scope.show_volunteers_list = function() {
        //get all volunteers
        //no volunteers will be shown from the beginning (because this list will be very long), so a search is required
        /*
        $.getJSON( "../api/get_all_volunteers", function( data ) {
            console.log(data);
            $scope.volunteers = data.volunteers;
            $scope.$apply();
            //console.log($scope.volunteers[0].roles[0].type);
        });
        */

        if($scope.show_search) {
            $(".volunteers").hide();
        }
        else {
            $(".volunteers").show();
        }
        $scope.show_search = !$scope.show_search;
    }

    $scope.search_volunteers = function () {
        var searchterm = $('#search_volunteers').val();

        if(searchterm.length > 1) {
            //console.log('perform post request');

            $http.post('../api/search_volunteers',
                {
                    searchword: searchterm
                })
                .success(function(response) {
                    //console.log(response);
                    $scope.volunteers = response.volunteers;
                    //$scope.$apply();
                })
                .error(function(response) {
                    console.log("error");
                });

        }

    }
    
    

});