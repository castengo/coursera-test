( function () {

  'use strict';

  angular.module('ShoppingListCheckOff', [])
  .controller('ToBuyShoppingController', ToBuyShoppingController)
  .controller('AlreadyBoughtShoppingController', AlreadyBoughtShoppingController)
  .service('ShoppingListCheckOffService', ShoppingListCheckOffService)

  ToBuyShoppingController.$inject = ['ShoppingListCheckOffService'];
  AlreadyBoughtShoppingController.$inject = ['ShoppingListCheckOffService'];

  function ToBuyShoppingController(ShoppingListCheckOffService) {
    var toBuyList = this;

    toBuyList.toBuyItems = ShoppingListCheckOffService.getToBuyItems();

    toBuyList.buyItem = function (itemIndex) {
      ShoppingListCheckOffService.buyItem(itemIndex);
    };

  };

  function AlreadyBoughtShoppingController(ShoppingListCheckOffService) {
    var boughtList = this;

    boughtList.alreadyBoughtItems = ShoppingListCheckOffService.getAlreadyBoughtItems();

  };

  function ShoppingListCheckOffService() {
    var service = this;

    var toBuyItems = [
      {
        name: "Cilantro",
        quantity: "1 bunch"
      }, {
        name: "Chicken Breast",
        quantity: "2 pounds"
      }, {
        name: "Pumpkin Puree",
        quantity: "2 cans"
      }, {
        name: "Chocolate Chip Cookies",
        quantity: "3 bags"
      }, {
        name: "Orange Juice",
        quantity: "1 jug"
      }
    ];

    var alreadyBoughtItems = [];

    service.getToBuyItems = function () {
      return toBuyItems;
    }

    service.buyItem = function (itemIndex) {
      var boughtItem = toBuyItems[itemIndex];
      toBuyItems.splice(itemIndex, 1);
      alreadyBoughtItems.push(boughtItem);
    };

    service.getAlreadyBoughtItems = function () {
      return alreadyBoughtItems;
    };

  };



})();
