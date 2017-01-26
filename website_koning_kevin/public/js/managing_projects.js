
angular.module("myapp").controller("Managing_projects", function ($scope, $http) {

    console.log('djfnjsdk');
    //upload image for preview
    $scope.add_image = function() {
        console.log("blabal");
        //get image
        var image =  new FormData($('#project_image')[0]);
        console.log(image);
    }
    
    $('#project_image').on('change', function(e){
        console.log("djnfjksdnj");
        var image =  new FormData($('#project_image')[0].files[0]);
        var myFile = $('#project_image').prop('files');
        console.log(image);
        console.log(myFile);
    });
    
    
    /* edit project */
    $scope.add_remove_user_to_project = function ($event, $id, $project_id) {
        $clicked = $($event.currentTarget);
        $class = $clicked.attr('class');
        console.log($id);
        
        //check which role was selected
        console.log($(".role" + $id + " select option:selected").val());
        $role_id = $(".role" + $id + " select option:selected").val();
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
                }
            })
            .error(function(response) {
            console.log("error");
            });
        
        
    }
    
    

});