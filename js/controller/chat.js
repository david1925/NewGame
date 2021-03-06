(function(){
angular.module("NewGameApp").controller("chatController", ['$scope', '$http', '$filter', '$translate', 'Domain', '$location', '$interval',  function($scope, $http, $filter, $translate, Domain, $location, $interval) {

        //scope variables
        $scope.chats = [];
        //Get id from url
        var url = $location.absUrl();
        url = url.substr(49,51);

        $scope.submit = function() {
                $http.get(Domain + "api/public/users/" + url).then(function (response) {
                        $scope.friend = new User();
                        $scope.friend.construct(
                                response.data[0].users_id_user,
                                response.data[0].users_username,
                                response.data[0].users_name,
                                response.data[0].users_firstname,
                                response.data[0].users_lastname,
                                response.data[0].users_email,
                                response.data[0].users_phone,
                                response.data[0].users_image,
                                response.data[0].users_summary,
                                response.data[0].users_address,
                                response.data[0].users_profile,
                                response.data[0].users_status,
                                response.data[0].users_language
                        );    

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

                                if($scope.message!=null && $scope.message!="") {
                                        $http.post(Domain + 'api/public/chat/message', {
                                                "userId" : $scope.user.getId(), 
                                                "friendId" : $scope.friend.getId(), 
                                                "message" : $scope.message
                                        }).then(function (response) {                                
                                        for(var i=0; i<response.data.length; i++) {
                                                $scope.chats[i] = new Chat();
                                                $scope.chats[i].construct(
                                                        response.data[i].Users_users_id_user_send,
                                                        response.data[i].chats_text
                                                )}           
                                                $scope.message="";
                                        }); 
                                }

                                $http.post(Domain + "api/public/chat" , { 
                                        "idUser" : $scope.user.getId(), 
                                        "idFriend" : $scope.friend.getId()
                                }).then(function (response) {                                
                                        for(var i=0; i<response.data.length; i++) {
                                                $scope.chats[i] = new Chat();
                                                $scope.chats[i].construct(
                                                        response.data[i].Users_users_id_user_send,
                                                        response.data[i].chats_text
                                                );         
                                        }
                                });
                        });
                });                
        }  

        $scope.getMessages = function() {
                $http.get(Domain + "api/public/users/" + url).then(function (response) {
                        $scope.friend = new User();
                        $scope.friend.construct(
                                response.data[0].users_id_user,
                                response.data[0].users_username,
                                response.data[0].users_name,
                                response.data[0].users_firstname,
                                response.data[0].users_lastname,
                                response.data[0].users_email,
                                response.data[0].users_phone,
                                response.data[0].users_image,
                                response.data[0].users_summary,
                                response.data[0].users_address,
                                response.data[0].users_profile,
                                response.data[0].users_status,
                                response.data[0].users_language
                        );    

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

                                $http.post(Domain + "api/public/chat" , { 
                                        "idUser" : $scope.user.getId(), 
                                        "idFriend" : $scope.friend.getId()
                                }).then(function (response) {                                
                                        for(var i=0; i<response.data.length; i++) {
                                                $scope.chats[i] = new Chat();
                                                $scope.chats[i].construct(
                                                        response.data[i].Users_users_id_user_send,
                                                        response.data[i].chats_text
                                                );         
                                        }
                                });
                        });
                });                
        }  
        //Get username from friend
         $http.get(Domain + "api/public/users/username/" + url).then(function(response) {$scope.friendUsername = response.data;console.log($scope.friendUsername)});
        
        this.timer = $interval(function () {
                $scope.getMessages();
        }, 1000);
   }]);
})();