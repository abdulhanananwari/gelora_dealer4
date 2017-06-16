geloraSalesAdmin
	.controller('SalesOrderShowFinancialController', function(
		$state,
		LinkFactory,
		SalesOrderModel,
		TransactionModel, DueModel) {

		var vm = this

		vm.transactionCreatorModal = {
			setting: {
				transactable: {
					readonly: true,
					type_label: 'Sales Order',
					id_label: 'ID',
					shown: true
				},
				relatedEntity: {
					readonly: true,
					shown: true
				}
			}
		}

		var queryParams = {
			include: 'leasingOrders,selectedLeasingOrder,salesOrderExtras,price,financialBalance'
		}
		
		vm.load = function() {

			SalesOrderModel.get($state.params.id, queryParams)
			.then(function(res) {
				assignResponse(res)
				vm.calculatePaymentUnreceived(false)
			})
		}
		vm.load()


		vm.updatePrice = function(salesOrder) {

			SalesOrderModel.specificUpdate.price(salesOrder.id, _.pick(salesOrder, ['on_the_road', 'off_the_road']), queryParams)
			.then(function(res) {
				assignResponse(res)
			});
		}

		vm.calculatePaymentUnreceived = function(onServer) {
			
			if (onServer) {

				SalesOrderModel.calculate($state.params.id)
				.then(function(res) {
					vm.paymentUnreceived = res.data.data.payment_unreceived
					alert('Kekurangan pembayaran senilai: Rp ' + Number(vm.paymentUnreceived))
				})

			} else {

				var leasingPayable = typeof vm.salesOrder.selectedLeasingOrder != 'undefined' ? vm.salesOrder.selectedLeasingOrder.leasing_payable : 0;

				vm.paymentUnreceived = vm.salesOrder.financialBalance.grand_total - leasingPayable -
					(vm.transactionDue.balances.transaction_total + vm.transactionDue.balances.receivable_total)
			}
		}

		function assignResponse(res) {

			vm.salesOrder = res.data.data
			
			if (res.data.data.price) {
				vm.salesOrder.price = res.data.data.price.data	
			}

			if (res.data.data.leasingOrders) {
				vm.salesOrder.leasingOrders = res.data.data.leasingOrders.data	
			}

			if (res.data.data.salesOrderExtras) {
				vm.salesOrder.salesOrderExtras = res.data.data.salesOrderExtras.data
			}

			if (res.data.data.financialBalance) {
				vm.salesOrder.financialBalance = res.data.data.financialBalance.data
			}

			if (res.data.data.selectedLeasingOrder) {
				vm.salesOrder.selectedLeasingOrder = res.data.data.selectedLeasingOrder.data
			}
		}
	})