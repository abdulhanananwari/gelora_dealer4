geloraDealerCreditSales
	.factory('LeasingPersonnelModel', function(
		$http,
		LinkFactory) {

		var leasingPersonnelModel = {}

		leasingPersonnelModel.index = function(params) {
			return $http.get(LinkFactory.dealer.creditSales.leasingPersonnel.base, {params: params})
		}

		leasingPersonnelModel.get = function(id) {
			return $http.get(LinkFactory.dealer.creditSales.leasingPersonnel.base + id)
		}

		leasingPersonnelModel.store = function(leasingPersonnel) {
			return $http.post(LinkFactory.dealer.creditSales.leasingPersonnel.base, leasingPersonnel)
		}

		leasingPersonnelModel.update = function(id, leasingPersonnel) {
			return $http.post(LinkFactory.dealer.creditSales.leasingPersonnel.base + id, leasingPersonnel)
		}

		leasingPersonnelModel.delete = function(id) {
			return $http.delete(LinkFactory.dealer.creditSales.leasingPersonnel.base + id)
		}

		return leasingPersonnelModel
	})