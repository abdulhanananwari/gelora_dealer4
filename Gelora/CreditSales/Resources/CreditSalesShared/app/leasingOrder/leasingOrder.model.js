GeloraCreditSalesShared
	.factory('LeasingOrderModel', function(
		$http,
		LinkFactory) {

		var leasingOrderModel = {}
		leasingOrderModel.index = function(params) {
			return $http.get(LinkFactory.dealer.creditSales.leasingOrder.base, {params: params})
		}

		leasingOrderModel.get = function(id, params) {
			return $http.get(LinkFactory.dealer.creditSales.leasingOrder.base + id, {params: params})
		}

		leasingOrderModel.store = function(leasingOrder) {
			return $http.post(LinkFactory.dealer.creditSales.leasingOrder.base, leasingOrder)
		}

		leasingOrderModel.update = function(id, leasingOrder) {
			return $http.post(LinkFactory.dealer.creditSales.leasingOrder.base + id, leasingOrder)
		}
		
		leasingOrderModel.financial = {
			get: function(id, params) {
				return $http.get(LinkFactory.dealer.creditSales.leasingOrder.base + id + '/financial/' ,{params: params})
			},
			update: function(id, leasingOrder) {
				return $http.post(LinkFactory.dealer.creditSales.leasingOrder.base + id + '/financial/', leasingOrder)
			}
		}

		leasingOrderModel.salesOrder = {
			attach: function(id, salesOrder) {
				return $http.post(LinkFactory.dealer.creditSales.leasingOrder.base + id + '/sales-order/attach/', {sales_order_id: salesOrder.id})
			},
			detach: function(id) {
				return $http.post(LinkFactory.dealer.creditSales.leasingOrder.base + id + '/sales-order/detach/')
			}
		}

		leasingOrderModel.action = {
			validation : {
				validate: function(id) {
					return $http.post(LinkFactory.dealer.creditSales.leasingOrder.base + id + '/action/validation/validate/')
				},
				unvalidate: function(id) {
					return $http.post(LinkFactory.dealer.creditSales.leasingOrder.base + id + '/action/validation/unvalidate/')
				}
			},
			assign : {
				leasingProgram: function(id, leasingProgramId) {
					return $http.post(LinkFactory.dealer.creditSales.leasingOrder.base + id + '/action/assign/leasing-program/', {leasing_program_id: leasingProgramId})
				}
			}
						
		}
	
		return leasingOrderModel
	})