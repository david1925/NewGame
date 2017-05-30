(function() {
    angular.module("NewGameApp").controller("UserProfileController", ['$scope', '$http', '$translate', 'Domain', '$location', '$window', function($scope, $http, $translate, Domain, $location, $window) {

        //scope variables
        $scope.username = "";
        $scope.friends = "";
        $scope.images = "";
        $scope.pageSize = 5;
        $scope.currentPage = 1;
        if (sessionStorage.userLogged != null) {
            $scope.showMessagesForm = 1;
        } else {
            $scope.showMessagesForm = 0;
        }
        
$scope.user_image = JSON.parse('{"users_image": "defaultImage.svg"}');

        console.log($scope.user_image);

        var url = $location.absUrl();
        url = url.substr(50, 52);
        console.log(url);

        $http.get(Domain + "api/public/users/login/check")
            .then(function(response) {

                $scope.isLoged = response.data;

                if ($scope.isLoged == "true") {
                    $scope.user = new User();
                    console.log($scope.user);
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

                    if (isNaN(url) || url == "" || url == null || url == undefined) {
                        //GET Walls messages
                        $http.get(Domain + "api/public/users/messages/" + $scope.user.getId())
                            .then(function(response) {
                                $scope.messages = response.data;
                            });
                        //GET Username
                        $http.get(Domain + "api/public/users/username/" + $scope.user.getId())
                            .then(function(response) {
                                $scope.username = response.data;
                            });
                        //GET Friends list
                        $http.get(Domain + "api/public/users/friends/" + $scope.user.getId())
                            .then(function(response) {
                                $scope.friends = response.data;
                            });
                        //GET Games image
                        $http.get(Domain + "api/public/games/image/" + $scope.user.getId())
                            .then(function(response) {
                                $scope.images = response.data;
                            });
                         //GET Users image
                        $http.get(Domain + "api/public/users/image/" + url)
                            .then(function(response) {
                                $scope.user_image = response.data;

                                if (response.data.users_image === null) {
                                    $scope.user_image = JSON.parse('{"users_image": "defaultImage.svg"}');
                                }
                            });
                        //GET users language
                        $http.get(Domain + "api/public/users/language/" + $scope.user.getId())
                            .then(function(response) {
                                $scope.language = response.data;
                                switch ($scope.language.users_language) {
                                    case "en":
                                        $scope.language = "English";
                                        break;
                                    case "es":
                                        $scope.language = "Español";
                                        break;
                                    case "ca":
                                        $scope.language = "Català";
                                        break;
                                }
                            });
                        console.log("Entro en el de getuserid");
                    } else {
                        //GET Walls messages
                        $http.get(Domain + "api/public/users/messages/" + url)
                            .then(function(response) {
                                $scope.messages = response.data;
                            });
                        //GET Username
                        $http.get(Domain + "api/public/users/username/" + url)
                            .then(function(response) {
                                $scope.username = response.data;
                            });
                        //GET Friends list
                        $http.get(Domain + "api/public/users/friends/" + url)
                            .then(function(response) {
                                $scope.friends = response.data;
                            });
                        //GET Games image
                        $http.get(Domain + "api/public/games/image/" + url)
                            .then(function(response) {
                                $scope.images = response.data;
                            });
                        //GET Users image
                        $http.get(Domain + "api/public/users/image/" + url)
                            .then(function(response) {
                                $scope.user_image = response.data;

                                if (response.data.users_image === null) {
                                    $scope.user_image = JSON.parse('{"users_image": "defaultImage.svg"}');
                                }

                            });
                        //GET users language
                        $http.get(Domain + "api/public/users/language/" + url)
                            .then(function(response) {
                                $scope.language = response.data;
                                switch ($scope.language.users_language) {
                                    case "en":
                                        $scope.language = "English";
                                        break;
                                    case "es":
                                        $scope.language = "Español";
                                        break;
                                    case "ca":
                                        $scope.language = "Català";
                                        break;
                                }
                            });
                        console.log("Entro en el de url");
                    }

                } else {

                    $http.get(Domain + "api/public/users/publicProfile/" + url)
                        .then(function(response) {
                            $scope.publicProfile = response.data;
                            if ($scope.publicProfile[0].users_public_profile == 0) {
                                $window.open(Domain, "_self");
                            } else {
                                //GET Walls messages
                                $http.get(Domain + "api/public/users/messages/" + url)
                                    .then(function(response) {
                                        $scope.messages = response.data;
                                    });
                                //GET Username
                                $http.get(Domain + "api/public/users/username/" + url)
                                    .then(function(response) {
                                        $scope.username = response.data;
                                    });
                                //GET Friends list
                                $http.get(Domain + "api/public/users/friends/" + url)
                                    .then(function(response) {
                                        $scope.friends = response.data;
                                    });
                                //GET Games image
                                $http.get(Domain + "api/public/games/image/" + url)
                                    .then(function(response) {
                                        $scope.images = response.data;
                                    });
                                 //GET Users image
                        $http.get(Domain + "api/public/users/image/" + url)
                            .then(function(response) {
                            	console.log("Entro en el segundo");
                                $scope.user_image = response.data;

                                if (response.data.users_image === null) {
                                    $scope.user_image = JSON.parse('{"users_image": "defaultImage.svg"}');
                                }
                            });
                                //GET users language
                                $http.get(Domain + "api/public/users/language/" + url)
                                    .then(function(response) {
                                        $scope.language = response.data;
                                        switch ($scope.language.users_language) {
                                            case "en":
                                                $scope.language = "English";
                                                break;
                                            case "es":
                                                $scope.language = "Español";
                                                break;
                                            case "ca":
                                                $scope.language = "Català";
                                                break;
                                        }
                                    });
                            }
                        });
                }
            });
    this.insertIntoUserWall = function(message){
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
                     if (isNaN(url) || url == "" || url == null || url == undefined) {
                    $http.post(Domain + 'api/public/users/wall/add', {"userId" : $scope.user.getId(), "wallId" : $scope.user.getId(), "message": message}).then(function (response) {
                            if(response.data){
                                 $scope.showAddWallMessage=1;
                            }else{
                                $scope.showAddWallMessage=0;
                            }                         
                        });
                    }else{
                    $http.post(Domain + 'api/public/users/wall/add', {"userId" : $scope.user.getId(), "wallId" : url, "message": message}).then(function (response) {
                            if(response.data){
                                 $scope.showAddWallMessage=1;
                            }else{
                                $scope.showAddWallMessage=0;
                            }
                        });
                        console.log("http://www.newgame.local/api/public/users/wall/add");
                        console.log("Id del usuario que introduce: " + $scope.user.getId());
                        console.log("Mensaje  que se insertara: " + message);
                       
                        console.log("Id del usuario que al que van a insertar: " + $scope.user.getId());    
                    
                        console.log("Id del usuario que al que van a insertar: " + url);    
                        
                }
                    }
            });
        };
    }]);
})();