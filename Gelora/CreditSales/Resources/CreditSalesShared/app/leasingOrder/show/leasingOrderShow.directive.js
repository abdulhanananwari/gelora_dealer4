GeloraCreditSalesShared
    .directive('leasingOrderShow', function(
        $timeout) {

        return {
            templateUrl: '/gelora/credit-sales-shared/app/leasingOrder/show/leasingOrderShow.html',
            restrict: 'E',
            scope: {
                leasingOrder: '=',
                onStore: '&'
            },
            link: function(scope, elem, attrs) {
            }
        };
    });
