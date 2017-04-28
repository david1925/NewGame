(function(){
  angular.module("NewGameApp").controller("shopController", ['$scope', '$http', '$translate', 'Domain', function($scope, $http, $translate, Domain) {

    //scope variables
    //$scope.games="";
    $scope.pageSize=5;
    $scope.currentPage= 1;


    $scope.changeLanguage = function (translate) {
        $translate.use(translate);
        localStorage.setItem("language",translate);
      };
            //GET games id,image,name
            $http.get(Domain + "api/public/games")
            .then(function (response) {$scope.games = response.data;});
          console.log("Este es el valor de la variable de sesion" + sessionStorage.getItem("userLogged"));
            console.log("solo quiero coger el nombre usuario y la dirección de correo" + JSON.parse(sessionStorage.getItem("userLogged")));
  }]);
})();