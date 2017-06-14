(function(){
  angular.module("NewGameApp").controller("NewGameAppController", ['$scope', '$translate', 'Domain', '$http', function($scope, $translate, Domain, $http) {
      

    $scope.showConfirmationAlert =0; 

    $scope.changeLanguage = function (translate) {
      $translate.use(translate);
      localStorage.setItem("language",translate);
    };

    $scope.log = function (value) {
      console.log(value);
    };

    this.submit = function () {
      console.log("Valor de las variables que se pasaran a la api: " + $scope.register.username + " password: " + $scope.register.password + " email: " + $scope.register.email);
      $http.post(Domain + 'api/public/users/register/', {"username" : $scope.register.username, "password" : $scope.register.password, "email" : $scope.register.email})
      $scope.showConfirmationAlert =1; 
    }
      
  }]);
})();