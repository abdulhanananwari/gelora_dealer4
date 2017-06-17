geloraDealerLeasingApp
	.controller('LeasingOrderShowController', function(
		$state,
		LeasingOrderModel) {

		var vm = this

		if ($state.params.id) {
			
			LeasingOrderModel.get($state.params.id)
				.then(function(res) {
					vm.leasingOrder = res.data.data
				})
		}

		vm.store = function(leasingOrder) {

			if (leasingOrder.id) {

				LeasingOrderModel.update(leasingOrder.id, leasingOrder)
					.then(function(res) {
						vm.leasingOrder = res.data.data
						alert('PO berhasil diupdate')
					})

			} else {

				LeasingOrderModel.store(leasingOrder)
					.then(function(res) {
						vm.leasingOrder = res.data.data
						alert('PO berhasil disimpan')
					})
					
			}
		}
	})