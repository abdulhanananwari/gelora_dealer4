geloraDelivery
	.controller('DeliveryIndexController', function(
		$state,
		SalesOrderModel) {

		var vm = this

		vm.statuses = {
			'on_progress': 'Dalam proses',
			'completed_successfully': 'Selesai',
			'cancelled': 'Pengiriman Dibatalkan',
			'all': 'Semua'
		}

		vm.load = function() {

			SalesOrderModel.index(vm.filter)
			.then(function(res) {
				vm.salesOrders= res.data.data
				vm.meta = res.data.meta

				// _.each(vm.deliveries, function(delivery) {
				// 	delivery.salesOrder = delivery.salesOrder.data

				// 	if (delivery.deliveryBatch) {
				// 		delivery.deliveryBatch = delivery.deliveryBatch.data
				// 	}
				// })
			})
		}
		
		if ($state.params.params) {
			vm.filter = JSON.parse($state.params.params)
		} else {
			vm.filter = {}
		}

		//vm.filter.with = 'deliveryBatch'
		vm.filter.paginate = 15
		vm.load()
})