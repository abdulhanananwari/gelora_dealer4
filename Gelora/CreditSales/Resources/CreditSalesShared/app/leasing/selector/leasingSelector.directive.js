GeloraCreditSalesShared
    .directive('leasingSelector', function(
        $timeout,
        LeasingModel) {

        return {
            templateUrl: '/gelora/credit-sales-shared/app/leasing/selector/leasingSelector.html',
            restrict: 'E',
            scope: {
                selectedMainLeasing: "=",
                selectedSubLeasing: "=",
                onLeasingSelected: "&"
            },
            link: function(scope, elem, attrs) {

                LeasingModel.index()
                    .then(function(res) {
                        scope.leasings = res.data.data
                    })

                scope.select = function(mainLeasing, subLeasing) {

                    scope.selectedMainLeasing = mainLeasing
                    scope.selectedSubLeasing = subLeasing

                    $timeout(function() {
                        scope.onLeasingSelected();
                    }, 250);
                }

            }
        };
    });
