(function(){
  angular.module("NewGameApp").controller("forumController", ['$scope', '$http', '$translate', 'Domain', "$location", function($scope, $http, $translate, Domain, $location) {

    //scope variables
    $scope.forums="";
    $scope.pageSize=5;
    $scope.currentPage= 1;
    $scope.topicsArray = [];
    $scope.gameForum="www.newgame.local/view/forumThread.html";
    //GET all forums names
    $http.get(Domain + "api/public/forums").then(function (response) {$scope.forums = response.data;

      for(var i = 0; i<$scope.forums.length; i++){
        console.log("Este es el id del juego: " + $scope.forums[i].games_id_game);
        console.log(Domain + "api/public/forums/topics/" + $scope.forums[i].games_id_game);
        $http.get(Domain + "api/public/forums/topics/" + $scope.forums[i].games_id_game)
        .then(function (response) {
          $scope.topicsArray.push(response.data.games_id_game)});
          console.log($scope.forums);
      }
      console.log($scope.topicsArray);
      console.log("Valor de la posicion del array: ");
      console.log($scope.topicsArray[0].Topics);


    });

    $scope.changeLanguage = function (translate) {
        $translate.use(translate);
        localStorage.setItem("language",translate);
    };
    
   $scope.irPagina1 = function () {
      $location.path("/view/forumThread.html");
   };

  }]);
})();