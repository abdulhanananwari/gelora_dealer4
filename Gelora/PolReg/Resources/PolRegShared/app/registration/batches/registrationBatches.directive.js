geloraPolRegShared
    .directive('registrationBatches', function(
        SalesOrderModel,LinkFactory,
        RegistrationBatchesFactory) {

        return {
            templateUrl: '/gelora/pol-reg-shared/app/registration/batches/registrationBatches.html',
            scope: {
                innerSalesOrder: '=salesOrder'
            },
            link: function(scope, element, attrs) {

                scope.modalId = Math.random().toString(36).substring(2, 7)

                scope.update = function(salesOrder, type) {
                    var data = {}
                    data[type] = salesOrder.polReg[type]
                    SalesOrderModel.polReg.batch.store(salesOrder.id, data)
                        .then(function(res) {
                            scope.salesOrder = res.data.data
                            scope.innerSalesOrder = res.data.data
                        })
                }
                scope.remove = function(salesOrder, type){
                    var data = {}
                    data[type] = salesOrder.polReg[type]
                    SalesOrderModel.polReg.batch.remove(salesOrder.id , data)
                        .then(function(res) {
                            scope.salesOrder = res.data.data
                            scope.innerSalesOrder = res.data.data
                        })
                }
                scope.redirect = {
                    registrationMdBatch: function(salesOrder){
                        window.open(LinkFactory.dealer.polReg.mdSubmissionBatch.redirectApp  + salesOrder.polReg.md_submission_batch_id)
                    },
                    agencySubmissionBatch: function(salesOrder){
                        window.open(LinkFactory.dealer.polReg.mdSubmissionBatch.redirectApp  + salesOrder.polReg.agency_submission_batch_id)
                    },
                    leasingBpkbSubmissionBatch: function(salesOrder){
                        window.open(LinkFactory.dealer.polReg.mdSubmissionBatch.redirectApp  + salesOrder.polReg.leasing_bpkb_submission_batch_id)
                    },
                    agencySubmissionBatch: function(salesOrder){
                        window.open(LinkFactory.dealer.polReg.mdSubmissionBatch.redirectApp  + salesOrder.polReg.agency_invoice_id)
                    },
                }

                function loadBatch(polReg) {
                    switch (true) {
                        case _.isEmpty(polReg.md_submission_batch_id):

                            RegistrationBatchesFactory.mdSubmissionBatch.index()
                                .then(function(res) {
                                    scope.mdSubmissionBatches = res.data.data
                                })

                            break
                        case !_.isEmpty(polReg.md_submission_batch_id) && _.isEmpty(polReg.agency_submission_batch_id):

                            RegistrationBatchesFactory.agencySubmissionBatch.index()
                                .then(function(res) {
                                    scope.agencySubmissionBatches = res.data.data
                                })

                            break
                        case !_.isEmpty(polReg.agency_submission_batch_id) && _.isEmpty(polReg.agency_invoice_id):

                            RegistrationBatchesFactory.agencyInvoice.index()
                                .then(function(res) {
                                    scope.agencyInvoices = res.data.data
                                })

                            break
                        case !_.isEmpty(polReg.agency_invoice_id) && _.isEmpty(polReg.leasing_bpbk_submission_batch_id):

                            RegistrationBatchesFactory.agencyInvoice.index()
                                .then(function(res) {
                                    scope.leasingBpkbSubmissionBatches = res.data.data
                                })

                            break
                    }
                }

                scope.$watch('innerSalesOrder', function(newValue) {
                    scope.salesOrder = newValue
                    loadBatch(newValue.polReg)
                })
            }
        }
    })
    .factory('RegistrationBatchesFactory', function(
        MdSubmissionBatchModel, AgencySubmissionBatchModel,
        AgencyInvoiceModel, LeasingBpkbSubmissionBatchModel) {

        var factory = {}

        factory.mdSubmissionBatch = {
            index: function() {
                return MdSubmissionBatchModel.index({ status: 'active' })
            }
        }

        factory.agencySubmissionBatch = {
            index: function() {
                return AgencySubmissionBatchModel.index({ status: 'active' })
            }
        }

        factory.agencyInvoice = {
            index: function() {
                return AgencyInvoiceModel.index({ status: 'active' })
            }
        }

        factory.leasingBpkbSubmission = {
            index: function() {
                return LeasingBpkbSubmissionBatchModel.index({ status: 'active' })
            }
        }

        return factory
    })
