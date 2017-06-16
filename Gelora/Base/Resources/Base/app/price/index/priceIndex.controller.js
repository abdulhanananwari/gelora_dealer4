geloraBase
	.controller('PriceIndexController', function(
		$state, LinkFactory, JwtValidator,
		PriceModel, ModelModel) {

		var vm = this
		
		vm.params = {}

		vm.load = function() {

			PriceModel.extensive.index(vm.params)
			.then(function(res) {
				vm.prices = res.data.data
			})
		}
		vm.load()

		vm.synchronize = function() {

			vm.loading = true

			PriceModel.update('synchronize')
			.then(function(res) {
				
				alert('Berhasil mensynchronize ' + res.data.data.length + ' model kendaraan');
				vm.loading = false
				vm.load()

			}, function() {
				
				vm.loading = false
			})
		}

		vm.download = function() {
			window.open(LinkFactory.dealer.base.price.report + '?jwt=' + JwtValidator.encodedJwt)	
		}

	})