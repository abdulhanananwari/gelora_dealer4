geloraPolRegShared
	.factory('RegistrationMdSubmissionBatchModel', function(
		$http,
		LinkFactory) {

		var registrationMdSubmissionBatchModel = {}

		registrationMdSubmissionBatchModel.index = function(params) {
			return $http.get(LinkFactory.dealer.polReg.registrationMdSubmissionBatch.base, {params: params})
		}

		registrationMdSubmissionBatchModel.get = function(id, params) {
			return $http.get(LinkFactory.dealer.polReg.registrationMdSubmissionBatch.base + id, {params: params})
		}

		registrationMdSubmissionBatchModel.store = function(registrationMdSubmissionBatch, params) {
			return $http.post(LinkFactory.dealer.polReg.registrationMdSubmissionBatch.base, registrationMdSubmissionBatch, {params: params})
		}

		registrationMdSubmissionBatchModel.update = function(id, registrationMdSubmissionBatch, params) {
			return $http.post(LinkFactory.dealer.polReg.registrationMdSubmissionBatch.base + id, registrationMdSubmissionBatch, {params: params})
		}

		registrationMdSubmissionBatchModel.close = function(id, registrationMdSubmissionBatch, params) {
			return $http.post(LinkFactory.dealer.polReg.registrationMdSubmissionBatch.base + id + '/close', registrationMdSubmissionBatch, {params: params})
		}
		
		registrationMdSubmissionBatchModel.sendEmail = function(id, registrationMdSubmissionBatch, params) {
			return $http.post(LinkFactory.dealer.polReg.registrationMdSubmissionBatch.base + id + '/send-email', registrationMdSubmissionBatch, {params: params})
		}

		return registrationMdSubmissionBatchModel
	})