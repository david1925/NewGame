(function(){
  angular.module("NewGameApp").controller("headerController", ['$http','$scope', '$translate', 'Domain', '$window', function($http, $scope, $translate, Domain, $window) {


    //scope variables
    $scope.loginRoute = Domain + "view/login.html";
    $scope.purchaseRoute = Domain + "view/purchase.html"

    if(sessionStorage.userLogged!=null){
      $scope.showLoginButton=1;
    }else{
      $scope.showLoginButton=0;
    }

     $scope.$on("loadShoppingCart", function () {
                 $scope.shoppingCartGames = JSON.parse(localStorage.getItem("shoppingCart"));
           $scope.gamesToShow = [];
            var cont=0;
            var contForPrice=0;
           $scope.totalPrice=0;
          if(JSON.parse(localStorage.getItem("shoppingCart"))!=null){
             $scope.shoppingCartGamesNumber = JSON.parse(localStorage.getItem("shoppingCart")).length;
             for(var i = 0; i<$scope.shoppingCartGamesNumber; i++){
                $http.get(Domain + "api/public/games/shoppingCart/" + $scope.shoppingCartGames[i]).then(function (response) {$scope.game = response.data;
                      $scope.gamesToShow.push($scope.game);      
                      //console.log("Se muestra el nombre del juego " + $scope.gamesToShow[cont][0].games_name);                      
                      $scope.totalPrice = parseFloat($scope.totalPrice) + parseFloat($scope.gamesToShow[cont][0].games_price);                       
                      cont++;
                      //console.log("Precio total: " + Math.round($scope.totalPrice));
                      $scope.totalPrice = Math.round($scope.totalPrice);
                });
            }
            
          }
        });

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
                .then(function (response) {$scope.userFriends = response.data;}); 
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

    //$scope.loadShoppingCart();
    $scope.loadShoppingCart = function(){
   $scope.$broadcast("loadShoppingCart", {});
};

  $scope.emptyShoppingCart = function() {
          localStorage.clear();        
          $window.open(Domain + 'view/shop.html', "_self");
    } 
  
  $scope.loadShoppingCart();

    }]);
})();