var geloraPolReg = angular
	.module('Gelora.PolReg', ['ui.router', 'angular-jwt',
		'Solumax.Loading', 'Solumax.ErrorInterceptor', 'Solumax.JwtManager', 'Solumax.CsvUploader',
		'Solumax.TenantDatabaseConnection', 'Solumax.FileManager', 'Solumax.Entity', 'Solumax.PageTitle',
		'Solumax.Calculator', 'Solumax.Setting', 'Solumax.Pagination',
		'Solumax.SmsPlugins', 'Gelora.BaseShared', 'Gelora.Vehicle.Shared', 'Gelora.PolRegShared'])
	.factory('AppFactory', function() {

		var appFactory = {};

		appFactory.moduleId = '30000';

		return appFactory;
	})