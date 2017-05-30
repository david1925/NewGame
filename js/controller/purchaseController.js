(function(){
  angular.module("NewGameApp").controller("purchaseController", ['$scope', '$http', '$filter', '$translate', 'Domain', 'shoppingCart', '$window', function($scope, $http, $filter, $translate, Domain, shoppingCart, $window) {

    //scope variables
    $scope.pageSize=10;
    $scope.currentPage= 1;
    $scope.filteredData = [];
    $scope.gamesArray = [];
    $scope.genreRequests = [];
    $scope.genreSearch;
    $scope.priceSearch=0;
    $scope.showPaypalForm=0;   
 
    this.getDate = function (idGame) {           
        var today = new Date();
        var dd = today.getDate();
        var mm = today.getMonth()+1; //January is 0!
        var yyyy = today.getFullYear();
        if(dd<10) {
            dd='0'+dd
        } 
        if(mm<10) {
            mm='0'+mm
        } 
        today = dd+'/'+mm+'/'+yyyy;

        $scope.now = today;
    };

    $scope.changeLanguage = function (translate) {
        $translate.use(translate);
        localStorage.setItem("language",translate);
    };

    $scope.loadShoppingCart = function(){
   $scope.$broadcast("loadShoppingCart", {});
};

    this.loadPurchase = function () {
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
    };

    this.userLogged = function () {
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
        }
    });
    };

    $scope.confirmPurchase = function() {
        if(JSON.parse(sessionStorage.userLogged)=="null"){
          $window.open(Domain + 'view/login.html', "_self");
        }else{
          if(JSON.parse(localStorage.getItem("shoppingCart"))!=null){
            $scope.gamesArrayToConfirm = JSON.parse(localStorage.getItem("shoppingCart"));
              $http.post(Domain + 'api/public/games/confirmPurchase', {"gamesArray" : $scope.gamesArrayToConfirm, "total" : $scope.totalPrice, "userId": $scope.user.getId()}).then(function (response) {
                $scope.showPaypalForm =1;    
              });
              console.log("Este es el total que se envia a la api " + $scope.totalPrice);
            
          }
          else{
            $scope.shoppingCartAlert = 1;
          }
        }
    }

    $scope.emptyShoppingCart = function() {
          localStorage.clear();        
          $window.open(Domain + 'view/shop.html', "_self");
    }      


    this.getDate();
    this.loadPurchase();
    this.userLogged();
  }]);

  angular.module('NewGameApp').directive("showPaypalForm", function (){
    return {
      restrict: 'E',
      templateUrl:"show-paypal-form.html",
      controller:function(){

      },
      controllerAs: 'showPaypalForm'
    };
  });

})();