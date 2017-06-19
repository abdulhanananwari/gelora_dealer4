geloraPolRegShared
	.factory('AgencyInvoiceModel', function(
		$http,
		LinkFactory) {

		var agencyInvoiceModel = {}

		agencyInvoiceModel.index = function(params) {
			return $http.get(LinkFactory.dealer.polReg.agencyInvoice.base, {params: params})
		}

		agencyInvoiceModel.get = function(id, params) {
			return $http.get(LinkFactory.dealer.polReg.agencyInvoice.base + id, {params: params})
		}

		agencyInvoiceModel.store = function(agencyInvoice, params) {
			return $http.post(LinkFactory.dealer.polReg.agencyInvoice.base, agencyInvoice, {params: params})
		}

		agencyInvoiceModel.update = function(id, agencyInvoice, params) {
			return $http.post(LinkFactory.dealer.polReg.agencyInvoice.base + id, agencyInvoice, {params: params})
		}

		agencyInvoiceModel.close = function(id, registrationAgencySubmissionBatch, params) {
			return $http.post(LinkFactory.dealer.polReg.agencyInvoice.base + 'close/' + id , registrationAgencySubmissionBatch, {params: params})
		}

		return agencyInvoiceModel
	})