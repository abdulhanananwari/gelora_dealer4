geloraPolReg
	.factory('RegistrationAgencyInvoiceModel', function(
		$http,
		LinkFactory) {

		var registrationAgencyInvoiceModel = {}

		registrationAgencyInvoiceModel.index = function(params) {
			return $http.get(LinkFactory.dealer.polReg.registrationAgencyInvoice.base, {params: params})
		}

		registrationAgencyInvoiceModel.get = function(id, params) {
			return $http.get(LinkFactory.dealer.polReg.registrationAgencyInvoice.base + id, {params: params})
		}

		registrationAgencyInvoiceModel.store = function(registrationAgencyInvoice, params) {
			return $http.post(LinkFactory.dealer.polReg.registrationAgencyInvoice.base, registrationAgencyInvoice, {params: params})
		}

		registrationAgencyInvoiceModel.update = function(id, registrationAgencyInvoice, params) {
			return $http.post(LinkFactory.dealer.polReg.registrationAgencyInvoice.base + id, registrationAgencyInvoice, {params: params})
		}
		

		registrationAgencyInvoiceModel.close = function(id, registrationAgencySubmissionBatch, params) {
			return $http.post(LinkFactory.dealer.polReg.registrationAgencyInvoice.base + 'close/' + id , registrationAgencySubmissionBatch, {params: params})
		}

		return registrationAgencyInvoiceModel
	})