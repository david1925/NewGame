(function(){
  angular.module("NewGameApp").controller("headerController", ['$http','$scope', '$translate', 'Domain', '$window', function($http, $scope, $translate, Domain, $window) {


    //scope variables
    $scope.shoppingCartGames = JSON.parse(localStorage.getItem("shoppingCart"));

    if(sessionStorage.userLogged!=null){
      $scope.showLoginButton=1;
    }else{
      $scope.showLoginButton=0;
    }

    $http.get(Domain + "api/public/users/login/check")
        .then(function (response) {

            $scope.isLoged = response.data;

            if($scope.isLoged=="true"){
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

            $http.get(Domain + "api/public/users/friends/" + $scope.user.getId())
                .then(function (response) {$scope.userFriends = response.data;
                    console.log($scope.userFriends);
            }); 
        }
    });

    $scope.changeAction = function() {
        if($scope.action == "actions") {
            $scope.action = "users";
        }
        else $scope.action = "actions";
    }    

    $scope.openChat = function(idUser) {
        $window.open("view/chat.html?id="+idUser, "_blank", "toolbar=no,scrollbars=yes,resizable=no,fullscreen=no,top=500,left=500,width=400,height=400");
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