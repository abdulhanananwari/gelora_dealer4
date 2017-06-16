geloraPurchaseSimple
	.config(function($stateProvider, $urlRouterProvider) {

		$urlRouterProvider.otherwise('/index');

		$stateProvider
		.state('index', {
			url: '/index',
  			templateUrl: 'app/index/index.html',
  			controller: 'IndexController as ctrl',
  			requireLogin: false,
  			pageTitle: 'Dealer | Purchase Simple'
		})

		.state('deliveryNoteUpload', {
			url: '/deliveryNote/upload',
  			templateUrl: 'app/deliveryNote/upload/deliveryNoteUpload.html',
  			controller: 'DeliveryNoteUploadController as ctrl',
  			pageTitle: 'Dealer | Purchase Simple'
		})

		.state('unitShow', {
			url: '/unit/show/:id',
  			templateUrl: 'app/unit/show/unitShow.html',
  			controller: 'UnitShowController as ctrl',
  			pageTitle: 'Dealer | Unit | Show'
		})
		.state('unitCostOfGood', {
			url: '/unit/costOfGood',
  			templateUrl: 'app/unit/costOfGood/unitCostOfGood.html',
  			controller: 'UnitCostOfGoodController as ctrl',
  			pageTitle: 'Dealer | Unit | Cost Of Good'
		})
		.state('reportPurchase', {
			url: '/report/purchase',
  			templateUrl: 'app/report/purchase/reportPurchase.html',
  			controller: 'ReportPurchaseController as ctrl',
  			pageTitle: 'Dealer | Report | Purchase'
		})
		
		// .state('purchaseShow', {
		// 	url: '/purchase/show/:notaDebetId',
  // 			templateUrl: 'app/purchase/show/purchaseShow.html',
  // 			controller: 'PurchaseShowController as ctrl',
  // 			pageTitle: 'Dealer | Unit | Pembelian'
		// })
	})