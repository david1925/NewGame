(function(){
  angular.module("NewGameApp").controller("gameProfileController", ['$scope', '$http', '$filter', '$translate', 'Domain', '$location', function($scope, $http, $filter, $translate, Domain, $location) {

    //scope variables
    $scope.pageSize=10;
    $scope.currentPage= 1;
    $scope.likeButton=0;

    //Get id from url
    var url = $location.absUrl();
    url = url.substr(50,52);
    
            //GET all attributes from a game
            $http.get(Domain + "api/public/games/" + url)
            .then(function (response) {$scope.game = response.data;});
            $http.get(Domain + "api/public/users/login/check")
            .then(function (response) {$scope.checkUser = response.data;});

            this.likeButtonValue = function (id) {
                $scope.likeButtonValue=id;
            };

            this.checkAddReview = function (description) {
                $scope.user = new User();
        var userObj = JSON.parse(sessionStorage.userLogged);
        $scope.user.construct(userObj.users_id_user,userObj.users_username,userObj.users_name,userObj.users_firstname,userObj.users_lastname,userObj.users_email,userObj.users_phone,userObj.users_image,userObj.users_summary,userObj.users_address,userObj.users_profile,userObj.users_status,userObj.users_language);
                console.log("INSERT INTO Reviews (reviews_text,reviews_rating,Games_games_id_game,Users_users_id_user) VALUES (" + description+","+$scope.likeButtonValue+","+$scope.game[0].games_id_game+"," + $scope.user.getId()+")");
        $http.post(Domain + 'api/public/games/reviews/add', {"text" : description, "rating" : $scope.likeButtonValue, "gameId" : $scope.game[0].games_id_game, "userId" : $scope.user.getId()}).then(function (response) {
          if(response.data){
            $scope.showAddReviewMessage=1;
          }else{
            $scope.showAddReviewMessage=0;
          }
        });     
    };
    
  }]);
})();