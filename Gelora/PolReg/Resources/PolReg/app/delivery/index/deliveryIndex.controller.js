geloraPolReg
	.controller('DeliveryIndexController', function(
		$state,
		DeliveryModel) {

		var vm = this


		DeliveryModel.index({status: 'completed_successfully', registration_id: 'null', with: 'registrations'})
		.success(function(data) {

			vm.deliveries = data.data

			_.each(vm.deliveries, function(delivery) {

				delivery.unit = delivery.unit.data

				delivery.registrations = delivery.registrations.data

				_.each(delivery.registrations, function(registration) {
					registration = registration.data
				})

				delivery.salesOrder = delivery.salesOrder.data
			})
		})
	})