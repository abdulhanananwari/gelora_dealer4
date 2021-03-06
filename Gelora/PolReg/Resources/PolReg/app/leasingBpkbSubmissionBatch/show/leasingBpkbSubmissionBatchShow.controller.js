geloraPolReg
    .controller('LeasingBpkbSubmissionBatchShowController', function(
        $state,
        LeasingBpkbSubmissionBatchModel,
        LinkFactory, JwtValidator) {

        var vm = this

        vm.registrationBatch = {}

        vm.store = function(registrationBatch) {

            if (registrationBatch.id) {

                LeasingBpkbSubmissionBatchModel.update(registrationBatch.id, registrationBatch)
                    .then(function(res) {
                        alert('Batch Berhasil Diupdate')
                        assignData(res)
                    })

            } else {

                LeasingBpkbSubmissionBatchModel.store(registrationBatch)
                    .then(function(res) {
                        alert('Batch Berhasil Disimpan')
                        $state.go('leasingBpkbSubmissionBatchShow', { id: res.data.data.id })
                    })

            }
        }

        vm.close = function(registrationBatch) {

            LeasingBpkbSubmissionBatchModel.close(registrationBatch.id)
                .then(function(res) {

                    assignData(res)
                })

        }

        vm.handover = function(registrationBatch) {

            LeasingBpkbSubmissionBatchModel.handover(registrationBatch.id)
                .then(function(res) {

                    assignData(res)
                })
        }

        vm.generateReceipt = function(registrationBatch) {
            window.open(LinkFactory.dealer.polReg.leasingBpkbSubmissionBatch.views + 'generate-leasing-bpkb-receipt/' + registrationBatch.id + '?' + $.param({ jwt: JwtValidator.encodedJwt }));
        }

        if ($state.params.id) {

            LeasingBpkbSubmissionBatchModel.get($state.params.id)
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
