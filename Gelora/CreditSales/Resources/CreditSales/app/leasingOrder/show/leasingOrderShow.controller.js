geloraDealerCreditSales
	.controller('LeasingOrderShowController', function(
		$state,JwtValidator,LinkFactory,
		LeasingModel, LeasingOrderModel, LeasingProgramModel) {

		var vm = this

		if ($state.params.id) {

			LeasingOrderModel.get($state.params.id)
			.success(function(data) {
				vm.leasingOrder = data.data


				vm.dueCreatorModal = {
					data: {
						entity_id: vm.leasingOrder.mainLeasing.id,
						entity_name: vm.leasingOrder.mainLeasing.name,	
						transactable_app: 'Gelora.Dealer',
						transactable_type: 'LeasingOrder',
						transactable_id: vm.leasingOrder.id,
						amount: (vm.leasingOrder.on_the_road - vm.leasingOrder.dp_po)
					},
					setting: {
						amount: {readonly: true}
					}
				}
				// ,
				// vm.transactionCreatorModal = {
				// 	setting: {
				// 		transactable: {
				// 			readonly: true,
				// 			type_label: 'Leasing Order',
				// 			id_label: 'ID',
				// 			shown: true
				// 		},
				// 		relatedEntity: {
				// 			readonly: true,
				// 			shown: true
				// 		}
				// 	}
				// }

			})

		} else if ($state.params.mainLeasingId) {

			LeasingModel.get($state.params.mainLeasingId)
			.show(function(data) {
				vm.leasingOrder = {
					mainLeasing: data.data
				}
			})

		} else if ($state.params.salesOrderId) {

			vm.leasingOrder = {
				sales_order_id: $state.params.salesOrderId 
			}

		} else {

			vm.leasingOrder = {}
		}

		vm.store = function(leasingOrder) {

			if (leasingOrder.id) {

				LeasingOrderModel.update(leasingOrder.id, leasingOrder)
				.success(function(data) {
					vm.leasingOrder = data.data
					alert('Data PO berhasil diupdate')
				})

			} else {

				LeasingOrderModel.store(leasingOrder)
				.success(function(data) {
					$state.go('leasingOrderShow', {id: data.data.id, mainLeasingId: data.data.mainLeasing.id})
				})
			}
		}

		vm.generate = {
			invoice: function () {
        		window.open(LinkFactory.dealer.creditSales.leasingOrder.views + vm.leasingOrder.id + '/generate/invoice/' + '?' + $.param({jwt:JwtValidator.encodedJwt}));
			},
			agreementBPKB: function () {
        		window.open(LinkFactory.dealer.creditSales.leasingOrder.views + vm.leasingOrder.id + '/generate/agreementBPKB/' + '?' + $.param({jwt:JwtValidator.encodedJwt}));
			}
        }

		vm.action = {
			validate: function(leasingOrder) {
				LeasingOrderModel.action.validation.validate(leasingOrder.id)
				.success(function(data) {
					vm.leasingOrder = data.data
				})
			},
			unvalidate: function(leasingOrder) {
				LeasingOrderModel.action.validation.unvalidate(leasingOrder.id)
				.success(function(data) {
					vm.leasingOrder = data.data
				})
			},
			salesOrder: {
				detach: function(leasingOrder) {

					LeasingOrderModel.salesOrder.detach(leasingOrder.id)
					.success(function(data) {
						vm.leasingOrder = data.data
					})
				}	
			}
		}

		vm.PoFileManager = {
			displayedInput: JSON.stringify({
				
				file: { label : "Purchase Order", show : true },
				
			}),
			additionalData: JSON.stringify({
				
				path: 'leasing-order-po',
				subpath: $state.params.id,
				fileable_type: 'LeasingOrderPo',
				fileable_id: $state.params.id
			})
		}

		vm.MemoFileManager = {
			displayedInput: JSON.stringify({
				
				file: { label : "Memo Order", show : true },
				
			}),
			additionalData: JSON.stringify({
				
				path: 'leasing-order-memo',
				subpath: $state.params.id,
				fileable_type: 'LeasingOrderMemo',
				fileable_id: $state.params.id
			})
		}

	})