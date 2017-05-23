(function(){
  angular.module("NewGameApp").controller("LoginController", ['$http','$scope', '$translate', 'Domain', '$window', function($http, $scope, $translate, Domain, $window) {
    
     $scope.registerRoute = Domain + "view/register.html";

  this.login = function () {
      $scope.flag;
      $http.post(Domain + 'api/public/users/login/', {"username" : $scope.username, "password" : $scope.password}).then(function (response) {
          if (response.data.length>0) {
            $scope.user = new User();
            sessionStorage.setItem("userLogged", JSON.stringify(response.data[0]));
            var userObj = JSON.parse(sessionStorage.userLogged);
            $scope.user.construct(userObj.users_id_user,userObj.users_username,userObj.users_name,userObj.users_firstname,userObj.users_lastname,userObj.users_email,userObj.users_phone,userObj.users_image,userObj.users_summary,userObj.users_address,userObj.users_profile,userObj.users_status,userObj.users_language);
            $scope.flag = true;
            $window.open('../index.html', "_self");
            return $scope.flag;
          }
          else{
            $scope.flag = false;
            return $scope.flag;
          }
        });      
    };
  }]);
})();