(function(){
  angular.module("NewGameApp").controller("NewGameAppController", ['$scope', '$translate', 'Domain', '$http', function($scope, $translate, Domain, $http) {
       
    $scope.register="";

    $scope.changeLanguage = function (translate) {
        $translate.use(translate);
        localStorage.setItem("language",translate);
      };
      this.submit = function () {
        $http.post(Domain + 'api/public/users/register/', {"username" : $scope.register.username, "password" : $scope.register.password, "email" : $scope.register.email})
      }
      
  }]);
})();