(function(){
  angular.module("NewGameApp").controller("contactController", ['$scope', '$http', '$translate', function($scope, $http, $translate) {

    //scope variables
    $scope.username="";
    		//GET Username
			$http.get("http://www.newgame.local/api/public/contact/1")
    		.then(function (response) {$scope.username = response.data;
                console.log($scope.username);});    	
            //GET Games image
            $http.get("http://www.newgame.local/api/public/users/language/1")
            .then(function (response) {$scope.language = response.data;
                console.log($scope.language[0].users_language);
                switch($scope.language[0].users_language){
                    case "en": $scope.language = "English";
                            break;
                    case "es": $scope.language = "Español";
                            break;
                    case "ca": $scope.language = "Català";
                            break;
                }
            });
  }]);
})();