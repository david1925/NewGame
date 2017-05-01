(function(){
  angular.module("NewGameApp").controller("storeController", ['$scope', '$http', '$translate', 'Domain', function($scope, $http, $translate, Domain) {

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
  }]);
})();