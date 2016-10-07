(function () {

angular.module('MenuApp')
.config(RoutesConfig);

RoutesConfig.$inject = ['$stateProvider', '$urlRouterProvider'];
function RoutesConfig($stateProvider, $urlRouterProvider) {

  // Redirect to tab 1 if no other URL matches
  $urlRouterProvider.otherwise('/');

  // Set up UI states
  $stateProvider
    .state('home', {
      url: '/',
      templateUrl: 'src/templates/home.html'
    })

    .state('categories', {
      url: '/categories',
      templateUrl: 'src/templates/categories.html',
      controller: 'CategoriesController as menu',
      resolve: {
        categories: ['MenuDataService', function (service) {
          return service.getAllCategories();
        }]
      }
    })

    .state('items', {
      url: '/items/{shortName}',
      templateUrl: "src/templates/items.html",
      controller: 'ItemsController as category',
      resolve: {
        items: ['$stateParams','MenuDataService', function ($stateParams, MenuDataService) {
          return MenuDataService.getItemsForCategory($stateParams.shortName);
        }]
      },
      params: {
        categoryName: ""
      }
    })
}

})();
