(function(){
  angular.module("NewGameApp").controller("UserProfileController", ['$scope', '$http', '$translate', 'Domain', '$location', '$window', function($scope, $http, $translate, Domain, $location, $window) {

    //scope variables
    $scope.username="";
    $scope.friends="";
    $scope.images="";
    $scope.pageSize=5;
    $scope.currentPage= 1;
    if(sessionStorage.userLogged!=null){
      $scope.showMessagesForm=1;
    }else{
      $scope.showMessagesForm=0;
    }

    var url = $location.absUrl();
    url = url.substr(50,52);
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

            if(isNaN(url)|| url=="" || url==null || url==undefined){
                 //GET Walls messages
                $http.get(Domain + "api/public/users/messages/" + $scope.user.getId())
                .then(function (response) {$scope.messages = response.data;});
                //GET Username
                $http.get(Domain + "api/public/users/username/" + $scope.user.getId())
                .then(function (response) {$scope.username = response.data;});
                //GET Friends list
                $http.get(Domain + "api/public/users/friends/" + $scope.user.getId())
                .then(function (response) {$scope.friends = response.data;});
                //GET Games image
                $http.get(Domain + "api/public/games/image/" + $scope.user.getId())
                .then(function (response) {$scope.images = response.data;});
                //GET Users image
                $http.get(Domain + "api/public/users/image/" + $scope.user.getId())
                .then(function (response) {$scope.user_image = response.data;
                    console.log("Variable de imagen antes del if" + $scope.user_image);
                    if($scope.users_image=="" || $scope.users_image==null || $scope.users_image==undefined){
                        //$scope.user_image="defaultImage.svg";
                        console.log("Entro en el if 1");
                    }
                    console.log($scope.user_image);
                });
                //GET users language
                $http.get(Domain + "api/public/users/language/" +  $scope.user.getId())
                .then(function (response) {$scope.language = response.data;
                    switch($scope.language.users_language){
                        case "en": $scope.language = "English";
                                break;
                        case "es": $scope.language = "Español";
                                break;
                        case "ca": $scope.language = "Català";
                                break;
                        }
                    });
                console.log("Entro en el de getuserid");
            }else{
                  //GET Walls messages
                $http.get(Domain + "api/public/users/messages/" + url)
                .then(function (response) {$scope.messages = response.data;});
                //GET Username
                $http.get(Domain + "api/public/users/username/" + url)
                .then(function (response) {$scope.username = response.data;});
                //GET Friends list
                $http.get(Domain + "api/public/users/friends/" + url)
                .then(function (response) {$scope.friends = response.data;});
                //GET Games image
                $http.get(Domain + "api/public/games/image/" + url)
                .then(function (response) {$scope.images = response.data;});
                //GET Users image
                $http.get(Domain + "api/public/users/image/" + url)
                .then(function (response) {$scope.user_image = response.data;
                    console.log($scope.user_image);
                    if($scope.user_image=="" || $scope.user_image==null || $scope.user_image==undefined){
                        $scope.user_image.users_image="defaultImage.svg";
                        console.log("Entro en el if 2");
                    }
                    console.log($scope.user_image);
                });
                //GET users language
                $http.get(Domain + "api/public/users/language/" +  url)
                .then(function (response) {$scope.language = response.data;
                    switch($scope.language.users_language){
                        case "en": $scope.language = "English";
                                break;
                        case "es": $scope.language = "Español";
                                break;
                        case "ca": $scope.language = "Català";
                                break;
                        }
                    });
                console.log("Entro en el de url");
            }
                   
                }else{

                    $http.get(Domain + "api/public/users/publicProfile/" + url)
                        .then(function(response) {
                            $scope.publicProfile = response.data;
                            if($scope.publicProfile[0].users_public_profile==0){
                                $window.open(Domain, "_self");
                            }else{
                                  //GET Walls messages
                $http.get(Domain + "api/public/users/messages/" + url)
                .then(function (response) {$scope.messages = response.data;});
                //GET Username
                $http.get(Domain + "api/public/users/username/" + url)
                .then(function (response) {$scope.username = response.data;});
                //GET Friends list
                $http.get(Domain + "api/public/users/friends/" + url)
                .then(function (response) {$scope.friends = response.data;});
                //GET Games image
                $http.get(Domain + "api/public/games/image/" + url)
                .then(function (response) {$scope.images = response.data;});
                //GET Users image
                $http.get(Domain + "api/public/users/image/" + url)
                .then(function (response) {$scope.user_image = response.data;
                    console.log($scope.user_image);
                    if($scope.user_image=="" || $scope.users_image==null || $scope.users_image==undefined){
                        $scope.users_image.users_image="defaultImage.svg";
                        console.log("Entro en el if 3");
                    }
                    console.log($scope.user_image);
                });
                //GET users language
                $http.get(Domain + "api/public/users/language/" +  url)
                .then(function (response) {$scope.language = response.data;
                    switch($scope.language.users_language){
                        case "en": $scope.language = "English";
                                break;
                        case "es": $scope.language = "Español";
                                break;
                        case "ca": $scope.language = "Català";
                                break;
                        }
                    });
                            }
                        });
                }
            });
  }]);
})();