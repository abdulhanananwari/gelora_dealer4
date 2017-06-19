geloraPolReg
	.config(function($stateProvider, $urlRouterProvider) {

		$urlRouterProvider.otherwise('/index');

		$stateProvider
		.state('index', {
			url: '/index',
  			templateUrl: 'app/index/index.html',
  			controller: 'IndexController as ctrl',
  			requireLogin: false,
  			pageTitle: 'Dealer | Faktur'
		})

		.state('mdSubmissionBatchIndex', {
			url: '/mdSubmissionBatch/index',
  			templateUrl: 'app/mdSubmissionBatch/index/mdSubmissionBatchIndex.html',
  			controller: 'MdSubmissionBatchIndexController as ctrl',
  			pageTitle: 'Dealer | Faktur'
		})
		.state('mdSubmissionBatchShow', {
			url: '/mdSubmissionBatch/show/:id',
  			templateUrl: 'app/mdSubmissionBatch/show/mdSubmissionBatchShow.html',
  			controller: 'MdSubmissionBatchShowController as ctrl',
  			pageTitle: 'Dealer | Faktur'
		})
		
		.state('agencySubmissionBatchIndex', {
			url: '/agencySubmissionBatch/index',
  			templateUrl: 'app/agencySubmissionBatch/index/agencySubmissionBatchIndex.html',
  			controller: 'AgencySubmissionBatchIndexController as ctrl',
  			pageTitle: 'Dealer | Faktur'
		})
		.state('agencySubmissionBatchShow', {
			url: '/agencySubmissionBatch/show/:id',
  			templateUrl: 'app/agencySubmissionBatch/show/agencySubmissionBatchShow.html',
  			controller: 'AgencySubmissionBatchShowController as ctrl',
  			pageTitle: 'Dealer | Faktur'
		})

		
		.state('agencyInvoiceIndex', {
			url: '/agencyInvoice/index',
  			templateUrl: 'app/agencyInvoice/index/agencyInvoiceIndex.html',
  			controller: 'AgencyInvoiceIndexController as ctrl',
  			pageTitle: 'Dealer | Faktur'
		})
		.state('agencyInvoiceShow', {
			url: '/agencyInvoice/show/:id',
  			templateUrl: 'app/agencyInvoice/show/agencyInvoiceShow.html',
  			controller: 'AgencyInvoiceShowController as ctrl',
  			pageTitle: 'Dealer | Faktur'
		})

		.state('leasingBpkbSubmissionBatchIndex', {
			url: '/leasingBpkbSubmissionBatch/index',
  			templateUrl: 'app/leasingBpkbSubmissionBatch/index/leasingBpkbSubmissionBatchIndex.html',
  			controller: 'LeasingBpkbSubmissionBatchIndexController as ctrl',
  			pageTitle: 'Dealer | Faktur'
		})
		.state('leasingBpkbSubmissionBatchShow', {
			url: '/leasingBpkbSubmissionBatch/show/:id',
  			templateUrl: 'app/leasingBpkbSubmissionBatch/show/leasingBpkbSubmissionBatchShow.html',
  			controller: 'LeasingBpkbSubmissionBatchShowController as ctrl',
  			pageTitle: 'Dealer | Faktur'
		})
		
		.state('Report', {
			url: '/Report/',
  			templateUrl: 'app//report/Report.html',
  			controller: 'RegistrationReportController as ctrl',
  			pageTitle: 'Dealer | Report Faktur'
		})

	})