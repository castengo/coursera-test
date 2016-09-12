( function () {

'use strict';

angular.module('LunchCheck', [])
.controller('LunchCheckController', LunchCheckController);

LunchCheckController.$inject = ['$scope'];

function LunchCheckController($scope) {

  $scope.checkMenu = function () {
    var message = "";
    var items = $scope.menuItems;
    var conditionalColoring;

    if (items == null || items.trim() == "") {
      message = "Please enter data first";
      conditionalColoring = { color : 'red' };
    } else {
      conditionalColoring = { color : 'green' };
      items = items.split(",");
      var noOfItems = 0;

      for (var i = 0; i < items.length; i++) {
        // Do not consider an empty item "  " as item towards the count
        if (items[i].trim() != "" ) {
          noOfItems += 1;
        }
      }

      if (noOfItems <= 3) {
        message = "Enjoy!";
      } else {
        message = "Too much!";
      }
    }
    $scope.conditionalColoring = conditionalColoring;
    $scope.message = message;
  }

}

})();
