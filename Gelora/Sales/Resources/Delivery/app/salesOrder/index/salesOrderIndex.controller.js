geloraDelivery
	.controller('SalesOrderIndexController', function(
		SalesOrderExtraSharedModel, SalesOrderModel) {

		var vm = this

		vm.salesOrderPendingDelivery = []
		vm.salesOrderNeedRevalidation = []

		var params = {
			delivery: 'null',
		}


		SalesOrderModel.index(params)
		.then(function(res) {


			_.each(res.data.data, function(salesOrder) {

				
				if ( moment(salesOrder.validated_at).isAfter( moment().startOf('day') ) ) {
					vm.salesOrderPendingDelivery.push(salesOrder)
				} else {
					vm.salesOrderNeedRevalidation.push(salesOrder)
				}
			})
		})
	})