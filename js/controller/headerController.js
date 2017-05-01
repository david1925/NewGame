(function(){
  angular.module("NewGameApp").controller("headerController", ['$http','$scope', '$translate', 'Domain', '$window', function($http, $scope, $translate, Domain, $window) {
    
    if(sessionStorage.userLogged!=null){
      $scope.showLoginButton=1;
    }else{
      $scope.showLoginButton=0;
    }

    this.logOut = function () {
      $scope.user = new User();
      var userObj = JSON.parse(sessionStorage.userLogged);
      $scope.user.construct(userObj.users_id_user,userObj.users_username,userObj.users_name,userObj.users_firstname,userObj.users_lastname,userObj.users_email,userObj.users_phone,userObj.users_image,userObj.users_summary,userObj.users_address,userObj.users_profile,userObj.users_status,userObj.users_language);
            //Unset user session on server
            $http.get(Domain + "api/public/users/logout/" + $scope.user.getId())
            .then(function (response) {$scope.users = response.data;});
            sessionStorage.removeItem("userLogged");
            console.log("Paso por aqui")
            window.open("../index.html", "_self");
    };
  }]);
})();