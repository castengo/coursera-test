(function () {

angular.module('Data')
.service('MenuDataService', MenuDataService)
.constant('ApiBasePath', "https://davids-restaurant.herokuapp.com/");

MenuDataService.$inject = ['$http', 'ApiBasePath'];
function MenuDataService($http, ApiBasePath) {
    var menuData = this;

    menuData.getAllCategories = function () {
      return $http ( {
        method: "GET",
        url: ApiBasePath + "categories.json"
      }).then( function (response) {
        return response.data;
      }, function (error) {
        return "Not Found";
      })
    };

    menuData.getItemsForCategory = function (shortName) {
      return $http ( {
        method: "GET",
        url: ApiBasePath + "menu_items.json",
        params: {category: shortName}
      }).then( function (response) {
        return response.data.menu_items;
      }, function (error) {
        console.log("ERROR");
        return "Not Found";
      })
    };
}

})();
