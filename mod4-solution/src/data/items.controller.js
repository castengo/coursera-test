(function () {
'use strict';

angular.module('Data')
.controller('ItemsController', ItemsController);

ItemsController.$inject = ['$stateParams','items'];
function ItemsController($stateParams, items) {
  var category = this;
  category.title = $stateParams.categoryName + " Menu Items"
  category.items = items;
};

})();
