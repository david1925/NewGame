(function(){
  angular.module("NewGameApp").controller("LoginController", ['$http','$scope', '$translate', 'Domain', 'LoginFactory', function($http, $scope, $translate, Domain, LoginFactory) {
    
  this.login = function () {
      $scope.flag;
      $http.post(Domain + 'api/public/users/login/', {"username" : $scope.username, "password" : $scope.password}).then(function (response) {
      console.log(response.data);
          if (response.data.length>0) {
            console.log(response.data[0].users_username);
            console.log("Esta devolviendo true");
            LoginFactory[0] = response.data[0].users_address;
            LoginFactory[1] = response.data[0].users_email;
            LoginFactory[2] = response.data[0].users_firstname;
            LoginFactory[3] = response.data[0].users_id_user;
            LoginFactory[4] = response.data[0].users_image;
            LoginFactory[5] = response.data[0].users_language;
            LoginFactory[6] = response.data[0].users_lastname;
            LoginFactory[7] = response.data[0].users_name;
            LoginFactory[8] = response.data[0].users_phone;
            LoginFactory[9] = response.data[0].users_public_profile;
            LoginFactory[10] = response.data[0].users_status;
            LoginFactory[11] = response.data[0].users_summary;
            LoginFactory[12] = response.data[0].users_username;

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