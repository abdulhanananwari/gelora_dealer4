geloraSalesShared
	.factory('SalesOrderExtraSharedModel', function(
		$http,
		LinkFactory) {

		var salesOrderExtraShared = []

		salesOrderExtraShared.index = function(params) {
			return $http.get(LinkFactory.dealer.sales.salesOrderExtra.base, {params: params})
		}

		salesOrderExtraShared.get = function(id, params) {
			return $http.get(LinkFactory.dealer.sales.salesOrderExtra.base + id, {params: params})
		}

		salesOrderExtraShared.store = function(salesOrder) {
			return $http.post(LinkFactory.dealer.sales.salesOrderExtra.base, salesOrder)
		}

		salesOrderExtraShared.update = function(id, salesOrder) {
			return $http.post(LinkFactory.dealer.sales.salesOrderExtra.base + id, salesOrder)
		}

		salesOrderExtraShared.delete = function(id) {
			return $http.delete(LinkFactory.dealer.sales.salesOrderExtra.base + id)
		}

		salesOrderExtraShared.attach = {
			selectedLeasingOrder: function(id, leasingOrder) {
				return $http.post(LinkFactory.dealer.sales.salesOrderExtra.base + 'attach/selected-leasing-order/' + id, {leasing_order_id: leasingOrder.id})
			}
		}

		return salesOrderExtraShared
	})