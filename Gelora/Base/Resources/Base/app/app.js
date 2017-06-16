var geloraBase = angular
        .module('Gelora.Base', ['ui.router', 'angular-jwt',
            'Solumax.Loading', 'Solumax.ErrorInterceptor', 'Solumax.JwtManager', 'Solumax.Setting',
            'Solumax.Pagination', 'Solumax.CsvUploader',
            'Solumax.TenantDatabaseConnection', 'Solumax.Entity', 'Solumax.PageTitle',
            'Gelora.BaseShared', 'Gelora.Vehicle.Shared'
        ])
        .factory('AppFactory', function () {

            var appFactory = {};

            appFactory.moduleId = '30000';

            return appFactory;
        })
        .run(function ($rootScope, $compile) {

            $rootScope.$on('$viewContentLoaded', function readyToTrick() {

                $('input[type=number]').each(function () {
                    $(this).attr('type', 'text')
                    $(this).attr('fcsa-number', '{ preventInvalidInput: true }')
                    $compile($(this))($rootScope)
                })
            });
        })