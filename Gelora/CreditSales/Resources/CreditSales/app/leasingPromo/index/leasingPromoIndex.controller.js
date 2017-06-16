geloraDealerCreditSales
	.controller('LeasingPromoIndexController', function(
		LeasingPromoModel) {

		var vm = this

		function load() {

			LeasingPromoModel.index()
			.success(function(data) {
				vm.leasings = data.data
			})
		}

		load()
	})