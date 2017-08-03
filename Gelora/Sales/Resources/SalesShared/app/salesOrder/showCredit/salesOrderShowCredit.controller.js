geloraSalesShared
    .controller('SalesOrderShowCreditController', function(
        $state, $timeout,
        LinkFactory, JwtValidator, ConfigModel, AppFactory,
        LeasingInvoiceBatchModel, LeasingModel,
        SalesOrderModel) {

        var vm = this

        vm.appType = AppFactory.type

        $('.date').datepicker({
            dateFormat: "yy-mm-dd",
        });


        SalesOrderModel.get($state.params.id)
            .then(function(res) {
                vm.salesOrder = res.data.data

                if (_.has(vm.salesOrder, 'leasingOrder.mainLeasing.id')) {
                    LeasingModel.get(_.get(vm.salesOrder, 'leasingOrder.mainLeasing.id'))
                        .then(function(res) {
                            vm.leasing = res.data.data
                            vm.mbdTransferFormula = vm.leasing.mbd_transfer_formula
                            vm.recalculateJoinPromos()
                        })
                }

                if (vm.salesOrder.leasingOrder.invoice_generated_at) {
                    vm.action.joinPromoPayment.validate(vm.salesOrder)
                    vm.action.mainReceivablePayment.validate(vm.salesOrder)
                }
            })

        ConfigModel.get('gelora.creditSales.dueDateTypes')
            .then(function(res) {
                vm.dueDayTypes = res.data.data
            })


        vm.store = function(salesOrder) {
            SalesOrderModel.leasingOrder.update(salesOrder.id, salesOrder.leasingOrder)
                .then(function(res) {
                    alert('Update berhasil')
                    vm.salesOrder = res.data.data
                })
        }

        vm.assignFromLeasingOrder = function(leasingOrderId) {

            SalesOrderModel.leasingOrder.assignFromLeasingOrder(vm.salesOrder.id, leasingOrderId)
                .then(function(res) {
                    alert('Berhasil menyambungkan PO ' + leasingOrderId)
                    vm.salesOrder = res.data.data
                })
        }

        vm.copyDataFromSalesOrder = function() {
            vm.salesOrder.leasingOrder.customer = _.pick(vm.salesOrder.customer, ['name', 'address', 'ktp'])
            vm.salesOrder.leasingOrder.registration = _.pick(vm.salesOrder.registration, ['name', 'address', 'ktp'])
            vm.salesOrder.leasingOrder.vehicle = vm.salesOrder.vehicle;
            vm.salesOrder.leasingOrder.on_the_road = vm.salesOrder.on_the_road
        }

        vm.recalculateJoinPromos = function() {

            _.forEach(vm.salesOrder.leasingOrder.joinPromos, function(joinPromo) {
                if (_.isNumber(joinPromo.amount) && vm.mbdTransferFormula) {

                    var string = _.replace(vm.mbdTransferFormula, /amount/g, _.toString(joinPromo.amount))
                    joinPromo.transfer_amount = _.round(eval(string), 0)
                    joinPromo.calculated_transfer_amount = _.round(eval(string), 0)
                }
            })
        }

        vm.loadLeasingInvoiceBatches = function() {

            if (!vm.leasingInvoiceBatches) {

                LeasingInvoiceBatchModel.index({ status: 'active', 'sub_leasing_id': vm.salesOrder.leasingOrder.subLeasing.id })
                    .then(function(res) {
                        vm.leasingInvoiceBatches = res.data.data
                    })
            }
        }

        vm.action = {
            update: function(salesOrder) {
                SalesOrderModel.leasingOrder.update(salesOrder.id, salesOrder.leasingOrder)
                    .then(function(res) {
                        alert('PO berhasil di update')
                        vm.salesOrder = res.data.data
                    })
            },
            updateAfterValidation: function(salesOrder) {
                SalesOrderModel.leasingOrder.updateAfterValidation(salesOrder.id, salesOrder.leasingOrder)
                    .then(function(res) {
                        alert('PO berhasil di update')
                        vm.salesOrder = res.data.data
                    })
            },
            mainReceivablePayment: {
                store: function(salesOrder) {
                    SalesOrderModel.leasingOrder.mainReceivablePayment.store(salesOrder.id, salesOrder.leasingOrder)
                        .then(function(res) {
                            vm.salesOrder = res.data.data
                        })
                },
                validate: function(salesOrder) {
                    SalesOrderModel.leasingOrder.mainReceivablePayment.validate(salesOrder.id)
                        .then(function(res) {
                            vm.mainReceivablePaymentValidation = res.data.data
                        })

                }
            },
            joinPromoPayment: {
                store: function(salesOrder, joinPromos, transaction) {
                    SalesOrderModel.leasingOrder.joinPromoPayment.store(salesOrder.id, joinPromos, transaction)
                        .then(function(res) {
                            vm.salesOrder = res.data.data
                            $state.reload()
                        })
                },
                validate: function(salesOrder) {
                    if (_.isUndefined(vm.joinPromoPaymentValidation)) {

                        SalesOrderModel.leasingOrder.joinPromoPayment.validate(salesOrder.id)
                            .then(function(res) {
                                vm.joinPromoPaymentValidation = res.data.data
                            })
                    }
                }
            },
            orderConfirmation: function(salesOrder, orderConfirmation) {
                var note = prompt('Catatan ACC Lisan')
                SalesOrderModel.leasingOrder.orderConfirmation(salesOrder.id, { order_confirmation: orderConfirmation, note: note })
                    .then(function(res) {
                        vm.salesOrder = res.data.data
                    })
            },
            poComplete: function(salesOrder, poComplete) {
                SalesOrderModel.leasingOrder.poComplete(salesOrder.id, { po_complete: poComplete })
                    .then(function(res) {
                        vm.salesOrder = res.data.data
                    })
            }
        }

        vm.generate = {
            invoice: function() {
                window.open(LinkFactory.dealer.sales.salesOrder.leasingOrder.views + 'generate-leasing-order-invoice/' + vm.salesOrder.id + '?' + $.param({ jwt: JwtValidator.encodedJwt }));
            },
            extraDocumentInvoice: function() {
                window.open(LinkFactory.dealer.sales.salesOrder.leasingOrder.views + 'generate-extra-document-invoice/' + vm.salesOrder.id + '?' + $.param({ jwt: JwtValidator.encodedJwt }));
            },
            leasingOrderReceipt: function() {
                window.open(LinkFactory.dealer.sales.salesOrder.leasingOrder.views + 'generate-leasing-order-receipt/' + vm.salesOrder.id + '?' + $.param({ jwt: JwtValidator.encodedJwt }));
            },
        }

        vm.transactionCreatorModal = {
            jp: {
                setting: [
                    { property: 'amount', readonly: false, shown: true },
                    { property: 'autoPrint', set: true },
                ]
            },
            mainReceivable: {
                setting: [
                    { property: 'amount', readonly: true, shown: true },
                    { property: 'autoPrint', set: true },
                ]
            }
        }


    })