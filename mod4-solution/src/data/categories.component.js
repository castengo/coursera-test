(function () {

angular.module('Data')
.component('categories', {
  templateUrl: "/src/templates/category.html",
  bindings: {
    categories: '<list'
  }
});

})();
