(function(){
  angular.module("NewGameApp").controller("NewGameAppController", ['$scope', '$translate', function($scope, $translate) {
       
    $scope.changeLanguage = function (translate) {
        $translate.use(translate);
        localStorage.setItem("language",translate);
      };
  }]);
})();