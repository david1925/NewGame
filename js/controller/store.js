(function(){
  angular.module("NewGameApp").controller("storeController", ['$scope', '$http', '$translate', function($scope, $http, $translate) {

    //scope variables
    //$scope.games="";
    $scope.pageSize=10;
            //GET games id,image,name
            $http.get("http://www.newgame.local/api/public/games")
            .then(function (response) {$scope.games = response.data;});
  }]);
})();