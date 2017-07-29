geloraDealerCreditSales
	.controller('LeasingShowController', function(
		$state,
		LeasingModel) {

		var vm = this

		vm.leasing = {
			subLeasings: []
		}

		if ($state.params.id) {

			LeasingModel.get($state.params.id)
			.success(function(data) {
				vm.leasing = data.data
			})				
		}

		vm.store = function(leasing) {

			if (leasing.created_at) {

				LeasingModel.update(leasing.mainLeasing.id, leasing)
				.success(function(data) {
					
					vm.leasing = data.data
					alert('Data leasing berhasil diupdate')
				})

			} else {

				LeasingModel.store(leasing)
				.success(function(data) {

					$state.go('leasingShow', {id: data.data.mainLeasing.id})
				})
			}
		}

		vm.remove = function(subLeasing) {
			_.remove(vm.leasing.subLeasings, subLeasing)
		}

		vm.leasingPersonnel = {
			remove: function(personnel) {
				_.remove(vm.leasing.leasingPersonnels, personnel)
			}
		}
	})