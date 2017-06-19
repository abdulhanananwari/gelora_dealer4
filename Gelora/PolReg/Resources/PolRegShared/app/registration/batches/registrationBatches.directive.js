geloraPolRegShared
    .directive('registrationBatches', function(
        RegistrationModel, RegistrationFactory, RegistrationBatchesFactory,
        LinkFactory, JwtValidator) {

        return {
            templateUrl: '/gelora/pol-reg-shared/app/registration/batches/registrationBatches.html',
            scope: {
                registrationId: '@',
            },
            link: function(scope, element, attrs) {

                scope.modalId = Math.random().toString(36).substring(2, 7)

                attrs.$observe('registrationId', function(newValue) {
                    RegistrationBatchesFactory.registration.load(newValue)
                })


                scope.$watch(function() {
                    return RegistrationBatchesFactory.data
                }, function(data) {

                    scope.registration = data.registration
                    scope.registrationMdBatches = data.mdSubmissionBatches
                    scope.registrationAgencySubmissionBatches = data.agencySubmissionBatches
                    scope.registrationAgencyInvoices = data.agencyInvoices
                    scope.registrationLeasingBpkbSubmissionBatches = data.leasingBpkbSubmissionBatches

                }, true)

                scope.action = RegistrationBatchesFactory
            }
        }
    })





