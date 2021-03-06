var myApp = angular.module("myapp", ['ui.bootstrap']);

myApp.controller("PrimeController", function ($scope, $http) {

    $scope.home_animation = function () {
        $('')
    };
    //Sarah deze module is voor Manging_file.js is voor mij
    $scope.title = "Angular gegenereerde titel";


});


myApp.controller("addProjectDateTimeStart", function ($scope, $http) {
    $scope.today = function () {
        $scope.dt = new Date();
    };
    $scope.today();

    $scope.clear = function () {
        $scope.dt = null;
    };
    if($('.startDate').val() != ''){
        $scope.dt = new Date(Date.parse($('.startDate').val()));
    }
    $scope.inlineOptions = {
        customClass: getDayClass,
        minDate: new Date(),
        showWeeks: true
    };

    $scope.dateOptions = {
        dateDisabled: ""/*disabled*/,
        formatYear: 'yy',
        maxDate: new Date(2020, 5, 22),
        minDate: new Date(),
        startingDay: 1
    };

    // Disable weekend selection
    function disabled(data) {
        var date = data.date,
            mode = data.mode;
        return mode === 'day' && (date.getDay() === 0 || date.getDay() === 6);
    }

    $scope.toggleMin = function () {
        $scope.inlineOptions.minDate = $scope.inlineOptions.minDate ? null : new Date();
        $scope.dateOptions.minDate = $scope.inlineOptions.minDate;
    };

    $scope.toggleMin();

    $scope.open1 = function () {
        $scope.popup1.opened = true;
    };

    $scope.open2 = function () {
        $scope.popup2.opened = true;
    };

    $scope.setDate = function (year, month, day) {
        /*    $scope.dt = new Date(year, month, day);*/

    };

    $scope.formats = ['dd-MMMM-yyyy', 'yyyy/MM/dd', 'dd.MM.yyyy', 'shortDate', 'MM/dd/yyyy', 'yyyy-MM-dd'];
    $scope.format = $scope.formats[5];
    $scope.altInputFormats = ['M!/d!/yyyy'];

    $scope.popup1 = {
        opened: false
    };

    $scope.popup2 = {
        opened: false
    };

    var tomorrow = new Date();
    tomorrow.setDate(tomorrow.getDate() + 1);
    var afterTomorrow = new Date();
    afterTomorrow.setDate(tomorrow.getDate() + 1);
    $scope.events = [
        {
            date: tomorrow,
            status: 'full'
        },
        {
            date: afterTomorrow,
            status: 'partially'
        }
    ];

    function getDayClass(data) {
        var date = data.date,
            mode = data.mode;
        if (mode === 'day') {
            var dayToCheck = new Date(date).setHours(0, 0, 0, 0);

            for (var i = 0; i < $scope.events.length; i++) {
                var currentDay = new Date($scope.events[i].date).setHours(0, 0, 0, 0);

                if (dayToCheck === currentDay) {
                    return $scope.events[i].status;
                }
            }
        }

        return '';
    }


    /*$scope.mytime = new Date();*/
    $scope.startTime = "";
    $scope.hstep = 1;
    $scope.mstep = 1;

    $scope.options = {
        hstep: [1, 2, 3],
        mstep: [1, 5, 10, 15, 25, 30]
    };

    $scope.ismeridian = false;
    $scope.toggleMode = function () {
        $scope.ismeridian = !$scope.ismeridian;
    };


    $scope.update = function () {
        var d = new Date();
        d.setHours(14);
        d.setMinutes(0);
        $scope.mytime = d;
    };
    var oldStartDateRaw = $('.oldStartTimeBeginning').val();

    var oldStartDate = oldStartDateRaw.split(':');


    $scope.startTime = returnDateFormat(oldStartDate);


    $scope.changed = function (mytimesec) {
        if (typeof mytimesec == 'undefined') {
            mytimesec = new Date();
        }


        var hours = (mytimesec.getHours() < 10 ? '0' : '') + mytimesec.getHours();
        var minutes = (mytimesec.getMinutes() < 10 ? '0' : '') + mytimesec.getMinutes();
        var seconds = "00";

        var combined = hours + ":" + minutes + ":" + seconds;

        $scope.startTime = combined;

        console.log(combined);
        /*   $log.log('Time changed to: ' + $scope.mytime);*/
    };

    $scope.clear = function () {
        $scope.mytime = null;
    };

});

