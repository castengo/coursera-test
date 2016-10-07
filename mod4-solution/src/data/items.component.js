(function () {

angular.module('Data')
.component('items', {
  templateUrl: "src/templates/item.html",
  bindings: {
    items: '<'
  }

});

})();
