geloraDealerCreditSales
	.factory('LeasingProgramModel', function(
		$http,
		LinkFactory) {

		var leasingProgramModel = {}

		leasingProgramModel.index = function(params) {
			return $http.get(LinkFactory.dealer.creditSales.leasingProgram.base, {params: params})
		}

		leasingProgramModel.get = function(id) {
			return $http.get(LinkFactory.dealer.creditSales.leasingProgram.base + id)
		}

		leasingProgramModel.store = function(promo) {
			return $http.post(LinkFactory.dealer.creditSales.leasingProgram.base, promo)
		}

		leasingProgramModel.update = function(id, promo) {
			return $http.post(LinkFactory.dealer.creditSales.leasingProgram.base + id, promo)
		}

		return leasingProgramModel
	})