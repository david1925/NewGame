(function(){
  angular.module("NewGameApp").controller("IndexController", ['$scope', '$http', '$translate', 'Domain', function($scope, $http, $translate, Domain) {
     
  	$scope.games = "";
  	$scope.gamesPublicationDate="";

  		$scope.changeLanguage = function (translate) {
        $translate.use(translate);
        localStorage.setItem("language",translate);
      };

    		//GET games image, name, description
            $http.get(Domain + "api/public/games/featured")
            .then(function (response) {$scope.games = response.data;});
            //GET games image, name, description
            $http.get(Domain + "api/public/games/publicationDate")
            .then(function (response) {$scope.gamesPublicationDate = response.data;});


  }]);
})();