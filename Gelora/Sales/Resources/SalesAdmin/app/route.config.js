geloraSalesAdmin
	.config(function($stateProvider, $urlRouterProvider, $locationProvider) {

		$locationProvider.hashPrefix('');
		$urlRouterProvider.otherwise('/index');

		$stateProvider
		.state('index', {
			url: '/index',
  			templateUrl: 'app/index/index.html',
  			controller: 'IndexController as ctrl',
  			requireLogin: false,
  			pageTitle: 'Dealer | Sales Admin'
		})

		.state('salesOrderIndex', {
			url: '/salesOrder/index/:status',
  			templateUrl: 'app/salesOrder/index/salesOrderIndex.html',
  			controller: 'SalesOrderIndexController as ctrl',
  			pageTitle: 'Dealer | Sales Admin | Sales Order'
		})
		.state('salesOrderShow', {
			url: '/salesOrder/show/:id',
  			templateUrl: 'app/salesOrder/show/salesOrderShow.html',
  			controller: 'SalesOrderShowController as ctrl',
  			pageTitle: 'Dealer | Sales Admin | Sales Order'
		})
		.state('salesOrderShowFinancial', {
			url: '/salesOrder/showFinancial/:id',
  			templateUrl: 'app/salesOrder/showFinancial/salesOrderShowFinancial.html',
  			controller: 'SalesOrderShowFinancialController as ctrl',
  			pageTitle: 'Dealer | Sales Admin | Sales Order Financial'

		})
		.state('salesOrderShowCredit', {
			url: '/salesOrder/showCredit/:id',
  			templateUrl: 'app/salesOrder/showCredit/salesOrderShowCredit.html',
  			controller: 'SalesOrderShowCreditController as ctrl',
  			pageTitle: 'Dealer | Sales Admin | Sales Order Credit'

		})
		.state('salesOrderShowDelivery', {
			url: '/salesOrder/showDelivery/:id',
  			templateUrl: 'app/salesOrder/showDelivery/salesOrderShowDelivery.html',
  			controller: 'SalesOrderShowDeliveryController as ctrl',
  			pageTitle: 'Dealer | Sales Admin | Sales Order Delivery'

		})
		.state('salesOrderShowExtra', {
			url: '/salesOrder/showExtra/:id',
  			templateUrl: 'app/salesOrder/showExtra/salesOrderShowExtra.html',
  			controller: 'SalesOrderShowExtraController as ctrl',
  			pageTitle: 'Dealer | Sales Admin | Sales Order Financial'
		})
		.state('salesOrderShowApproval', {
			url: '/salesOrder/showApproval/:id',
  			templateUrl: 'app/salesOrder/showApproval/salesOrderShowApproval.html',
  			controller: 'SalesOrderShowApprovalController as ctrl',
  			pageTitle: 'Dealer | Sales Admin | Sales Order Financial'
		})
		.state('salesOrderShowRegistration', {
			url: '/salesOrder/showRegistration/:id',
  			templateUrl: 'app/salesOrder/showRegistration/salesOrderShowRegistration.html',
  			controller: 'SalesOrderShowRegistrationController as ctrl',
  			pageTitle: 'Dealer | Sales Admin | Sales Order Registrasi'
		})
		.state('salesOrderShowDocumentation', {
			url: '/salesOrder/showDocumentation/:id',
  			templateUrl: 'app/salesOrder/showDocumentation/salesOrderShowDocumentation.html',
  			controller: 'SalesOrderShowDocumentationController as ctrl',
  			pageTitle: 'Dealer | Sales Admin | Sales Order Dokumentasi'
		})
		.state('salesOrderReport', {
			url: '/salesOrder/report',
  			templateUrl: 'app/salesOrder/report/salesOrderReport.html',
  			controller: 'SalesOrderReportController as ctrl',
  			pageTitle: 'Dealer | Sales Admin | Sales Order Report'
		})
		.state('cancelledSalesOrderIndex', {
			url: '/cancelledSalesOrder/index',
  			templateUrl: 'app/cancelledSalesOrder/index/cancelledSalesOrderIndex.html',
  			controller: 'CancelledSalesOrderIndexController as ctrl',
  			pageTitle: 'Dealer | Sales Admin | Cancel Sales Order'
		})
		
		.state('prospectIndex', {
			url: '/prospect/index',
  			templateUrl: 'app/prospect/index/prospectIndex.html',
  			controller: 'ProspectIndexController as ctrl',
  			pageTitle: 'Dealer | Sales Admin | Prospect'
		})
	})