(function(){
  angular.module("NewGameApp").controller("LoginController", ['$http','$scope', '$translate', 'Domain', '$window', function($http, $scope, $translate, Domain, $window) {
    
  this.login = function () {
      $scope.flag;
      $http.post(Domain + 'api/public/users/login/', {"username" : $scope.username, "password" : $scope.password}).then(function (response) {
          if (response.data.length>0) {
            $scope.user = new User();
            //$scope.user.construct(response.data[0][3],response.data[0][12],response.data[0][7],response.data[0][2],response.data[0][6],response.data[0][1],response.data[0][8],response.data[0][4],response.data[0][11],response.data[0][0],response.data[0][9],response.data[0][10],response.data[0][5]);
            //$scope.user.construct("asdf","asdf","asdf","asdf","asdf","asdf","asdf","asdf","asdf","asdf","asdf","asdf","asdf");
            //console.log("Objeto construido" + userObj);
            console.log(response.data[0]);
            console.log("Antes de guardarse en el sessionStorage el array vale esto: " + response.data[0]);
            console.log("Esto es lo que se guardará dentro del sessionStorage" + JSON.stringify(response.data[0]));
            sessionStorage.setItem("userLogged", JSON.stringify(response.data[0]));
            console.log("Una vez guardado en el sessionStorage se reocge el valor, es igual a: " + sessionStorage.getItem("userLogged"));
            console.log("Este es el valor de la variable sessionStorage cuando se lo pone el json.parse del obejto: " + JSON.parse(sessionStorage.userLogged));
            var userObj = JSON.parse(sessionStorage.userLogged);
            $scope.user.construct(userObj.users_id_user,userObj.users_username,userObj.users_name,userObj.users_firstname,userObj.users_lastname,userObj.users_email,userObj.users_phone,userObj.users_image,userObj.users_summary,userObj.users_address,userObj.users_profile,userObj.users_status,userObj.users_language);
            console.log("Imprimo el objeto de usuario: " + $scope.user);
            console.log("Solo quiero cojer el nombre de usuario: " + $scope.user.getName());
            $scope.flag = true;
            $window.open('../index.html', "_self");
            return $scope.flag;

          }
          else{
            console.log("Esta devolviendo false");
            $scope.flag = false;
            console.log("Este es el valor de la variable flag: " + $scope.flag);
            return $scope.flag;
          }
        });      
    };
  }]);
})();