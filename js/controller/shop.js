(function(){
  angular.module("NewGameApp").controller("shopController", ['$scope', '$http', '$filter', '$translate', 'Domain', function($scope, $http, $filter, $translate, Domain) {

    //scope variables
    $scope.pageSize=10;
    $scope.currentPage= 1;
    $scope.filteredData = [];
    $scope.gamesArray = [];
    $scope.genreRequests = [];
    $scope.genreSearch;
    $scope.priceSearch=0;
    
    //GET games id,image,name
    $http.get(Domain + "api/public/games/shop")
        .then(function (response) {      
            $scope.gamesArray = response.data;
            console.log($scope.gamesArray);            
            for(var i = 0; i<$scope.gamesArray.length; i++){
                var game = new Game();
                game.construct(parseInt($scope.gamesArray[i].games_id_game), $scope.gamesArray[i].games_name, parseInt($scope.gamesArray[i].games_price),
                              $scope.gamesArray[i].games_url_image, parseInt($scope.gamesArray[i].games_rating), parseInt($scope.gamesArray[i].Genders_genders_id_gender));
                $scope.filteredData.push(game);
                $scope.gamesArray[i] = $scope.filteredData[i];
            }
        }
    );

    $scope.smallerThan = function(val){
        
        return function(item){
            //alert(item);
            return (item <= val);
        }
    }
    $scope.showGenre = function(idGenre){
        $scope.genreSearch = idGenre;
    }
    //GET genre name
    $http.get(Domain + "api/public/genres")
        .then(function (response) {
            $scope.genreRequests = response.data;
        }
    );

    $scope.priceFilter = function (game, index, gamesArray) 
    { 
      if(parseInt(game.getPrice()) < $scope.priceSearch) { 
        return game; 
      } 
    } 

    $scope.$watch("priceSearch+genreSearch",function () { 
      $scope.filteredData = $scope.gamesArray; 
      if(!isNaN($scope.priceSearch) && $scope.priceSearch > 0) 
      { 
               $scope.filteredData = $filter('filter')($scope.filteredData,$scope.priceFilter); 
      } 
      $scope.filteredData = $filter('filter')($scope.filteredData,{idGender:$scope.genreSearch}); 
    });

    $scope.changeLanguage = function (translate) {
        $translate.use(translate);
        localStorage.setItem("language",translate);
    };
  }]);
})();