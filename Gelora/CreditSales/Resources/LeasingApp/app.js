var geloraDealerLeasingApp = angular
	.module('Gelora.Dealer.LeasingApp', ['ui.router', 'angular-jwt',
		'Solumax.Loading', 'Solumax.ErrorInterceptor', 'Solumax.JwtManager',
		'Solumax.TenantDatabaseConnection', 'Solumax.FileManager', 'Solumax.PageTitle',
		'Gelora.CreditSalesShared','Gelora.Vehicle.Shared'])
	.factory('AppFactory', function() {

		var appFactory = {};

		appFactory.moduleId = '30010';

		return appFactory;
	})