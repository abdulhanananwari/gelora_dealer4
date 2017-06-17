geloraDealerLeasingApp
	.controller('LeasingOrderIndexController', function(
		$state,
		LeasingOrderModel) {

		var vm = this

		LeasingOrderModel.index()
			.then(function(res) {
				vm.leasingOrders = res.data.data
				vm.meta = res.data.meta
			})

	})