geloraPolReg
    .controller('AgencyInvoiceShowController', function(
        $state,
        ConfigModel,
        AgencyInvoiceModel) {

        var vm = this

        vm.registrationBatch = {}

        vm.store = function(registrationBatch) {

            if (registrationBatch.id) {

                AgencyInvoiceModel.update(registrationBatch.id, registrationBatch)
                    .then(function(res) {
                        assignData(res)
                        alert('Batch Berhasil Diupdate')
                    })

            } else {

                AgencyInvoiceModel.store(registrationBatch)
                    .then(function(res) {
                        alert('Batch Berhasil Disimpan')
                        $state.go('agencyInvoiceShow', { id: res.data.data.id })
                    })

            }

        }

        vm.close = function(registrationBatch) {

            AgencyInvoiceModel.close(registrationBatch.id, registrationBatch)
                .then(function(res) {
                    assignData(res)
                    alert('Batch Berhasil Ditutup')
                })

        }

        if ($state.params.id) {

            AgencyInvoiceModel.get($state.params.id)
                .then(function(res) {

                    assignData(res)
                })
        }

        function assignData(res) {

            vm.registrationBatch = res.data.data

            if (vm.registrationBatch.salesOrders) {
                vm.registrationBatch.salesOrders = vm.registrationBatch.salesOrders.data
            }

            return vm.registrationBatch
        }
    })
