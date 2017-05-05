(function(){
  angular.module("NewGameApp").controller("forumController", ['$scope', '$http', '$translate', 'Domain', "$location", function($scope, $http, $translate, Domain, $location) {

    //scope variables
    $scope.forums="";
    $scope.pageSize=5;
    $scope.currentPage= 1;
    $scope.topicsArray = [];
    $scope.prize;
    $scope.showButtons=1;
    $scope.gameForum="www.newgame.local/view/forumThread.html";
    $scope.idGame;
    $scope.showAddTopicForm=0;
    $scope.showAddTopicMessage;
    $scope.addTopicManagement;
    //Attributes
    this.topicTitle;
    this.topicDescription;
    //Check if user is logged
    $http.get(Domain + "api/public/users/login/check").then(function (response) {$scope.checkUser = response.data;

        $scope.user = new User();
        var userObj = JSON.parse(sessionStorage.userLogged);
        $scope.user.construct(userObj.users_id_user,userObj.users_username,userObj.users_name,userObj.users_firstname,userObj.users_lastname,userObj.users_email,userObj.users_phone,userObj.users_image,userObj.users_summary,userObj.users_address,userObj.users_profile,userObj.users_status,userObj.users_language);
    });
    //GET all forums names
    $http.get(Domain + "api/public/forums").then(function (response) {$scope.forums = response.data;
      for(var i = 0; i<$scope.forums.length; i++){
        $http.get(Domain + "api/public/forums/topics/" + $scope.forums[i].games_id_game)
        .then(function (response) {
          $scope.topicsArray.push(response.data)});
      }


    });

    $scope.changeLanguage = function (translate) {
        $translate.use(translate);
        localStorage.setItem("language",translate);
    };

    this.showAddTopicForm = function (idGame) {
        $scope.showAddTopicForm=1;
    };

    this.checkAddTopic = function (topic,description) {
        $scope.showAddTopicForm=0;
        $http.post(Domain + 'api/public/forums/topics/add/', {"title" : topic, "text" : description, "idForum" : $scope.idForum, "userId" : $scope.user.getId()}).then(function (response) {
          if(response.data){
            $scope.showAddTopicMessage=1;
          }else{
            $scope.showAddTopicMessage=0;
          }
        });      
    };

    this.checkAddAnswer = function (answer) {
        $scope.showAddTopicForm=0;
        $http.post(Domain + 'api/public/forums/topics/messages/add/', {"text" : answer, "idTopic" : $scope.idTopic,  "idForum" : $scope.forumThreads[0].forums_id_forum, "userId" : $scope.user.getId()}).then(function (response) {
          if(response.data){
            $scope.showAddAnswerMessage=1;
          }else{
            $scope.showAddAnswerMessage=0;
          }
        });
    };

   this.showTopics = function (idGame) {
        $scope.showButtons=0;
        $scope.idForum = idGame;
        //GET topic forums
        $http.get(Domain + "api/public/forums/topics/game/" + idGame)
        .then(function (response) {$scope.forumThreads = response.data; console.log("Variable $scope.forumThreads cuando se hace la llamada" + $scope.forumThreads);});
    };

    this.showTopicsMessages = function (idTopic) {
      	$scope.showButtons=2;
      	$scope.idTopic = idTopic;
        //GET topic messages
        $http.get(Domain + "api/public/forums/topics/messages/game/" + idTopic)
        .then(function (response) {$scope.forumTopicsMessages = response.data;});         
    };

  }]);
  angular.module('NewGameApp').directive("showGamesForums", function (){
		return {
			restrict: 'E',
			templateUrl:"show-games-forums.html",
			controller:function(){

			},
			controllerAs: 'showGamesForums'
		};
	});

  angular.module('NewGameApp').directive("showForumThreat", function (){
		return {
			restrict: 'E',
			templateUrl:"show-forum-threat.html",
			controller:function(){

			},
			controllerAs: 'showForumThreat'
		};
	});
})();