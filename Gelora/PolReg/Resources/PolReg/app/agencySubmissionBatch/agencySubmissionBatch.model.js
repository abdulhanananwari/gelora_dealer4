geloraPolReg
    .factory('AgencySubmissionBatchModel', function(
        $http,
        LinkFactory) {

        var agencySubmissionBatchModel = {}

        agencySubmissionBatchModel.index = function(params) {
            return $http.get(LinkFactory.dealer.polReg.agencySubmissionBatch.base, { params: params })
        }

        agencySubmissionBatchModel.get = function(id, params) {
            return $http.get(LinkFactory.dealer.polReg.agencySubmissionBatch.base + id, { params: params })
        }

        agencySubmissionBatchModel.store = function(agencySubmissionBatch, params) {
            return $http.post(LinkFactory.dealer.polReg.agencySubmissionBatch.base, agencySubmissionBatch, { params: params })
        }

        agencySubmissionBatchModel.update = function(id, agencySubmissionBatch, params) {
            return $http.post(LinkFactory.dealer.polReg.agencySubmissionBatch.base + id, agencySubmissionBatch, { params: params })
        }

        agencySubmissionBatchModel.close = function(id, agencySubmissionBatch, params) {
            return $http.post(LinkFactory.dealer.polReg.agencySubmissionBatch.base + 'close/' + id, agencySubmissionBatch, { params: params })
        }
        
        agencySubmissionBatchModel.handover = function(id, agencySubmissionBatch, params) {
            return $http.post(LinkFactory.dealer.polReg.agencySubmissionBatch.base + 'handover/' + id, agencySubmissionBatch, { params: params })
        }

        return agencySubmissionBatchModel
    })
