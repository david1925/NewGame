(function(){
  angular.module("NewGameApp").controller("storeController", ['$scope', '$http', '$translate', 'Domain', function($scope, $http, $translate, Domain) {

    $scope.userGames = [];
    $scope.routeToFile = Domain;

    $scope.changeLanguage = function (translate) {
        $translate.use(translate);
        localStorage.setItem("language",translate);
    };    

    /* COGE DATOS DEL USUARIO LOGUEADO */
    $http.get(Domain + "api/public/users/login/check").then(function (response) {
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
            //GET games name and image
            $http.get(Domain + "api/public/users/games/" + $scope.user.getId())
                    .then(function (response) {                                
                            for(var i=0; i<response.data.length; i++) {
                                    $scope.userGames[i] = new Game();
                                    $scope.userGames[i].construct(
                                            response.data[i].games_id_game,
                                            response.data[i].games_name,
                                            response.data[i].games_price,
                                            response.data[i].games_url_image,
                                            response.data[i].Genders_genders_id_gender
                                   );         
                            }
                    }  
            );
    });
  }]);
})();