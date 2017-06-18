geloraBaseShared
	.directive('dealerUnitBarcodeFinder', function(
		$sce, $http, $timeout,
		LinkFactory,
		UnitModel) {

		return {
			templateUrl: $sce.trustAsResourceUrl(LinkFactory.dealer.views.base.unitBarcodeFinder),
			restrict: 'E',
			scope: {
				androidScanUrl: '@',
				unit: "=",
				onFound: "&"
			},
			link: function(scope, elem, attrs) {

				scope.modalId = Math.random().toString(36).substring(2, 7)

				scope.scan = function() {
					console.log(scope.androidScanUrl)
					window.open('zxing://scan/?ret=' + encodeURIComponent(scope.androidScanUrl))
				}

				scope.findUnit = function(chasisNumber) {

		            UnitModel.index({chasis_number: chasisNumber})
		            .then(function (res) {

		            	scope.chasisNumber = null

		                if (res.data.data.length > 0) {

		                	if (typeof attrs.unit != 'undefined') {
		                		scope.unit = res.data.data[0]
		                		
								$timeout(function() {
									scope.onFound();
								}, 250);
		                	}


		                } else {
		                    alert('unit tidak ditemukan')
		                }
		            })
				}
			},
		}

	})
