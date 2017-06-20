geloraPolReg
    .controller('AgencySubmissionBatchShowController', function(
        $state,
        AgencySubmissionBatchModel, LinkFactory, JwtValidator) {

        var vm = this

        vm.registrationBatch = {}

        vm.store = function(registrationBatch) {

            if (registrationBatch.id) {

                AgencySubmissionBatchModel.update(registrationBatch.id, registrationBatch)
                    .then(function(res) {
                        assignData(res)
                        alert('Batch Berhasil Diupdate')
                    })

            } else {

                AgencySubmissionBatchModel.store(registrationBatch)
                    .then(function(res) {
                        alert('Batch Berhasil Disimpan')
                        $state.go('agencySubmissionBatchShow', { id: res.data.data.id })
                    })

            }

        }

        vm.close = function(registrationBatch) {

            AgencySubmissionBatchModel.close(registrationBatch.id)
                .then(function(res) {
                    assignData(res)
                    alert('Batch Berhasil Ditutup')
                })

        }
        vm.generateReceipt = function(registrationBatch) {
            window.open(LinkFactory.dealer.polReg.agencySubmissionBatch.views + 'generate-agency-receipt/' + registrationBatch.id + '?' + $.param({ jwt: JwtValidator.encodedJwt }));
        }
        vm.handover = function(registrationBatch) {
            AgencySubmissionBatchModel.handover(registrationBatch.id)
                .then(function(res) {
                    assignData(res)
                })
        }

        if ($state.params.id) {

            AgencySubmissionBatchModel.get($state.params.id)
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
