(function(){
  angular.module("NewGameApp").controller("LoginController", ['$http','$scope', '$translate', 'LoginService',  function($http, $scope, $translate) {
    
  this.login = function () {
      $scope.flag;
      $http.post('http://www.newgame.local/api/public/users/login/', {"username" : $scope.username, "password" : $scope.password}).then(function (response) {
      console.log(response.data);
          if (response.data.length>0) {
            console.log(response.data[0].users_username);
            console.log("Esta devolviendo true");
            $scope.flag = true;
            console.log("Este es el valor de la variable flag: " + $scope.flag);
            return true;
          }
          else{
            console.log("Esta devolviendo false");
            $scope.flag = false;
            console.log("Este es el valor de la variable flag: " + $scope.flag);
            return false;
          }
        });      
    };
  }]);
})();