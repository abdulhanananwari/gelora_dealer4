geloraPolRegShared
    .factory('RegistrationModel', function(
        $http,
        LinkFactory) {

        var registrationModel = {}

        registrationModel.index = function(params) {
            return $http.get(LinkFactory.dealer.polReg.registration.base, { params: params })
        }

        registrationModel.get = function(id, params) {
            return $http.get(LinkFactory.dealer.polReg.registration.base + id, { params: params })
        }

        registrationModel.action = {
            generateFromDelivery: function(deliveryId, params) {
                return $http.post(LinkFactory.dealer.polReg.registration.base + 'generate-from-delivery', { delivery_id: deliveryId }, { params: params })
            },

        }
        registrationModel.cancel = {

            mdSubmissionBatch: function(id) {
                return $http.post(LinkFactory.dealer.polReg.registration.base + id + '/cancel/md-submission-batch/')
            },
            agencySubmissionBatch: function(id) {
                return $http.post(LinkFactory.dealer.polReg.registration.base + id + '/cancel/agency-submission-batch/')
            },
            agencyInvoice: function(id) {
                return $http.post(LinkFactory.dealer.polReg.registration.base + id + '/cancel/agency-invoice/')
            },
            leasingBpkbSubmissionBatch: function(id) {
                return $http.post(LinkFactory.dealer.polReg.registration.base + id + '/cancel/leasing-bpkb-submission-batch/')
            },
        }
        registrationModel.cancelPending = {
            mdSubmissionBatch: function(id) {
                return $http.post(LinkFactory.dealer.polReg.registration.base + id + '/cancel/pending-md-submission-batch/')
            },
            agencySubmissionBatch: function(id) {
                return $http.post(LinkFactory.dealer.polReg.registration.base + id + '/cancel/pending-agency-submission-batch/')
            },
            leasingBpkbSubmissionBatch: function(id) {
                return $http.post(LinkFactory.dealer.polReg.registration.base + id + '/cancel/pending-leasing-bpkb-submission-batch/')
            },
        }
        registrationModel.update = {
            base: function(id, registration, params) {
                return $http.post(LinkFactory.dealer.polReg.registration.base + id, registration, { params: params })
            },
            mdSubmissionBatch: function(id, registration, params) {
                return $http.post(LinkFactory.dealer.polReg.registration.base + id + '/update/md-submission-batch/', registration, { params: params })
            },
            confirmMdSubmissionBatch: function(id, registration, params) {
                return $http.post(LinkFactory.dealer.polReg.registration.base + id + '/update/confirm-md-submission-batch/', registration, { params: params })
            },
            agencySubmissionBatch: function(id, registration, params) {
                return $http.post(LinkFactory.dealer.polReg.registration.base + id + '/update/agency-submission-batch/', registration, { params: params })
            },
            agencyInvoice: function(id, registration, params) {
                return $http.post(LinkFactory.dealer.polReg.registration.base + id + '/update/agency-invoice/', registration, { params: params })
            },
            leasingBpkbSubmissionBatch: function(id, registration, params) {
                return $http.post(LinkFactory.dealer.polReg.registration.base + id + '/update/leasing-bpkb-submission-batch/', registration, { params: params })
            },
            amount: function(id, registration, params) {
                return $http.post(LinkFactory.dealer.polReg.registration.base + id + '/update/amount/', registration, { params: params })
            },
            itemIncoming: function(id, item, params) {
                return $http.post(LinkFactory.dealer.polReg.registration.base + id + '/update/item/incoming/', { name: item.name, incoming: item.incoming }, { params: params })
            },
            itemOutgoing: function(id, item, params) {
                return $http.post(LinkFactory.dealer.polReg.registration.base + id + '/update/item/outgoing/', { name: item.name, outgoing: item.outgoing }, { params: params })
            },
            cost: function(id, cost, params) {
                return $http.post(LinkFactory.dealer.polReg.registration.base + id + '/update/cost/', { cost: cost }, { params: params })
            },
        }
        registrationModel.pending = {
            mdSubmissionBatch: function(id, reason, params) {
                return $http.post(LinkFactory.dealer.polReg.registration.base + id + '/pending/md-submission-batch/', {reason: reason}, { params: params })
            },
            leasingBpkbSubmissionBatch: function(id, reason, params) {
                return $http.post(LinkFactory.dealer.polReg.registration.base + id + '/pending/leasing-bpkb-submission-batch/',  {reason: reason}, { params: params })
            },
            agencySubmissionBatch: function(id, reason, params) {
                return $http.post(LinkFactory.dealer.polReg.registration.base + id + '/pending/agency-submission-batch/',  {reason: reason}, { params: params })
            },

        }


        return registrationModel
    })
    .factory('RegistrationFactory', function() {


        return {
            transform: function(data) {
                var registration = data

                if (registration.delivery) {

                    registration.delivery = registration.delivery.data

                    if (registration.delivery.salesOrder) {
                        registration.delivery.salesOrder = registration.delivery.salesOrder.data

                        if (registration.delivery.salesOrder.cddb) {
                            registration.delivery.salesOrder.cddb = registration.delivery.salesOrder.cddb.data
                        }
                    }

                    if (registration.delivery.unit) {
                        registration.delivery.unit = registration.delivery.unit.data
                    }
                }

                if (registration.registrationMdSubmissionBatch) {
                    registration.registrationMdSubmissionBatch = registration.registrationMdSubmissionBatch.data
                }

                if (registration.registrationAgencySubmissionBatch) {
                    registration.registrationAgencySubmissionBatch = registration.registrationAgencySubmissionBatch.data
                }

                if (registration.registrationAgencyInvoice) {
                    registration.registrationAgencyInvoice = registration.registrationAgencyInvoice.data
                }

                if (registration.registrationLeasingBpkbSubmissionBatch) {
                    registration.registrationLeasingBpkbSubmissionBatch = registration.registrationLeasingBpkbSubmissionBatch.data
                }

                return registration
            }
        }
    })
