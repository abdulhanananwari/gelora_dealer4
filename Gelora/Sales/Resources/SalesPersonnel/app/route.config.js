geloraSalesPersonnel
	.config(function($stateProvider, $urlRouterProvider, $locationProvider) {

		$locationProvider.hashPrefix('');
		$urlRouterProvider.otherwise('/index');

		$stateProvider
		.state('index', {
			url: '/index',
  			templateUrl: 'app/index/index.html',
  			controller: 'IndexController as ctrl',
  			requireLogin: false,
  			pageTitle: 'Dealer | Sales Personnel'
		})

		.state('prospectIndex', {
			url: '/prospect/index',
  			templateUrl: 'app/prospect/index/prospectIndex.html',
  			controller: 'ProspectIndexController as ctrl',
  			requireLogin: false,
  			pageTitle: 'Dealer | Sales Personnel | Prospect Index'
		})
		.state('prospectShow', {
			url: '/prospect/show/:id',
  			templateUrl: 'app/prospect/show/prospectShow.html',
  			controller: 'ProspectShowController as ctrl',
  			requireLogin: false,
  			pageTitle: 'Dealer | Sales Personnel | Prospect Show'
		})

		.state('salesOrderIndex', {
			url: '/salesOrder/index',
  			templateUrl: 'app/salesOrder/index/salesOrderIndex.html',
  			controller: 'IndexController as ctrl',
  			requireLogin: false,
  			pageTitle: 'Dealer | Sales Personnel'
		})
		.state('salesOrderShow', {
			url: '/salesOrder/show',
  			templateUrl: 'app/salesOrder/show/salesOrderShow.html',
  			controller: 'IndexController as ctrl',
  			requireLogin: false,
  			pageTitle: 'Dealer | Sales Personnel'
		})

	})