var geloraDealerCreditSales = angular
        .module('Gelora.Dealer.CreditSales', ['ui.router', 'angular-jwt',
            'Solumax.Loading', 'Solumax.ErrorInterceptor', 'Solumax.JwtManager', 'Solumax.CsvUploader',
            'Solumax.TenantDatabaseConnection', 'Solumax.FileManager', 'Solumax.Entity', 'Solumax.PageTitle',
            'Solumax.Calculator', 'Solumax.Setting', 'Solumax.TransactionPlugins',
            'Gelora.BaseShared', 'Gelora.CreditSalesShared', 'Gelora.Vehicle.Shared'])
        .factory('AppFactory', function () {

            var appFactory = {};

            appFactory.moduleId = '30000';

            return appFactory;
        })