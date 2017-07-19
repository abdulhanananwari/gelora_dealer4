GeloraCreditSalesShared
	.factory('LeasingInvoiceBatchModel', function(
		$http,
		LinkFactory) {

		var leasingInvoiceBatchModel = {}

		leasingInvoiceBatchModel.index = function(params) {
			return $http.get(LinkFactory.dealer.creditSales.leasingInvoiceBatch.base, {params: params})
		}

		leasingInvoiceBatchModel.get = function(id, params) {
			return $http.get(LinkFactory.dealer.creditSales.leasingInvoiceBatch.base + id, {params: params})
		}

		leasingInvoiceBatchModel.store = function(leasingInvoiceBatch, params) {
			return $http.post(LinkFactory.dealer.creditSales.leasingInvoiceBatch.base, leasingInvoiceBatch, {params: params})
		}

		leasingInvoiceBatchModel.update = function(id, leasingInvoiceBatch, params) {
			return $http.post(LinkFactory.dealer.creditSales.leasingInvoiceBatch.base + id, leasingInvoiceBatch, {params: params})
		}
		leasingInvoiceBatchModel.close = function(id, leasingInvoiceBatch, params) {
			return $http.post(LinkFactory.dealer.creditSales.leasingInvoiceBatch.base + id + '/close/', leasingInvoiceBatch, {params: params})
		}
		return leasingInvoiceBatchModel
	})