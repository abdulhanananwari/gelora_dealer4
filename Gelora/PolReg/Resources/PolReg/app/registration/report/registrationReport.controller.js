geloraPolReg
	.controller('RegistrationReportController', function(
		RegistrationModel,
		JwtValidator,LinkFactory) {

		var vm = this

		
		vm.filter = { 
			from: moment().subtract(30, 'days').format("YYYY-MM-DD"),
			until: moment().format("YYYY-MM-DD"),
		}		
        vm.paymentTypes = { 'credit': 'Kredit', 'cash': 'Kas' }
		
		$('.date').datepicker({dateFormat: "yy-mm-dd"});

		vm.download = function(filter) {

			vm.filter.jwt = JwtValidator.encodedJwt

			window.open(LinkFactory.dealer.polReg.registration.report + '?' + $.param(vm.filter))
		}

	})