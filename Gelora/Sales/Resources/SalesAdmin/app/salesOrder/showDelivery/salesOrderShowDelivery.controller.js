geloraSalesAdmin
	.controller('SalesOrderShowDeliveryController', function(
		$state,$scope,
		LinkFactory,DeliveryModel,
		SalesOrderModel, ConfigModel) {

		var vm = this

		$scope._ = _
		vm.currentStateName = $state.current.name
		vm.linkFactory = LinkFactory

		SalesOrderModel.get($state.params.id)
		.then(function(res) {

			vm.salesOrder = res.data.data
			
		})
		
		DeliveryModel.index({sales_order_id: $state.params.id})
		.then(function(res){

			vm.deliveries = res.data.data
		})

		ConfigModel.get('gelora.delivery.types')
		.then(function(res) {
			vm.deliveryTypes = res.data.data
		})

		vm.store = function(salesOrder) {

			SalesOrderModel.specificUpdate.deliveryRequest(salesOrder.id, _.pick(salesOrder, ['delivery_request']))
			.then(function(res) {
				vm.salesOrder = res.data.data
				alert('Delivery request berhasil diupdate')
			});
		}

		vm.openDelivery = function(id, type) {
			var params = {}
			params[type] = id

			window.open(LinkFactory.dealer.delivery.delivery.redirectApp + '?' + $.param(params))
		}


	})