(function(){
  angular.module("NewGameApp").controller("LoginController", ['$http','$scope', '$translate', function($http, $scope, $translate) {
    
    var flag = false;

    this.login = function () {
  $http.post('http://www.newgame.local/api/public/users/login/').then(function (response) {
      console.log(response.data);
          if (response.data.length>0) {
            console.log(response.data[0].users_username);
            console.log("Esta devolviendo true");
            flag = true;
            console.log("Este es el valor de la variable flag: " + flag);
            return true;
          }
          else{
            console.log("Esta devolviendo false");
            flag = false;
            console.log("Este es el valor de la variable flag: " + flag);
            return false;
          }
          alert(flag);
        });      
    };
  }]);
})();