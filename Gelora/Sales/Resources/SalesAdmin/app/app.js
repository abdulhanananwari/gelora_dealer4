var geloraSalesAdmin = angular
    .module('Gelora.SalesAdmin', [
        'ui.router', 'angular-jwt',
        'Solumax.Loading', 'Solumax.ErrorInterceptor', 'Solumax.JwtManager',
        'Solumax.TenantDatabaseConnection', 'Solumax.PageTitle', 'Solumax.Calculator', 'Solumax.Pagination',
        'Solumax.Setting', 'Solumax.FileManager', 'Gelora.CreditSalesShared', 'Solumax.TransactionPlugins',
        'Gelora.BaseShared', 'Gelora.SalesShared',
        // 'Gelora.HumanResourceShared',
        'Gelora.Vehicle.Shared', 'Solumax.Entity' 
    ])
    .factory('AppFactory', function() {

        var appFactory = {};

        appFactory.moduleId = '30000';

        return appFactory;
    })
    .run(function(
        $rootScope, $compile) {

        $rootScope.$on('$viewContentLoaded', function readyToTrick() {

            $('input[type=number]').each(function() {
                $(this).attr('type', 'text')
                $(this).attr('fcsa-number', '{ preventInvalidInput: true }')
                $compile($(this))($rootScope)
            })
        });
    })
