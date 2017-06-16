geloraDealerCreditSales
	.controller('LeasingProgramShowController', function(
		$state,
		LeasingModel, LeasingProgramModel, ModelModel) {

		var vm = this

		ModelModel.index({current: true})
		.success(function(data) {
			vm.modelCategories = _.uniq(_.map(data.data, 'category'))
		})

		vm.store = function(leasingProgram) {

			if (leasingProgram.id) {

				LeasingProgramModel.update(leasingProgram.id, leasingProgram)
				.success(function(data) {
					vm.leasingProgram = data.data
					alert('Leasing program berhasil diupdate')
				})

			} else {

				LeasingProgramModel.store(leasingProgram)
				.success(function(data) {
					alert('Leasing program berhasil disimpan')
					$state.go('leasingProgramShow', {id: data.data.id})
				})
			}

		}

		vm.removeProgram = function(program) {

			if (confirm('Yakin mau hapus program ini?')) {

				_.remove(vm.leasingProgram.programs, program)
			}
		}
		vm.addVehicle = function(vehicle){
			vm.leasingProgram.vehicle.push(_.pick(vehicle, ['id','name','code']));
		}
		vm.removeVehicle = function(model){
			_.remove(vm.leasingProgram.vehicle, model)
		}
		if ($state.params.id) {

			LeasingProgramModel.get($state.params.id)
			.success(function(data) {
				vm.leasingProgram = data.data
			})

		} else if ($state.params.mainLeasingId) {

			LeasingModel.get($state.params.mainLeasingId)
			.then(function(res) {
				
				vm.leasingProgram = {
					programs: [],
					vehicle: [],
					leasing: res.data.data
				}
			})
		}

	})