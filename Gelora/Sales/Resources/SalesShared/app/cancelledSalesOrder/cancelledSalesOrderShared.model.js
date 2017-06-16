geloraSalesShared
	.factory('CancelledSalesOrderSharedModel', function(
		$http,
		LinkFactory) {

		var cancelledSalesOrderShared = []

		cancelledSalesOrderShared.index = function(params) {
			return $http.get(LinkFactory.dealer.sales.cancelledSalesOrder.base, {params: params})
		}

		cancelledSalesOrderShared.get = function(id, params) {
			return $http.get(LinkFactory.dealer.sales.cancelledSalesOrder.base + id, {params: params})
		}

		cancelledSalesOrderShared.store = function(cancelledSalesOrder) {

			return $http.post(LinkFactory.dealer.sales.cancelledSalesOrder.base, cancelledSalesOrder)
		}
		cancelledSalesOrderShared.restore = function(id, cancelledSalesOrder) {

			return $http.post(LinkFactory.dealer.sales.cancelledSalesOrder.base  + id + '/restore/', cancelledSalesOrder)
		}

		cancelledSalesOrderShared.update = function(id, cancelledSalesOrder) {
			return $http.post(LinkFactory.dealer.sales.cancelledSalesOrder.base + id, cancelledSalesOrder)
		}

		
		return cancelledSalesOrderShared
	})