geloraDealerCreditSales
    .controller('LeasingInvoiceBatchShowController', function(
        $state, JwtValidator, LinkFactory,
        LeasingInvoiceBatchModel) {

        var vm = this

        vm.leasingInvoiceBatch = {}

        vm.store = function(leasingInvoiceBatch) {

            if (leasingInvoiceBatch.id) {

                LeasingInvoiceBatchModel.update(leasingInvoiceBatch.id, leasingInvoiceBatch)
                    .then(function(res) {
                        assignData(res)
                        alert('Batch Berhasil Diupdate')
                    })

            } else {

                LeasingInvoiceBatchModel.store(leasingInvoiceBatch)
                    .then(function(res) {
                        alert('Batch Berhasil Disimpan')
                        $state.go('leasingInvoiceBatchShow', { id: res.data.data.id })
                    })
            }
        }

        vm.close = function(leasingInvoiceBatch) {

            LeasingInvoiceBatchModel.close(leasingInvoiceBatch.id, leasingInvoiceBatch)
                .then(function(res) {
                    assignData(res)
                    alert('Batch Berhasil Ditutup')
                })
        }

        vm.generateLeasingInvoice = function(leasingInvoiceBatch) {
            window.open(LinkFactory.dealer.creditSales.leasingInvoiceBatch.views + leasingInvoiceBatch.id + '/generate-leasing-invoice-batch/' + '?' + $.param({ jwt: JwtValidator.encodedJwt }))
        }

        if ($state.params.id) {

            LeasingInvoiceBatchModel.get($state.params.id)
                .then(function(res) {
                    assignData(res)
                })
        }

        function assignData(res) {

            vm.leasingInvoiceBatch = res.data.data

            if (vm.leasingInvoiceBatch.salesOrders) {
                vm.leasingInvoiceBatch.salesOrders = vm.leasingInvoiceBatch.salesOrders.data
            }

            return vm.leasingInvoiceBatch
        }
    })