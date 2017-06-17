GeloraCreditSalesShared
	.factory('LeasingModel', function(
		$http,
		LinkFactory) {

		var leasingModel = {}

		leasingModel.index = function(params) {
			return $http.get(LinkFactory.dealer.creditSales.leasing.base, {params: params})
		}

		leasingModel.get = function(mainLeasingId) {
			return $http.get(LinkFactory.dealer.creditSales.leasing.base + mainLeasingId)
		}

		leasingModel.store = function(leasing) {
			return $http.post(LinkFactory.dealer.creditSales.leasing.base, leasing)
		}

		leasingModel.update = function(mainLeasingId, leasing) {
			return $http.post(LinkFactory.dealer.creditSales.leasing.base + mainLeasingId, leasing)
		}

		return leasingModel
	})