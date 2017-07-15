geloraSalesShared
    .controller('SalesOrderShowFinancialController', function(
        $state,
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


        SalesOrderModel.get($state.params.id, { with: 'price,salesOrderExtras' })
            .then(function(res) {
                vm.salesOrder = res.data.data
                vm.calculatePaymentUnreceived(false)
            })


        vm.updatePrice = function(salesOrder) {

            SalesOrderModel.specificUpdate.price(salesOrder.id, _.pick(salesOrder, ['on_the_road', 'off_the_road']))
                .then(function(res) {
                    vm.salesOrder = res.data.data
                });
        }

        vm.generateCustomerInvoice = function(salesOrder, pendingInvoice) {

            var params = {
                jwt: JwtValidator.encodedJwt,
                delegate_name: pendingInvoice.delegate.name,
                delegate_type: pendingInvoice.delegate.type,
                amount: pendingInvoice.amount
            }

            window.open(LinkFactory.dealer.sales.salesOrder.financial.views + 'generate-customer-invoice/' + salesOrder.id + '?' + $.param(params));
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
                    balance = balance - vm.salesOrder.financialBalance.leasing_payable
                }

                balance = balance - (vm.transactionDue.balances.transaction_total + vm.transactionDue.balances.receivable_total)

                vm.paymentUnreceived = balance
            }
        }
    })