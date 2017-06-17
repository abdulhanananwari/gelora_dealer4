var geloraDealerCreditSales = angular
        .module('Gelora.Dealer.CreditSales', ['ui.router', 'angular-jwt', 'Solumax.Entity',
            'Solumax.Loading', 'Solumax.ErrorInterceptor', 'Solumax.JwtManager', 'Solumax.CsvUploader',
            'Solumax.TenantDatabaseConnection', 'Solumax.FileManager', 'Solumax.PageTitle',
            'Solumax.Calculator', 'Solumax.Setting', 'Solumax.AccountPlugin',
            'Gelora.BaseShared', 'Gelora.CreditSalesShared', 'Gelora.Vehicle.Shared'])
        .factory('AppFactory', function () {

            var appFactory = {};

            appFactory.moduleId = '30000';

            return appFactory;
        })