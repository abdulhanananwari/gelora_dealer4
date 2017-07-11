var geloraSalesAdmin = angular
    .module('Gelora.SalesAdmin', [
        'ui.router', 'angular-jwt',
        'Solumax.Loading', 'Solumax.ErrorInterceptor', 'Solumax.JwtManager', 'Solumax.Loading',
        'Solumax.TenantDatabaseConnection', 'Solumax.PageTitle', 'Solumax.Calculator', 'Solumax.Pagination',
        'Solumax.Messenger',
        'Solumax.Setting', 'Solumax.FileManager', 'Solumax.TransactionPlugins',
        'Gelora.CreditSalesShared',
        'Gelora.BaseShared', 'Gelora.SalesShared', 'Gelora.PolRegShared','Gelora.HumanResourceShared',
        'Gelora.Vehicle.Shared', 'Solumax.Entity', 'Solumax.LoggerPlugins'
    ])
    .factory('AppFactory', function() {

        var appFactory = {};

        appFactory.moduleId = '30000';
        appFactory.type = 'admin'

        return appFactory;
    })