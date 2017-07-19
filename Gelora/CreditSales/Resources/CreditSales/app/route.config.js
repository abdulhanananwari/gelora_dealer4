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

		.state('leasingPersonnelShow', {
			url: '/leasingPersonnel/show/:id/:mainLeasingId',
  			templateUrl: 'app/leasingPersonnel/show/leasingPersonnelShow.html',
  			controller: 'LeasingPersonnelShowController as ctrl',
  			pageTitle: 'Dealer | Credit Sales | Leasing Personnel'
		})

		.state('leasingProgramShow', {
			url: '/leasingProgram/show/:id/:mainLeasingId',
  			templateUrl: 'app/leasingProgram/show/leasingProgramShow.html',
  			controller: 'LeasingProgramShowController as ctrl',
  			pageTitle: 'Dealer | Credit Sales | Leasing Program'
		})
		.state('leasingProgramIndex', {
			url: '/leasingProgram/index/',
  			templateUrl: 'app/leasingProgram/index/leasingProgramIndex.html',
  			controller: 'LeasingProgramIndexController as ctrl',
  			pageTitle: 'Dealer | Credit Sales | Leasing Program'
		})
		.state('leasingProgramUpload', {
			url: '/leasingProgram/upload/',
  			templateUrl: 'app/leasingProgram/upload/leasingProgramUpload.html',
  			controller: 'LeasingProgramUploadController as ctrl',
  			pageTitle: 'Dealer | Credit Sales | Leasing Program'
		})


		.state('leasingOrderShow', {
			url: '/leasingOrder/show/:id/:mainLeasingId/:salesOrderId',
  			templateUrl: 'app/leasingOrder/show/leasingOrderShow.html',
  			controller: 'LeasingOrderShowController as ctrl',
  			pageTitle: 'Dealer | Credit Sales | Leasing Order'
		})
		.state('leasingOrderShowFinancial', {
			url: '/leasingOrder/show/financial/:id',
  			templateUrl: 'app/leasingOrder/showFinancial/leasingOrderShowFinancial.html',
  			controller: 'LeasingOrderShowFinancialController as ctrl',
  			pageTitle: 'Dealer | Credit Sales | Leasing Order Financial'
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