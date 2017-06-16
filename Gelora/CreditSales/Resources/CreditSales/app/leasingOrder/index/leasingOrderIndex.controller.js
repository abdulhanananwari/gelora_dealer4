geloraDealerCreditSales
	.controller('LeasingOrderIndexController', function(
		LeasingOrderModel) {

		var vm = this

		vm.filter = {}

		vm.pendingInvoiceGenerateFilter = {
			validated: 'true',
			unit_delivered: 'true',
			invoice_generated: 'false',
		}

		vm.assignFilter = function(filter) {

			_.each(filter, function(val, key) {
				vm.filter[key] = val
			})
		}

		vm.load = function(filter) {

			$('#leasing-order-filter-modal').modal('hide')
			
			LeasingOrderModel.index(filter)
			.then(function(res) {
				vm.leasingOrders = res.data.data
			})
		}
		vm.load()


	})