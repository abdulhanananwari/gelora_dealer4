geloraDealerCreditSales
	.controller('LeasingIndexController', function(
		LeasingModel) {

		var vm = this

		function load() {

			LeasingModel.index()
			.success(function(data) {
				vm.leasings = data.data
			})
		}

		load()
	})