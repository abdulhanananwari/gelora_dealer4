geloraDealerCreditSales
	.controller('LeasingOrderShowFinancialController', function(
		$state,
		LeasingModel,ConfigModel,
		LeasingOrderModel) {

		var vm = this

		vm._ = _

		ConfigModel.get('gelora.creditSales.dueDateTypes')
		.then(function(res){
			vm.dueDayTypes = res.data.data
		})

		ConfigModel.get('gelora.humanResource.availablePositions')
		.then(function(res) {
			vm.availablePositions = res.data.data
		})
		
		if ($state.params.id) {

			LeasingOrderModel.financial.get($state.params.id)
			.then(function(res) {
				vm.leasingOrder = res.data.data

				if (_.isNull(vm.leasingOrder.financial)) {
					vm.leasingOrder.financial = {
						joinPromos:[]
					}
				}
			})
		}

		
		vm.update = function(leasingOrder) {

			LeasingOrderModel.financial.update(leasingOrder.id, leasingOrder)
			.then(function(res) {
				alert('Berhasil di update')
			})
		}
})