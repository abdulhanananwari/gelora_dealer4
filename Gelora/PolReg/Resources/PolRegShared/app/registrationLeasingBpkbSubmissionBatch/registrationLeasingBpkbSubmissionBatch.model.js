geloraPolRegShared
	.factory('RegistrationLeasingBpkbSubmissionBatchModel', function(
		$http,
		LinkFactory) {

		var registrationLeasingBpkbSubmissionBatchModel = {}

		registrationLeasingBpkbSubmissionBatchModel.index = function(params) {
			return $http.get(LinkFactory.dealer.polReg.registrationLeasingBpkbSubmissionBatch.base, {params: params})
		}

		registrationLeasingBpkbSubmissionBatchModel.get = function(id, params) {
			return $http.get(LinkFactory.dealer.polReg.registrationLeasingBpkbSubmissionBatch.base + id, {params: params})
		}

		registrationLeasingBpkbSubmissionBatchModel.store = function(registrationLeasingBpkbSubmissionBatch, params) {
			return $http.post(LinkFactory.dealer.polReg.registrationLeasingBpkbSubmissionBatch.base, registrationLeasingBpkbSubmissionBatch, {params: params})
		}

		registrationLeasingBpkbSubmissionBatchModel.update = function(id, registrationLeasingBpkbSubmissionBatch, params) {
			return $http.post(LinkFactory.dealer.polReg.registrationLeasingBpkbSubmissionBatch.base + id, registrationLeasingBpkbSubmissionBatch, {params: params})
		}

		registrationLeasingBpkbSubmissionBatchModel.close = function(id, registrationLeasingBpkbSubmissionBatch, params) {
			return $http.post(LinkFactory.dealer.polReg.registrationLeasingBpkbSubmissionBatch.base + 'close/' + id, registrationLeasingBpkbSubmissionBatch, {params: params})
		}

		registrationLeasingBpkbSubmissionBatchModel.handover = function(id, registrationLeasingBpkbSubmissionBatch, params) {
			return $http.post(LinkFactory.dealer.polReg.registrationLeasingBpkbSubmissionBatch.base + 'handover/' + id, registrationLeasingBpkbSubmissionBatch, {params: params})
		}

		return registrationLeasingBpkbSubmissionBatchModel
	})