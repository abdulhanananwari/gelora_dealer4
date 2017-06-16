geloraPurchaseSimple
	.controller('ReportPurchaseController', function(
		ConfigModel,
		UnitModel,
		JwtValidator,LinkFactory) {

		var vm = this

		ConfigModel.get('gelora.base.unitStatuses')
		.then(function(res) {
			vm.statuses = res.data.data
		})

		vm.filter = { 
			from: moment().format("YYYY-MM-DD"),
			until: moment().format("YYYY-MM-DD"),
		}

		$('.date').datepicker({dateFormat: "yy-mm-dd"});

		vm.download = function(filter) {

			vm.filter.jwt = JwtValidator.encodedJwt

			window.open(LinkFactory.dealer.base.unit.report + '?' + $.param(vm.filter))
		}

	})