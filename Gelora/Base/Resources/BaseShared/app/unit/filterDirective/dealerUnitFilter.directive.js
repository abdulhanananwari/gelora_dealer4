geloraBaseShared
	.directive('dealerUnitFilter', function(
		$sce, $http, $timeout,
		LinkFactory,
		UnitModel) {

		return {
			templateUrl: $sce.trustAsResourceUrl(LinkFactory.dealer.views.base.unitFilter),
			restrict: 'E',
			scope: {
				units: "=",
				meta: "=",
				additionalParams: "=",
				onRun: "&"
			},
			link: function(scope, elem, attrs) {

				scope.modalId = Math.random().toString(36).substring(2, 7)

				scope.filter = {
					page: 1,
					paginate: 10,
					with: 'currentLocation'
				}

				scope.search = function(filter) {

					_.merge(filter, scope.additionalParams)

					UnitModel.index(filter)
					.then(function(res) {
						scope.units = res.data.data
						scope.meta = res.data.meta
					})
				}
			},
		}

	})
