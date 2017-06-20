var geloraInventoryManagement = angular
    .module('Gelora.InventoryManagement', [
        'ui.router', 'angular-jwt',
        'Solumax.Loading', 'Solumax.ErrorInterceptor', 'Solumax.JwtManager',
        'Solumax.TenantDatabaseConnection', 'Solumax.Entity', 'Solumax.PageTitle',
        'Solumax.FileManager', 'Solumax.Setting', 'Solumax.Pagination',
        'Gelora.BaseShared', 'Gelora.Vehicle.Shared'
    ])
    .factory('AppFactory', function() {

        var appFactory = {};

        appFactory.moduleId = '30000';
        localStorage.setItem('module_id', appFactory.moduleId)

        return appFactory;
    })
