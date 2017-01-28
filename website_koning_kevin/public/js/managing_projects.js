
angular.module("myapp").controller("Managing_projects", function ($scope, $http) {

    $('#project_img.new').hide();
    
    $('#project_image').on('change', function(e){
        
        if (this.files && this.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $(".img_placeholder").hide();
                $('#project_img').attr('src', e.target.result);
                $('#project_img').show();
            }

            reader.readAsDataURL(this.files[0]);
        }
        
    });
    
    
    
    //delete project
    $scope.pass_info_to_delete_project = function ($event, project_id, project_name) {
        $scope.project_id = project_id;
        $scope.project_name = project_name;
    }
    
    $scope.delete_project = function ($event, project_id) {
        //
        console.log(project_id);
        $http.post('./delete_project',
            {
                id: project_id
            })
            .success(function(response) {
                console.log(response.project_id);
            })
            .error(function(response) {
                console.log(response);
            });
        location.reload();
    }
    
    

});