myApp.controller("addProjectDateTimeEnd", function ($scope, $http) {
    var oldEndDateRaw = $('.oldEndTimeBeginning').val();
    var oldEndDate = oldEndDateRaw.split(':');


    $scope.today = function () {
        $scope.dt = new Date();
    };
    $scope.today();

    $scope.clear = function () {
        $scope.dt = null;
    };
    if($('.endDate').val() != ''){
        $scope.dt = new Date(Date.parse($('.endDate').val()));
    }


    $scope.inlineOptions = {
        customClass: getDayClass,
        minDate: new Date(),
        showWeeks: true
    };

    $scope.dateOptions = {
        dateDisabled: ""/*disabled*/,
        formatYear: 'yy',
        maxDate: new Date(2020, 5, 22),
        minDate: new Date(),
        startingDay: 1
    };

    // Disable weekend selection
    function disabled(data) {
        var date = data.date,
            mode = data.mode;
        return mode === 'day' && (date.getDay() === 0 || date.getDay() === 6);
    }

    $scope.toggleMin = function () {
        $scope.inlineOptions.minDate = $scope.inlineOptions.minDate ? null : new Date();
        $scope.dateOptions.minDate = $scope.inlineOptions.minDate;
    };

    $scope.toggleMin();

    $scope.open1 = function () {
        $scope.popup1.opened = true;
    };

    $scope.open2 = function () {
        $scope.popup2.opened = true;
    };

    $scope.setDate = function (year, month, day) {
        /*    $scope.dt = new Date(year, month, day);*/

    };

    $scope.formats = ['dd-MMMM-yyyy', 'yyyy/MM/dd', 'dd.MM.yyyy', 'shortDate', 'MM/dd/yyyy', 'yyyy-MM-dd'];
    $scope.format = $scope.formats[5];
    $scope.altInputFormats = ['M!/d!/yyyy'];

    $scope.popup1 = {
        opened: false
    };

    $scope.popup2 = {
        opened: false
    };

    var tomorrow = new Date();
    tomorrow.setDate(tomorrow.getDate() + 1);
    var afterTomorrow = new Date();
    afterTomorrow.setDate(tomorrow.getDate() + 1);
    $scope.events = [
        {
            date: tomorrow,
            status: 'full'
        },
        {
            date: afterTomorrow,
            status: 'partially'
        }
    ];

    function getDayClass(data) {
        var date = data.date,
            mode = data.mode;
        if (mode === 'day') {
            var dayToCheck = new Date(date).setHours(0, 0, 0, 0);

            for (var i = 0; i < $scope.events.length; i++) {
                var currentDay = new Date($scope.events[i].date).setHours(0, 0, 0, 0);

                if (dayToCheck === currentDay) {
                    return $scope.events[i].status;
                }
            }
        }

        return '';
    }


    /*$scope.mytime = new Date();*/
    $scope.endTime = "";
    $scope.hstep = 1;
    $scope.mstep = 1;
    $scope.endTime = returnDateFormat(oldEndDate);
    $scope.options = {
        hstep: [1, 2, 3],
        mstep: [1, 5, 10, 15, 25, 30]
    };

    $scope.ismeridian = false;
    $scope.toggleMode = function () {
        $scope.ismeridian = !$scope.ismeridian;
    };

    $scope.update = function () {
        var d = new Date();
        d.setHours(14);
        d.setMinutes(0);
        $scope.mytime = d;

    };

    $scope.changed = function (mytimesec) {
        if (typeof mytimesec == 'undefined') {
            mytimesec = new Date();
        }
        var hours = (mytimesec.getHours() < 10 ? '0' : '') + mytimesec.getHours();
        var minutes = (mytimesec.getMinutes() < 10 ? '0' : '') + mytimesec.getMinutes();
        var seconds = "00";

        var combined = hours + ":" + minutes + ":" + seconds;

        $scope.endTime = combined;

        /*console.log( "end time = " + combined);*/
        /*   $log.log('Time changed to: ' + $scope.mytime);*/
        /*      var str = $scope.mytime;
         str.getMinutes();
         console.log('Time changed to: ' + str);*/
    };

    $scope.clear = function () {
        $scope.mytime = null;
    };


});

myApp.controller("toggleController", function ($scope, $http) {
    $scope.usrdashb = true;
    $scope.yourFilesDashb = true;
    $scope.projOvervDashb = true;
    $scope.myProjDashb = true;
    $scope.togglePanel = function (element) {
        switch (element) {
            case 'usersDashboard':
                $scope.usrdashb = !$scope.usrdashb;
                break;
            case 'yourFilesDashboard':
                $scope.yourFilesDashb = !$scope.yourFilesDashb;
                break;
            case 'projectOverviewDashboard':
                $scope.projOvervDashb = !$scope.projOvervDashb;
                break;
            case 'myProjectsDashboard' :
                $scope.myProjDashb = !$scope.myProjDashb;
                break;
        }
    }

});

function returnDateFormat(arrayDate) {
    if (arrayDate.length > 1) {
        var dateFormat = new Date();
        dateFormat.setHours(arrayDate[0]);
        dateFormat.setMinutes(arrayDate[1]);
        dateFormat.setSeconds(0);
        return dateFormat;
    } else {
        return new Date();
    }
}