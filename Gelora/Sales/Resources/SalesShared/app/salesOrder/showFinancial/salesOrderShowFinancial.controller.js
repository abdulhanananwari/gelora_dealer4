geloraSalesShared
    .controller('SalesOrderShowFinancialController', function(
        $state, $timeout,
        LinkFactory, JwtValidator,
        SettingModel,
        SalesOrderModel,
        TransactionModel, DueModel) {

        var vm = this

        vm.date = new Date();

        vm.transactionCreatorModal = {
            setting: {
                transactable: {
                    readonly: true,
                    type_label: 'Sales Order',
                    id_label: 'ID',
                    shown: true
                },
                relatedEntity: {
                    readonly: true,
                    shown: true
                }
            }
        }

        function load() {
            SalesOrderModel.get($state.params.id, { with: 'price,salesOrderExtras' })
                .then(function(res) {
                    vm.salesOrder = res.data.data
                    vm.calculatePaymentUnreceived(false)
                })
        }
        load()

        vm.updatePrice = function(salesOrder) {

            SalesOrderModel.specificUpdate.price(salesOrder.id, _.pick(salesOrder, ['on_the_road', 'off_the_road']))
                .then(function(res) {
                    vm.salesOrder = res.data.data
                });
        }

        vm.loadDrivers = function() {

            if (vm.drivers) { return }

            SettingModel.index({ object_type: 'DRIVERS', single: true })
                .then(function(res) {
                    vm.drivers = res.data.data.data_1
                })
        }

        vm.financialClose = function(salesOrder) {
            SalesOrderModel.action.financial.close(salesOrder.id, salesOrder)
                .then(function(res) {
                    vm.salesOrder = res.data.data
                })
        }

        vm.customerInvoice = {
            generate: function(salesOrder, customerInvoice) {

                $timeout(function() { load() }, 5000)

                var params = {
                    jwt: JwtValidator.encodedJwt,
                    delegate_name: customerInvoice.delegate.name,
                    delegate_type: customerInvoice.delegate.type,
                    amount: customerInvoice.amount,
                    note: customerInvoice.note
                }

                window.open(LinkFactory.dealer.sales.salesOrder.financial.views + 'generate-customer-invoice/' + salesOrder.id + '?' + $.param(params))
            },
            delete: function(salesOrder) {

                SalesOrderModel.specificUpdate.deleteCustomerInvoice(salesOrder.id)
                    .then(function(res) {
                        vm.salesOrder = res.data.data
                        alert('Invoice customer berhasil dihapus')
                    })

            }
        }

        vm.onTransactionCreated = {
            in: function(transaction) {

                if (vm.salesOrder.customerInvoice.created_at) {

                    if (vm.salesOrder.customerInvoice.amount == transaction.amount) {

                        if (confirm('Penerimaan sesuai dengan invoice customer. Mau hapus tagihan?')) {
                            vm.customerInvoice.delete(vm.salesOrder)
                        }

                    } else {
                        alert('Penerimaan uang TIDAK sesuai dengan invoice customer. Invoice customer TIDAK dihapus')
                    }
                }
            },
            out: function() {

            }
        }


        vm.calculatePaymentUnreceived = function(onServer) {

            if (onServer) {

                SalesOrderModel.calculate($state.params.id)
                    .then(function(res) {
                        vm.paymentUnreceived = res.data.data.payment_unreceived
                        alert('Kekurangan pembayaran senilai: Rp ' + Number(vm.paymentUnreceived))
                    })

            } else {


                var balance = vm.salesOrder.financialBalance.grand_total

                if (vm.salesOrder.payment_type == 'credit') {
                    balance = balance - vm.salesOrder.leasingOrder.leasing_payable
                }

                balance = balance - (vm.totalTransaction || 0)

                vm.paymentUnreceived = balance
            }
        }
    })