 geloraDealerCreditSales
	.controller('LeasingPromoShowController', function(
		$state,
		LeasingPromoModel,LeasingModel) {

		var vm = this

		$('.date').datepicker({ dateFormat: "yy-mm-dd" })
		

		vm.leasingPromo = {
			main_leasing_id: $state.params.mainLeasingId,
			allowed_models: [],
			disallowed_models: [],
			allowed_sub_leasing_entity_ids:{}
		}

		LeasingModel.get($state.params.mainLeasingId)
		.success(function(data){
			vm.leasing = data.data
			formatAllowedSubLeasings()
		})

		if ($state.params.id) {

			LeasingPromoModel.get($state.params.id)
			.success(function(data) {
				vm.leasingPromo = data.data
				formatAllowedSubLeasings()
			})

		} else if ($state.params.mainLeasingId) {

			vm.leasingPromo.main_leasing_id = $state.params.mainLeasingId

		}

		vm.calculate = function() {

			 vm.leasingPromo.nett_receivable = 	vm.leasingPromo.dpp + vm.leasingPromo.ppn - vm.leasingPromo.pph23 + vm.leasingPromo.others;
		}

		vm.removeAllowed = function(allowed_models) {
			_.remove(vm.leasingPromo.allowed_models, allowed_models);
		}
		vm.removeDisallowed = function(disallowed_models) {
			_.remove(vm.leasingPromo.disallowed_models, disallowed_models);
		}

		vm.toggleSelection = function(subLeasing) {

			_.remove(vm.leasingPromo.allowed_sub_leasing_entity_ids, function(n) {
				return n == subLeasing.id
			})

			if (subLeasing.check) {

				vm.leasingPromo.allowed_sub_leasing_entity_ids.push(subLeasing.id)
			}
		}
		
		function formatAllowedSubLeasings() {

			_.each(vm.leasingPromo.allowed_sub_leasing_entity_ids, function(id) {
					
				try {
				
					_.find(vm.leasing.sub_leasings, function(subLeasing) {
						return subLeasing.id == id;
					}).check = true
				
				} catch (err) {}

			})

		}

		vm.store = function(leasingPromo) {

			if (leasingPromo.id) {

				LeasingPromoModel.update(leasingPromo.id, leasingPromo)
				.success(function(data) {
					vm.leasingPromo = data.data
					formatAllowedSubLeasings()
				})

			} else {
				
				LeasingPromoModel.store(leasingPromo)
				.success(function(data) {
					$state.go('leasingPromoShow', {id: data.data.id})
					vm.leasingPromo = data.data
				})
			}
		}

		
	})