( function () {

  'use strict';

  angular.module('NarrowItDownApp', [])
  .controller('NarrowItDownController', NarrowItDownController)
  .service('MenuSearchService', MenuSearchService)
  .directive('foundItems', FoundItems);

  function FoundItems() {
    var ddo = {
      templateUrl: "foundItem.html",
      scope: {
        items: '<',
        onRemove: '&'
      }
    };
    return ddo;
  };

  NarrowItDownController.$inject = ['MenuSearchService'];
  function NarrowItDownController ( MenuSearchService ) {
    var menu = this;
    menu.searchTerm = "";
    menu.nada = false;

    menu.narrowItDown = function () {
      console.log(menu.searchTerm);
      if (menu.searchTerm != "") {
        MenuSearchService.getMatchedMenuItems(menu.searchTerm).then(function (foundItems) {
          menu.found = foundItems;
          console.log(menu.found.length);
          if (menu.found.length == 0) {
            menu.nada = true;
          } else {
            menu.nada = false;
          }
        });
      } else {
        menu.nada = true;
        menu.found= [];
      }
    };

    menu.removeItem = function (index) {
      menu.found.splice(index, 1);
    };
  };

  MenuSearchService.$inject = ['$http'];
  function MenuSearchService ($http) {
    var service = this;
    service.getMatchedMenuItems = function (searchTerm) {
      return $http({
        method: "GET",
        url: "https://davids-restaurant.herokuapp.com/menu_items.json"
      }).then(function (response) {
        var foundItems = [];
        response = response.data.menu_items;
        for (var i = 0; i < response.length; i++) {
          var description = response[i].description;
          if (description.toLowerCase().indexOf(searchTerm.toLowerCase()) !== -1 ) {
            foundItems.push(response[i]);
          }
        }
        return foundItems;
      }, function (error) {
        return "ERROR!";
      });
    };
  };

})();
