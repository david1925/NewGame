(function(){
  angular.module("NewGameApp").controller("UserProfileController", ['$scope', '$http', '$translate', function($scope, $http, $translate) {

    //scope variables
    $scope.username="";
    $scope.friends="";
    $scope.images="";
    $scope.pageSize=5;
            //GET Walls messages
            $http.get("http://www.newgame.local/api/public/users/messages/1")
            .then(function (response) {$scope.messages = response.data;});
    		//GET Username
			$http.get("http://www.newgame.local/api/public/users/username/1")
    		.then(function (response) {$scope.username = response.data;});
    		//GET Friends list
    		$http.get("http://www.newgame.local/api/public/users/friends/alumne")
    		.then(function (response) {$scope.friends = response.data;});
    		//GET Games image
    		$http.get("http://www.newgame.local/api/public/games/image/1")
    		.then(function (response) {$scope.images = response.data;});
            //GET Users image
            $http.get("http://www.newgame.local/api/public/users/image/1")
            .then(function (response) {$scope.user_image = response.data;});
            //GET users language
            $http.get("http://www.newgame.local/api/public/users/language/1")
            .then(function (response) {$scope.language = response.data;
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