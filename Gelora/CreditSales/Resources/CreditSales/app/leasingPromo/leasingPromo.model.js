geloraDealerCreditSales
	.factory('LeasingPromoModel', function(
		$http,
		LinkFactory) {

		var leasingPromoModel = {}

		leasingPromoModel.index = function(params) {
			return $http.get(LinkFactory.dealer.creditSales.leasingPromo.base, {params: params})
		}

		leasingPromoModel.get = function(id) {
			return $http.get(LinkFactory.dealer.creditSales.leasingPromo.base + id)
		}

		leasingPromoModel.store = function(promo) {
			return $http.post(LinkFactory.dealer.creditSales.leasingPromo.base, promo)
		}

		leasingPromoModel.update = function(id, promo) {
			return $http.post(LinkFactory.dealer.creditSales.leasingPromo.base + id, promo)
		}

		return leasingPromoModel
	})