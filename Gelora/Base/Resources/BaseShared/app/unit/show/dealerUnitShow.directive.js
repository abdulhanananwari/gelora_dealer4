geloraBaseShared
    .directive('dealerUnitShow', function(
        $sce,
        LinkFactory,
        UnitModel) {

        return {
            templateUrl: $sce.trustAsResourceUrl(LinkFactory.dealer.views.base.unitShow),
            restrict: 'E',
            scope: {
                innerUnit: "=unit",
                unitId: "@"
            },
            link: function(scope, elem, attrs) {

                attrs.$observe('unitId', function(newValue) {
                    if (typeof newValue != 'undefined') {
                        UnitModel.get(newValue)
                            .then(function(res) {
                                scope.unit = res.data.data
                            })
                    }
                })

                scope.$watch('innerUnit', function(newValue) {
                    if (typeof newValue != 'undefined') {
                        scope.unit = newValue
                    }
                })

            }
        }

    })
