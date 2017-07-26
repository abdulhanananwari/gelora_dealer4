geloraPurchaseSimple
	.controller('UnitCostOfGoodController', function(
		UnitModel) {

		var vm = this

		vm.params = {
			cost_of_good: 'null'
		}

		vm.load = function(page) {
			
			if (page) {
				vm.params.page = page
			}

			UnitModel.index(vm.params)
			.then(function(res) {
				vm.units = res.data.data
				vm.meta = res.data.meta
			})
		}
		vm.load(1)

		vm.store = function(unit) {

			UnitModel.assign.costOfGood(unit.id, unit.cost_of_good)
			.then(function(res) {
				unit = res.data.data
				alert('Harga beli berhasil diupdate')
			})
		}

		vm.calculateTotal = function() {
			vm.total = _.sumBy(vm.units, 'cost_of_good')
		}

	})