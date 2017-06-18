geloraPolRegShared
    .factory('RegistrationAgencySubmissionBatchModel', function(
        $http,
        LinkFactory) {

        var registrationAgencySubmissionBatchModel = {}

        registrationAgencySubmissionBatchModel.index = function(params) {
            return $http.get(LinkFactory.dealer.polReg.registrationAgencySubmissionBatch.base, { params: params })
        }

        registrationAgencySubmissionBatchModel.get = function(id, params) {
            return $http.get(LinkFactory.dealer.polReg.registrationAgencySubmissionBatch.base + id, { params: params })
        }

        registrationAgencySubmissionBatchModel.store = function(registrationAgencySubmissionBatch, params) {
            return $http.post(LinkFactory.dealer.polReg.registrationAgencySubmissionBatch.base, registrationAgencySubmissionBatch, { params: params })
        }

        registrationAgencySubmissionBatchModel.update = function(id, registrationAgencySubmissionBatch, params) {
            return $http.post(LinkFactory.dealer.polReg.registrationAgencySubmissionBatch.base + id, registrationAgencySubmissionBatch, { params: params })
        }

        registrationAgencySubmissionBatchModel.close = function(id, registrationAgencySubmissionBatch, params) {
            return $http.post(LinkFactory.dealer.polReg.registrationAgencySubmissionBatch.base + 'close/' + id, registrationAgencySubmissionBatch, { params: params })
        }
        
        registrationAgencySubmissionBatchModel.handover = function(id, registrationAgencySubmissionBatch, params) {
            return $http.post(LinkFactory.dealer.polReg.registrationAgencySubmissionBatch.base + 'handover/' + id, registrationAgencySubmissionBatch, { params: params })
        }

        return registrationAgencySubmissionBatchModel
    })
