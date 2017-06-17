geloraDelivery
	.config(function($stateProvider, $urlRouterProvider, $locationProvider) {

		$locationProvider.hashPrefix('');
		$urlRouterProvider.otherwise('/index');

		$stateProvider
		.state('index', {
			url: '/index',
  			templateUrl: 'app/index/index.html',
  			controller: 'IndexController as ctrl',
  			requireLogin: false,
  			pageTitle: 'Dealer | Delivery'
		})

		.state('deliveryIndex', {
			url: '/delivery/index',
  			templateUrl: 'app/delivery/index/deliveryIndex.html',
  			controller: 'DeliveryIndexController as ctrl',
  			requireLogin: false,
  			pageTitle: 'Dealer | Delivery Index'
		})
		.state('deliveryShow', {
			url: '/delivery/show/:id',
  			templateUrl: 'app/delivery/show/deliveryShow.html',
  			controller: 'DeliveryShowController as ctrl',
  			requireLogin: false,
  			pageTitle: 'Dealer | Delivery Show'
		})
		.state('salesOrderIndex', {
			url: '/salesOrder/index/:params',
  			templateUrl: 'app/salesOrder/index/salesOrderIndex.html',
  			controller: 'SalesOrderIndexController as ctrl',
  			pageTitle: 'Dealer | Logistic'
		})

	})