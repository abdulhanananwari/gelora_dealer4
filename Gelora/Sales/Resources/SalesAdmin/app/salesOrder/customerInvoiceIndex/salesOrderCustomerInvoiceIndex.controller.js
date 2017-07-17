geloraSalesAdmin
	.controller('SalesOrderCustomerInvoiceIndexController', function(
		SalesOrderModel) {

		var vm = this

        var vm = this

        var presetFilter = {
            paginate: 20,
            customer_invoice_pending: true
        }

        vm.filter = _.clone(presetFilter)

        vm.load = function(filter, closeModal) {

            SalesOrderModel.index(filter)
                .then(function(res) {

                    vm.salesOrders = res.data.data
                    vm.meta = res.data.meta

                    if (closeModal) {
                        $('#spk-filter-modal').modal('hide')
                    }
                })

        }
        vm.load(vm.filter, false)

        vm.resetFilter = function() {
            vm.filter = _.clone(presetFilter)
        }
		
	})
