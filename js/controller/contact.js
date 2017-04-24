(function(){
  angular.module("NewGameApp").controller("ContactController", ['$scope', '$http', '$translate', 'Domain', function($scope, $http, $translate, Domain) {

    //scope variables
    $scope.userData="";
    		//GET userData
			$http.get(Domain + "api/public/contact/1")
    		.then(function (response) {$scope.userData = response.data;
                console.log($scope.userData);});    	
            
            $scope.changeLanguage = function (translate) {
                $translate.use(translate);
                localStorage.setItem("language",translate);
            };


            $http.get(Domain + "api/public/users/language/1")
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