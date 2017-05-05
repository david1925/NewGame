(function(){
  angular.module("NewGameApp").controller("ContactController", ['$scope', '$http', '$translate', function($scope, $http, $translate) {

    //scope variables
    $scope.userData="";

        //GET Username
        $http.get("http://www.newgame.local/api/public/contact/1")
        .then(function (response) {$scope.userData = response.data;
        console.log($scope.userData);}); 

        //Change language
        $scope.changeLanguage = function (translate) {
                $translate.use(translate);
                localStorage.setItem("language",translate);
        };

        $http.get("http://www.newgame.local/api/public/users/language/1")
        .then(function (response) {$scope.language = response.data;
        console.log($scope.language[0].users_language);
        switch($scope.language[0].users_language){
                case "en": $scope.language = "English";
                        break;
                case "es": $scope.language = "Español";
                        break;
                case "ca": $scope.language = "Català";
                        break;
        }
     });

     this.submit = function () {
        $http.post(Domain + 'api/public/users/register/', {"username" : $scope.register.username, "password" : $scope.register.password, "email" : $scope.register.email})
     }



  }]);
})();