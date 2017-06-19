geloraPolReg
	.factory('MdSubmissionBatchModel', function(
		$http,
		LinkFactory) {

		var mdSubmissionBatchModel = {}

		mdSubmissionBatchModel.index = function(params) {
			return $http.get(LinkFactory.dealer.polReg.mdSubmissionBatch.base, {params: params})
		}

		mdSubmissionBatchModel.get = function(id, params) {
			return $http.get(LinkFactory.dealer.polReg.mdSubmissionBatch.base + id, {params: params})
		}

		mdSubmissionBatchModel.store = function(mdSubmissionBatch, params) {
			return $http.post(LinkFactory.dealer.polReg.mdSubmissionBatch.base, mdSubmissionBatch, {params: params})
		}

		mdSubmissionBatchModel.update = function(id, mdSubmissionBatch, params) {
			return $http.post(LinkFactory.dealer.polReg.mdSubmissionBatch.base + id, mdSubmissionBatch, {params: params})
		}

		mdSubmissionBatchModel.close = function(id, mdSubmissionBatch, params) {
			return $http.post(LinkFactory.dealer.polReg.mdSubmissionBatch.base + id + '/close', mdSubmissionBatch, {params: params})
		}
		
		mdSubmissionBatchModel.sendEmail = function(id, mdSubmissionBatch, params) {
			return $http.post(LinkFactory.dealer.polReg.mdSubmissionBatch.base + id + '/send-email', mdSubmissionBatch, {params: params})
		}

		return mdSubmissionBatchModel
	})