geloraBaseShared
    .directive('dealerLocationFinder', function(
        $sce, $http, $timeout,
        LinkFactory,
        LocationModel) {

        return {
            templateUrl: $sce.trustAsResourceUrl(LinkFactory.dealer.views.base.locationFinder),
            restrict: 'E',
            scope: {
                location: "=",
                onLocationSelected: "&"
            },
            link: function(scope, elem, attrs) {

                scope.modalId = Math.random().toString(36).substring(2, 7)

                LocationModel.index({ active: true })
                    .then(function(res) {
                        scope.locations = res.data.data
                    })

                scope.select = function(location) {

                    scope.location = location;
                    $timeout(function() {
                        scope.onLocationSelected();
                    }, 250);

                }

            },
        }

    })
