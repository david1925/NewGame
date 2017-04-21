(function(){
  angular.module("NewGameApp").controller("IndexController", ['$scope', '$http', '$translate', function($scope, $http, $translate) {
     
  	$scope.games = "";
  	$scope.gamesPublicationDate="";

  		$scope.changeLanguage = function (translate) {
        $translate.use(translate);
        localStorage.setItem("language",translate);
      };

    		//GET games image, name, description
            $http.get("http://www.newgame.local/api/public/games/featured")
            .then(function (response) {$scope.games = response.data;});
            //GET games image, name, description
            $http.get("http://www.newgame.local/api/public/games/publicationDate")
            .then(function (response) {$scope.gamesPublicationDate = response.data;});


  }]);
})();