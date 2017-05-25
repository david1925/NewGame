(function() {
    angular.module("NewGameApp").controller("headerController", ['$http', '$scope', '$translate', 'Domain', '$window', function($http, $scope, $translate, Domain, $window) {


        //scope variables
        $scope.indexRoute = Domain;
        $scope.loginRoute = Domain + "view/login.html";
        $scope.purchaseRoute = Domain + "view/purchase.html";
        $scope.shopRoute = Domain + "view/shop.html";
        $scope.storeRoute = Domain + "view/store.html";
        $scope.communityRoute = Domain + "view/forum.html";
        $scope.contactRoute = Domain + "view/contact.html";

        $scope.rowCount=2;
        $scope.listofSolicitations = "";
        this.friendFind;

        if (sessionStorage.userLogged != null) {
            $scope.showLoginButton = 1;
        } else {
            $scope.showLoginButton = 0;
        }


        $scope.$on("loadShoppingCart", function() {
            $scope.shoppingCartGames = JSON.parse(localStorage.getItem("shoppingCart"));
            $scope.gamesToShow = [];
            var cont = 0;
            var contForPrice = 0;
            $scope.totalPrice = 0;
            if (JSON.parse(localStorage.getItem("shoppingCart")) != null) {
                $scope.shoppingCartGamesNumber = JSON.parse(localStorage.getItem("shoppingCart")).length;
                for (var i = 0; i < $scope.shoppingCartGamesNumber; i++) {
                    $http.get(Domain + "api/public/games/shoppingCart/" + $scope.shoppingCartGames[i]).then(function(response) {
                        $scope.game = response.data;
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
            .then(function(response) {

                $scope.isLoged = response.data;

                if ($scope.isLoged == "true") {
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
                        .then(function(response) {
                            $scope.userFriends = response.data;
                        });
                }
            });

        $scope.changeAction = function() {
            if ($scope.action == "actions") {
                $scope.action = "users";
            } else $scope.action = "actions";
        }

        $scope.openChat = function(idUser) {
            $window.open($scope.indexRoute +"view/chat.html?id=" + idUser, "_blank", "toolbar=no,scrollbars=yes,resizable=no,fullscreen=no,top=500,left=500,width=400,height=400");
        }

        $scope.openFriendProfile = function(idUser) {
            $window.open($scope.indexRoute +"view/userProfile.html?id=" + idUser, "_self", "toolbar=no,scrollbars=yes,resizable=no,fullscreen=no,top=500,left=500,width=400,height=400");
        }

        this.logOut = function() {
            $scope.user = new User();
            var userObj = JSON.parse(sessionStorage.userLogged);
            $scope.user.construct(userObj.users_id_user, userObj.users_username, userObj.users_name, userObj.users_firstname, userObj.users_lastname, userObj.users_email, userObj.users_phone, userObj.users_image, userObj.users_summary, userObj.users_address, userObj.users_profile, userObj.users_status, userObj.users_language);
            //Unset user session on server
            $http.get(Domain + "api/public/users/logout/" + $scope.user.getId())
                .then(function(response) {
                    $scope.users = response.data;
                });
            sessionStorage.removeItem("userLogged");
            //window.open(Domain, "_self");
        };

        $scope.loadShoppingCart = function() {
            $scope.$broadcast("loadShoppingCart", {});
        };

        $scope.emptyShoppingCart = function() {
            localStorage.clear();
            $window.open(Domain + 'view/shop.html', "_self");
        }
        $scope.addFriend = function() {
            console.log(this.friendFind);
            $scope.user = new User();
            var userObj = JSON.parse(sessionStorage.userLogged);
            $scope.user.construct(userObj.users_id_user, userObj.users_username, userObj.users_name, userObj.users_firstname, userObj.users_lastname, userObj.users_email, userObj.users_phone, userObj.users_image, userObj.users_summary, userObj.users_address, userObj.users_profile, userObj.users_status, userObj.users_language);
            $http.post(Domain + "api/public/users/friendShip", {"username": this.friendFind})
                .then(function(response) {
                    $scope.freindShipFriend = response.data;
                    if ($scope.freindShipFriend != "") {
                        console.log($scope.freindShipFriend[0].users_id_user);
                        $http.post(Domain + "api/public/users/friendShip/insert", {
                                "user_send": $scope.user.getId(),
                                "user_received": $scope.freindShipFriend[0].users_id_user
                            })
                            .then(function(response) {
                                $scope.rowCount = response.data;
                            });
                    } else {
                        console.log("User not found!");
                        $scope.rowCount=0;
                    }
                });
        };

        this.getFriendshipSolicitations = function() {
            $http.get(Domain + "api/public/users/login/check")
                .then(function(response) {

                    $scope.isLoged = response.data;

                    if ($scope.isLoged == "true") {
                        $scope.user = new User();
                        var userObj = JSON.parse(sessionStorage.userLogged);
                        console.log(userObj);
                        $scope.user.construct(userObj.users_id_user, userObj.users_username, userObj.users_name, userObj.users_firstname, userObj.users_lastname, userObj.users_email, userObj.users_phone, userObj.users_image, userObj.users_summary, userObj.users_address, userObj.users_profile, userObj.users_status, userObj.users_language);
                        $http.get(Domain + "api/public/users/friendShip/pending/" + $scope.user.getId()).then(function(response) {
                            $scope.listofSolicitations = response.data;
                            console.log("Lista de solicitudes: ");
                            console.log($scope.listofSolicitations);
                        });
                    }
                });

        };

        $scope.acceptSolicitation = function(id) {
            $http.post(Domain + "api/public/users/friendShip/update", {
                    "user_send": id,
                    "user_received": $scope.user.getId()
                })
                .then(function(response) {
                    $scope.rowUpdateCount = response.data;
                });
        }

        $scope.declineProfile = function(id) {
            $http.post(Domain + "api/public/users/friendShip/delete", {
                    "user_send": id,
                    "user_received": $scope.user.getId()
                })
                .then(function(response) {
                    $scope.rowDeleteCount = response.data;
                });
        }

        $scope.loadShoppingCart();
        this.getFriendshipSolicitations();

    }]);
})();