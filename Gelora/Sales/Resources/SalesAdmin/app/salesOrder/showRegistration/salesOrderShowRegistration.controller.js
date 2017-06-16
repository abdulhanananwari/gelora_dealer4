geloraSalesAdmin
	.controller('SalesOrderShowRegistrationController', function(
		$state,RegistrationModel,
		SalesOrderModel,RegistrationMdSubmissionBatchModel,
		RegistrationAgencyInvoiceModel,RegistrationAgencySubmissionBatchModel,
		RegistrationLeasingBpkbSubmissionBatchModel) {

		var vm = this
		var includes = {include: 'registrations,usedRegistration'}
		

		RegistrationModel.index({sales_order_id: $state.params.id})
		.then(function(res){
			vm.registrations = res.data.data

		})
	
		function loadSalesOrder() {
			SalesOrderModel.get($state.params.id, includes)
			.then(function(res) {
				assignSalesOrder(res.data.data)
			})
		}
		loadSalesOrder()

		function assignSalesOrder(data){

			vm.salesOrder =  data

			if (data.usedRegistration) {

				vm.salesOrder.usedRegistration = data.usedRegistration.data
			}
		}
	})