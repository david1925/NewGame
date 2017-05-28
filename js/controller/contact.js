(function(){
  angular.module("NewGameApp").controller("ContactController", ['$scope', '$http', 'Domain', '$translate', function($scope, $http, Domain, $translate) {

        $scope.showConfirmationAlert =0;
        //Change language
        $scope.changeLanguage = function (translate) {
                $translate.use(translate);
                localStorage.setItem("language",translate);
        };

        $http.get("http://www.newgame.local/api/public/users/language/1")
        .then(function (response) {$scope.language = response.data;
                switch($scope.language[0].users_language){
                        case "en": $scope.language = "English";
                                break;
                        case "es": $scope.language = "Español";
                                break;
                        case "ca": $scope.language = "Català";
                                break;
                }
        });

        $http.get(Domain + "api/public/users/login/check")
                .then(function (response) {
                        $scope.user = new User();
                        var userObj = JSON.parse(sessionStorage.userLogged);
                        $scope.user.construct(
                                userObj.users_id_user,
                                userObj.users_username,
                                userObj.users_name,
                                userObj.users_firstname,
                                userObj.users_lastname,
                                userObj.users_email,
                                userObj.users_phone,
                                userObj.users_image,
                                userObj.users_summary,
                                userObj.users_address,
                                userObj.users_profile,
                                userObj.users_status,
                                userObj.users_language
                        );    
        });

        this.submit = function () {
                $http.post(Domain + 'api/public/users/contact/', {
                        "username" : $scope.user.getUsername(), 
                        "email" : $scope.user.getEmail(), 
                        "subject" : $scope.contact.subject, 
                        "description" : $scope.contact.description
                })
                $scope.showConfirmationAlert =1;
        };

  }]);
})();