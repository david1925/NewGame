(function(){
  angular.module("NewGameApp").controller("forumController", ['$scope', '$http', '$translate', 'Domain', function($scope, $http, $translate, Domain) {

    //scope variables
    $scope.forums="";
    $scope.pageSize=5;
    $scope.currentPage= 1;

    $scope.changeLanguage = function (translate) {
        $translate.use(translate);
        localStorage.setItem("language",translate);
    };
    //GET all forums names
    $http.get(Domain + "api/public/forums").then(function (response) {$scope.forums = response.data;});
  }]);
})();