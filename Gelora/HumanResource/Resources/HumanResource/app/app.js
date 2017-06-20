var geloraHumanResource = angular
	.module('GeloraHumanResource', ['ui.router', 'angular-jwt',
		'Solumax.Loading', 'Solumax.ErrorInterceptor', 'Solumax.JwtManager',
		'Solumax.TenantDatabaseConnection', 'Solumax.PageTitle',
		'Gelora.BaseShared', 'Solumax.AccountPlugin',
		'Solumax.Setting', 'Solumax.Entity'])
	.factory('AppFactory', function() {

		var appFactory = {};

		appFactory.moduleId = '30000';

		return appFactory;
	})