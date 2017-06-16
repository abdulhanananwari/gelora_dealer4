GeloraCreditSalesShared
	.directive('leasingSelector', function($http, $timeout) {

		return {
			templateUrl: '/gelora/credit-sales-shared/app/leasing/selector/leasingSelector.html',
			restrict: 'E',
			scope: {
				selectedMainLeasing: "=",
				selectedSubLeasing: "=",
				onLeasingSelected: "&",
				forceSubLeasing: "@"
			},
			link: function(scope, elem, attrs) {

				$http.get('/credit-sales/api/leasing/')
				.then(function(res) {
					scope.leasings = res.data.data
				})

				scope.select = function(mainLeasing, subLeasing) {
					
					if (scope.forceSubLeasing) {
						if (typeof subLeasing == "undefined" || subLeasing == null) {
							alert('Cabang harus dipilih')
							return
						}
					}

					scope.selectedMainLeasing = mainLeasing
					scope.selectedSubLeasing = subLeasing

					$timeout(function() {
						scope.onLeasingSelected();
					}, 250);
				}

			}
		};
	});