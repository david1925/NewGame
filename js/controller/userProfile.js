(function(){
  angular.module("NewGameApp").controller("UserProfileController", ['$scope', '$http', '$translate', 'Domain', function($scope, $http, $translate, Domain) {

    //scope variables
    $scope.username="";
    $scope.friends="";
    $scope.images="";
    $scope.pageSize=5;
    $scope.currentPage= 1;
    if(sessionStorage.userLogged!=null){
      $scope.showMessagesForm=1;
    }else{
      $scope.showMessagesForm=0;
    }
    $scope.user = new User();
    var userObj = JSON.parse(sessionStorage.userLogged);
    $scope.user.construct(userObj.users_id_user,userObj.users_username,userObj.users_name,userObj.users_firstname,userObj.users_lastname,userObj.users_email,userObj.users_phone,userObj.users_image,userObj.users_summary,userObj.users_address,userObj.users_profile,userObj.users_status,userObj.users_language);
            //GET Walls messages
            $http.get(Domain + "api/public/users/messages/" + $scope.user.getId())
            .then(function (response) {$scope.messages = response.data;});
    		//GET Username
			$http.get(Domain + "api/public/users/username/" + $scope.user.getId())
    		.then(function (response) {$scope.username = response.data;});
    		//GET Friends list
    		$http.get(Domain + "api/public/users/friends/" + $scope.user.getId())
    		.then(function (response) {$scope.friends = response.data;});
    		//GET Games image
    		$http.get(Domain + "api/public/games/image/" + $scope.user.getId())
    		.then(function (response) {$scope.images = response.data;});
            //GET Users image
            $http.get(Domain + "api/public/users/image/" + $scope.user.getId())
            .then(function (response) {$scope.user_image = response.data;});
            //GET users language
            $http.get(Domain + "api/public/users/language/" +  $scope.user.getId())
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