geloraPolReg
	.factory('LeasingBpkbSubmissionBatchModel', function(
		$http,
		LinkFactory) {

		var leasingBpkbSubmissionBatchModel = {}

		leasingBpkbSubmissionBatchModel.index = function(params) {
			return $http.get(LinkFactory.dealer.polReg.leasingBpkbSubmissionBatch.base, {params: params})
		}

		leasingBpkbSubmissionBatchModel.get = function(id, params) {
			return $http.get(LinkFactory.dealer.polReg.leasingBpkbSubmissionBatch.base + id, {params: params})
		}

		leasingBpkbSubmissionBatchModel.store = function(leasingBpkbSubmissionBatch, params) {
			return $http.post(LinkFactory.dealer.polReg.leasingBpkbSubmissionBatch.base, leasingBpkbSubmissionBatch, {params: params})
		}

		leasingBpkbSubmissionBatchModel.update = function(id, leasingBpkbSubmissionBatch, params) {
			return $http.post(LinkFactory.dealer.polReg.leasingBpkbSubmissionBatch.base + id, leasingBpkbSubmissionBatch, {params: params})
		}

		leasingBpkbSubmissionBatchModel.close = function(id, leasingBpkbSubmissionBatch, params) {
			return $http.post(LinkFactory.dealer.polReg.leasingBpkbSubmissionBatch.base + 'close/' + id, leasingBpkbSubmissionBatch, {params: params})
		}

		leasingBpkbSubmissionBatchModel.handover = function(id, leasingBpkbSubmissionBatch, params) {
			return $http.post(LinkFactory.dealer.polReg.leasingBpkbSubmissionBatch.base + 'handover/' + id, leasingBpkbSubmissionBatch, {params: params})
		}

		return leasingBpkbSubmissionBatchModel
	})