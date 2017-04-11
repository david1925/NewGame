(function(){
  angular.module("NewGameApp").controller("NewGameAppController", ['$scope', '$translate', function($scope, $translate) {
       
    $scope.province_selected = "";
    $scope.country_selected = "";

    $scope.changeLanguage = function (translate) {
        $translate.use(translate);
        localStorage.setItem("language",translate);
      };

 /*GET JSON DATA*/
    $scope.myFunc = function() {
			$http.get("http://localhost/Proyecto/web/server/php/controller/select_provinces.php?id=" + $scope.country_selected.countries_id_country +"")
    		.then(function (response) {$scope.provinces = response.data.records;});       
      };
      /*$http.get("http://localhost/Proyecto/web/server/php/controller/select_countries.php")
      .then(function (response) {$scope.countries = response.data.records;});*/
  }]);
})();