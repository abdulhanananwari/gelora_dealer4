geloraInventoryManagement
	.config(function($stateProvider, $urlRouterProvider) {

		$urlRouterProvider.otherwise('/index');

		$stateProvider
		.state('index', {
			url: '/index',
  			templateUrl: 'app/index/index.html',
  			controller: 'IndexController as ctrl',
  			requireLogin: false,
  			pageTitle: 'Dealer | Inventory Management'
		})

		.state('unitIndex', {
			url: '/unit/index',
  			templateUrl: 'app/unit/index/unitIndex.html',
  			controller: 'UnitIndexController as ctrl',
  			pageTitle: 'Dealer | Inventory Management | Daftar Unit'
		})

		.state('unitMove', {
			url: '/unit/move/:chasisNumber',
  			templateUrl: 'app/unit/move/unitMove.html',
  			controller: 'UnitMoveController as ctrl',
  			pageTitle: 'Dealer | Inventory Management | Perpindahan Unit'
		})
		.state('unitReception', {
			url: '/unit/reception/:locationId/:chasisNumber',
  			templateUrl: 'app/unit/reception/unitReception.html',
  			controller: 'UnitReceptionController as ctrl',
  			pageTitle: 'Dealer | Inventory Management | Penerimaan Unit'
		})
		.state('unitPdi', {
			url: '/unit/pdi/:chasisNumber',
  			templateUrl: 'app/unit/pdi/unitPdi.html',
  			controller: 'UnitPdiController as ctrl',
  			pageTitle: 'Dealer | Inventory Management | PDI Unit'
		})

		.state('locationIndex', {
			url: '/location/index',
  			templateUrl: 'app/location/index/locationIndex.html',
  			controller: 'LocationIndexController as ctrl',
  			pageTitle: 'Dealer | Inventory Management | Lokasi'
		})
		.state('locationShow', {
			url: '/location/show/:id',
  			templateUrl: 'app/location/show/locationShow.html',
  			controller: 'LocationShowController as ctrl',
  			pageTitle: 'Dealer | Inventory Management | Lokasi'
		})


		.state('movementOrderIndex', {
			url: '/movementOrder/index',
  			templateUrl: 'app/movementOrder/index/movementOrderIndex.html',
  			controller: 'MovementOrderIndexController as ctrl',
  			pageTitle: 'Dealer | Inventory Management | Perpindahan'
		})
		.state('movementOrderShow', {
			url: '/movementOrder/show/:id',
  			templateUrl: 'app/movementOrder/show/movementOrderShow.html',
  			controller: 'MovementOrderShowController as ctrl',
  			pageTitle: 'Dealer | Inventory Management | Perpindahan'
		})
	})