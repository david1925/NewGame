(function(){
  angular.module("NewGameApp").controller("forumController", ['$scope', '$http', '$translate', 'Domain', "$location", function($scope, $http, $translate, Domain, $location) {

    //scope variables
    $scope.forums="";
    $scope.pageSize=5;
    $scope.currentPage= 1;
    $scope.gameForum="www.newgame.local/view/forumThread.html";
    //GET all forums names
    $http.get(Domain + "api/public/forums").then(function (response) {$scope.forums = response.data;});

    $scope.changeLanguage = function (translate) {
        $translate.use(translate);
        localStorage.setItem("language",translate);
    };
    
   $scope.irPagina1 = function () {
      $location.path("/view/forumThread.html");
   };

  }]);
})();