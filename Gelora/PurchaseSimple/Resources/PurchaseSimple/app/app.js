var geloraPurchaseSimple = angular
	.module('Gelora.PurchaseSimple', ['ui.router', 'angular-jwt',
		'Solumax.ErrorInterceptor', 'Solumax.JwtManager', 'Solumax.TenantDatabaseConnection',
		'Solumax.PageTitle', 'Solumax.CsvUploader', 'Solumax.Setting',
		'Gelora.BaseShared', 'Gelora.Vehicle.Shared'])
	.factory('AppFactory', function() {

		var appFactory = {};

		appFactory.moduleId = '30000';
		localStorage.setItem('module_id', appFactory.moduleId)

		return appFactory;
	})