geloraSalesShared
        .directive('salesOrderNavbar', function (
                $state) {

            return {
                templateUrl: '/gelora/sales-shared/app/salesOrder/directives/navbar/salesOrderNavbar.html',
                scope: {
                    salesOrder: '='
                },
                link: function (scope, element, attrs) {

                    scope.currentStateName = $state.current.anme

                }
            }
        })