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

		.state('deliveryIndex', {
			url: '/delivery/index',
  			templateUrl: 'app/delivery/index/deliveryIndex.html',
  			controller: 'DeliveryIndexController as ctrl',
  			pageTitle: 'Dealer | Faktur'
		})


		.state('registrationShow', {
			url: '/registration/show/:id/:deliveryId',
  			templateUrl: 'app/registration/show/registrationShow.html',
  			controller: 'RegistrationShowController as ctrl',
  			pageTitle: 'Dealer | Faktur'
		})
		.state('registrationIndex', {
			url: '/registration/index/',
  			templateUrl: 'app/registration/index/registrationIndex.html',
  			controller: 'RegistrationIndexController as ctrl',
  			pageTitle: 'Dealer | Faktur'
		})

		.state('registrationMdSubmissionBatchIndex', {
			url: '/registrationMdSubmissionBatch/index',
  			templateUrl: 'app/registrationMdSubmissionBatch/index/registrationMdSubmissionBatchIndex.html',
  			controller: 'RegistrationMdSubmissionBatchIndexController as ctrl',
  			pageTitle: 'Dealer | Faktur'
		})
		.state('registrationMdSubmissionBatchShow', {
			url: '/registrationMdSubmissionBatch/show/:id',
  			templateUrl: 'app/registrationMdSubmissionBatch/show/registrationMdSubmissionBatchShow.html',
  			controller: 'RegistrationMdSubmissionBatchShowController as ctrl',
  			pageTitle: 'Dealer | Faktur'
		})
		
		.state('registrationAgencySubmissionBatchIndex', {
			url: '/registrationAgencySubmissionBatch/index',
  			templateUrl: 'app/registrationAgencySubmissionBatch/index/registrationAgencySubmissionBatchIndex.html',
  			controller: 'RegistrationAgencySubmissionBatchIndexController as ctrl',
  			pageTitle: 'Dealer | Faktur'
		})
		.state('registrationAgencySubmissionBatchShow', {
			url: '/registrationAgencySubmissionBatch/show/:id',
  			templateUrl: 'app/registrationAgencySubmissionBatch/show/registrationAgencySubmissionBatchShow.html',
  			controller: 'RegistrationAgencySubmissionBatchShowController as ctrl',
  			pageTitle: 'Dealer | Faktur'
		})

		
		.state('registrationAgencyInvoiceIndex', {
			url: '/registrationAgencyInvoice/index',
  			templateUrl: 'app/registrationAgencyInvoice/index/registrationAgencyInvoiceIndex.html',
  			controller: 'RegistrationAgencyInvoiceIndexController as ctrl',
  			pageTitle: 'Dealer | Faktur'
		})
		.state('registrationAgencyInvoiceShow', {
			url: '/registrationAgencyInvoice/show/:id',
  			templateUrl: 'app/registrationAgencyInvoice/show/registrationAgencyInvoiceShow.html',
  			controller: 'RegistrationAgencyInvoiceShowController as ctrl',
  			pageTitle: 'Dealer | Faktur'
		})

		.state('registrationLeasingBpkbSubmissionBatchIndex', {
			url: '/registrationLeasingBpkbSubmissionBatch/index',
  			templateUrl: 'app/registrationLeasingBpkbSubmissionBatch/index/registrationLeasingBpkbSubmissionBatchIndex.html',
  			controller: 'RegistrationLeasingBpkbSubmissionBatchIndexController as ctrl',
  			pageTitle: 'Dealer | Faktur'
		})
		.state('registrationLeasingBpkbSubmissionBatchShow', {
			url: '/registrationLeasingBpkbSubmissionBatch/show/:id',
  			templateUrl: 'app/registrationLeasingBpkbSubmissionBatch/show/registrationLeasingBpkbSubmissionBatchShow.html',
  			controller: 'RegistrationLeasingBpkbSubmissionBatchShowController as ctrl',
  			pageTitle: 'Dealer | Faktur'
		})
		.state('registrationReport', {
			url: '/registrationReport/',
  			templateUrl: 'app/registration/report/registrationReport.html',
  			controller: 'RegistrationReportController as ctrl',
  			pageTitle: 'Dealer | Report Faktur'
		})

		// .state('fakturDetailShow', {
		// 	url: '/fakturDetail/show/:id/:consignmentDetailId',
  // 			templateUrl: 'app/fakturDetail/show/fakturDetailShow.html',
  // 			controller: 'FakturDetailShowController as ctrl',
  // 			pageTitle: 'Dealer | Faktur'
		// })

		// .state('fakturHeaderIndex', {
		// 	url: '/fakturHeader/index',
  // 			templateUrl: 'app/fakturHeader/index/fakturHeaderIndex.html',
  // 			controller: 'FakturHeaderIndexController as ctrl',
  // 			pageTitle: 'Dealer | Faktur Batch'
		// })
		// .state('fakturHeaderShow', {
		// 	url: '/fakturHeader/show/:id',
  // 			templateUrl: 'app/fakturHeader/show/fakturHeaderShow.html',
  // 			controller: 'FakturHeaderShowController as ctrl',
  // 			pageTitle: 'Dealer | Faktur Batch Single'
		// })

	})