.factory('RegistrationBatchesFactory', function(
    RegistrationModel, RegistrationFactory,
    RegistrationMdSubmissionBatchModel, RegistrationAgencySubmissionBatchModel,
    RegistrationAgencyInvoiceModel, RegistrationLeasingBpkbSubmissionBatchModel) {

    var registrationBatchesFactory = {}

    registrationBatchesFactory.data = {
        registration: null,
        mdSubmissionBatches: null,
        agencySubmissionBatches: null,
        agencyInvoices: null,
        leasingBpkbSubmissionBatches: null
    }

    registrationBatchesFactory.defaultIncludes = {
        include: 'registrationMdSubmissionBatch,registrationAgencySubmissionBatch,registrationAgencyInvoice,registrationLeasingBpkbSubmissionBatch,delivery.salesOrder.selectedLeasingOrder'
    }

    registrationBatchesFactory.mdSubmissionBatch = {
        select: function(registration) {
            RegistrationModel.update.mdSubmissionBatch(registration.id, { registration_md_submission_batch_id: registration.registration_md_submission_batch_id }, registrationBatchesFactory.defaultIncludes)
                .then(function(res) {
                    assignRegistration(res.data.data)
                })
        },
        cancel: function(registration) {
            RegistrationModel.cancel.mdSubmissionBatch(registration.id, { registration_md_submission_batch_id: registration.registration_md_submission_batch_id }, registrationBatchesFactory.defaultIncludes)
                .then(function(res) {
                    alert('Batch berhasil dibatalkan')
                })
        },
        confirm: function(registration) {
            RegistrationModel.update.confirmMdSubmissionBatch(registration.id, {}, registrationBatchesFactory.defaultIncludes)
                .then(function(res) {
                    assignRegistration(res.data.data)
                })
        },

        pending: function(registration, mdSubmissionBatchPendingReason) {
            RegistrationModel.pending.mdSubmissionBatch(registration.id, mdSubmissionBatchPendingReason, registrationBatchesFactory.defaultIncludes)
                .then(function(res) {
                    assignRegistration(res.data.data)
                })
        },
        cancelPending: function(registration){
            RegistrationModel.cancelPending.mdSubmissionBatch(registration.id,{}, registrationBatchesFactory.defaultIncludes)
            .then(function(res){
                assignRegistration(res.data.data)
            })
        },
        loadActive: function() {
            return RegistrationMdSubmissionBatchModel.index({ status: 'active' })
                .then(function(res) {
                    registrationBatchesFactory.data.mdSubmissionBatches = res.data.data
                })
        }
    }

    registrationBatchesFactory.agencySubmissionBatch = {
        select: function(registration) {
            RegistrationModel.update.agencySubmissionBatch(registration.id, { registration_agency_submission_batch_id: registration.registration_agency_submission_batch_id }, registrationBatchesFactory.defaultIncludes)
                .then(function(res) {
                    assignRegistration(res.data.data)
                })
        },
        cancel: function(registration) {
            RegistrationModel.cancel.agencySubmissionBatch(registration.id, { registration_agency_submission_batch_id: registration.registration_agency_submission_batch_id }, registrationBatchesFactory.defaultIncludes)
                .then(function(res) {
                    alert('Batch berhasil dibatalkan')
                })
        },
        pending: function(registration, agencySubmissionBatchPendingReason) {
            RegistrationModel.pending.agencySubmissionBatch(registration.id, agencySubmissionBatchPendingReason, registrationBatchesFactory.defaultIncludes)
                .then(function(res) {
                    assignRegistration(res.data.data)
                })
        },
        cancelPending: function(registration){
            RegistrationModel.cancelPending.agencySubmissionBatch(registration.id,{}, registrationBatchesFactory.defaultIncludes)
            .then(function(res){
                assignRegistration(res.data.data)
            })
        },
        loadActive: function() {
            return RegistrationAgencySubmissionBatchModel.index({ status: 'active' })
                .then(function(res) {
                    registrationBatchesFactory.data.agencySubmissionBatches = res.data.data
                })
        }
    }

    registrationBatchesFactory.agencyInvoice = {

        select: function(registration) {
            RegistrationModel.update.agencyInvoice(registration.id, { registration_agency_invoice_id: registration.registration_agency_invoice_id }, registrationBatchesFactory.defaultIncludes)
                .then(function(res) {
                    assignRegistration(res.data.data)
                })
        },
        cancel: function(registration) {
            RegistrationModel.cancel.agencyInvoice(registration.id, { registration_agency_invoice_id: registration.registration_agency_invoice_id }, registrationBatchesFactory.defaultIncludes)
                .then(function(res) {
                    alert('Batch berhasil dibatalkan')
                })
        },
        loadActive: function() {
            return RegistrationAgencyInvoiceModel.index({ status: 'active', agent_id: registrationBatchesFactory.data.registration.registrationAgencySubmissionBatch.agent.id })
                .then(function(res) {
                    registrationBatchesFactory.data.agencyInvoices = res.data.data
                })
        }
    }

    registrationBatchesFactory.leasingBpkbSubmissionBatch = {
        select: function(registration) {
            RegistrationModel.update.leasingBpkbSubmissionBatch(registration.id, { registration_leasing_bpkb_submission_batch_id: registration.registration_leasing_bpkb_submission_batch_id }, registrationBatchesFactory.defaultIncludes)
                .then(function(res) {
                    assignRegistration(res.data.data)
                })
        },
        cancel: function(registration) {
            RegistrationModel.cancel.leasingBpkbSubmissionBatch(registration.id, { registration_leasing_bpkb_submission_batch_id: registration.registration_leasing_bpkb_submission_batch_id }, registrationBatchesFactory.defaultIncludes)
                .then(function(res) {
                    alert('Batch berhasil dibatalkan')
                })
        },
        pending: function(registration, leasingBpkbSubmissionBatchPendingReason) {
            RegistrationModel.pending.leasingBpkbSubmissionBatch(registration.id, leasingBpkbSubmissionBatchPendingReason, registrationBatchesFactory.defaultIncludes)
                .then(function(res) {
                    assignRegistration(res.data.data)
                })
        },
         cancelPending: function(registration){
            RegistrationModel.cancelPending.leasingBpkbSubmissionBatch(registration.id,{}, registrationBatchesFactory.defaultIncludes)
            .then(function(res){
                assignRegistration(res.data.data)
            })
        },
        loadActive: function() {
            return RegistrationLeasingBpkbSubmissionBatchModel.index({ status: 'active', main_leasing_id: registrationBatchesFactory.data.registration.delivery.salesOrder.selectedLeasingOrder.data.mainLeasing.id })
                .then(function(res) {
                    registrationBatchesFactory.data.leasingBpkbSubmissionBatches = res.data.data
                })
        }
    }

    function loadBatchesByRegistrationState() {

        if (!registrationBatchesFactory.data.registration) {
            return
        }

        if (registrationBatchesFactory.data.registration.id && !registrationBatchesFactory.data.registration.registration_md_submission_batch_confirmed_at) {
            registrationBatchesFactory.mdSubmissionBatch.loadActive()
        }

        if (registrationBatchesFactory.data.registration.registration_md_submission_batch_confirmed_at && !registrationBatchesFactory.data.registration.registration_agency_submission_batch_id) {
            registrationBatchesFactory.agencySubmissionBatch.loadActive()
        }

        if (registrationBatchesFactory.data.registration.registration_agency_submission_batch_id && !registrationBatchesFactory.data.registration.registration_agency_invoice_id) {
            registrationBatchesFactory.agencyInvoice.loadActive()
        }
        if (registrationBatchesFactory.data.registration.registration_agency_invoice_id && registrationBatchesFactory.data.registration.delivery.salesOrder.payment_type == 'credit' && !registrationBatchesFactory.data.registration.registration_leasing_bpkb_submission_batch_id) {
            registrationBatchesFactory.leasingBpkbSubmissionBatch.loadActive()
        }

    }

    registrationBatchesFactory.registration = {
        load: function(id) {

            if (id) {

                RegistrationModel.get(id, registrationBatchesFactory.defaultIncludes)
                    .then(function(res) {
                        assignRegistration(res.data.data)
                    })
            }
        }
    }

    function assignRegistration(data) {
        registrationBatchesFactory.data.registration = RegistrationFactory.transform(data)
        loadBatchesByRegistrationState()
    }


    return registrationBatchesFactory
})
