geloraDealerCreditSales
	.config(function($stateProvider, $urlRouterProvider) {

		$urlRouterProvider.otherwise('/index');

		$stateProvider
		.state('index', {
			url: '/index',
  			templateUrl: 'app/index/index.html',
  			controller: 'IndexController as ctrl',
  			requireLogin: false,
  			pageTitle: 'Dealer | Credit Sales'
		})

		.state('leasingIndex', {
			url: '/leasing/index',
  			templateUrl: 'app/leasing/index/leasingIndex.html',
  			controller: 'LeasingIndexController as ctrl',
  			pageTitle: 'Dealer | Credit Sales | Leasing'
		})
		.state('leasingShow', {
			url: '/leasing/show/:id',
  			templateUrl: 'app/leasing/show/leasingShow.html',
  			controller: 'LeasingShowController as ctrl',
  			pageTitle: 'Dealer | Credit Sales | Leasing'
		})

		.state('leasingOrderShow', {
			url: '/leasingOrder/show/:id/:mainLeasingId/:salesOrderId',
  			templateUrl: 'app/leasingOrder/show/leasingOrderShow.html',
  			controller: 'LeasingOrderShowController as ctrl',
  			pageTitle: 'Dealer | Credit Sales | Leasing Order'
		})
		.state('leasingOrderIndex', {
			url: '/leasingOrder/index/:id/:mainLeasingId',
  			templateUrl: 'app/leasingOrder/index/leasingOrderIndex.html',
  			controller: 'LeasingOrderIndexController as ctrl',
  			pageTitle: 'Dealer | Credit Sales | Leasing Order'
		})

		.state('leasingInvoiceBatchIndex', {
			url: '/leasingInvoiceBatch/index/',
  			templateUrl: 'app/leasingInvoiceBatch/index/leasingInvoiceBatchIndex.html',
  			controller: 'LeasingInvoiceBatchIndexController as ctrl',
  			pageTitle: 'Dealer | Credit Sales | Leasing Invoice Batch'
		})
		.state('leasingInvoiceBatchShow', {
			url: '/leasingInvoiceBatch/show/:id',
  			templateUrl: 'app/leasingInvoiceBatch/show/leasingInvoiceBatchShow.html',
  			controller: 'LeasingInvoiceBatchShowController as ctrl',
  			pageTitle: 'Dealer | Credit Sales | Leasing Invoice Batch'
		})

		.state('leasingOrderReport', {
			url: '/leasingOrder/report/',
  			templateUrl: 'app/leasingOrder/report/leasingOrderReport.html',
  			controller: 'LeasingOrderReportController as ctrl',
  			pageTitle: 'Dealer | Credit Sales | Report'
		})
	})