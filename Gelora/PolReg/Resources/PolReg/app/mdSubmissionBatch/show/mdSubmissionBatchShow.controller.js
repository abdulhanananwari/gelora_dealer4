geloraPolReg
    .controller('MdSubmissionBatchShowController', function(
        $state,
        MdSubmissionBatchModel) {

        var vm = this

        vm.registrationBatch = {}

        vm.store = function(registrationBatch) {

            if (registrationBatch.id) {

                MdSubmissionBatchModel.update(registrationBatch.id, registrationBatch)
                    .then(function(res) {
                        vm.registrationBatch = res.data.data
                        vm.registrationBatch.salesOrders = vm.registrationBatch.salesOrders.data
                        alert('Berhasil diupdate')
                    })

            } else {

                MdSubmissionBatchModel.store(registrationBatch)
                    .then(function(res) {
                        alert('Berhasil disimpan')
                        $state.go('mdSubmissionBatchShow', { id: res.data.data.id })
                    })

            }
        }

        vm.close = function(registrationBatch) {

            MdSubmissionBatchModel.close(registrationBatch.id)
                .then(function(res) {
                    alert('Berhasil ditutup')
                    vm.registrationBatch = res.data.data
                    vm.registrationBatch.salesOrders = vm.registrationBatch.salesOrders.data
                })
        }

        vm.sendEmail = function(registrationBatch, email) {

            MdSubmissionBatchModel.sendEmail(registrationBatch.id, { email: email })
                .then(function(res) {
                    vm.registrationBatch = res.data.data
                    vm.registrationBatch.salesOrders = vm.registrationBatch.salesOrders.data

                })
        }

        if ($state.params.id) {

            MdSubmissionBatchModel.get($state.params.id)
                .then(function(res) {
                    vm.registrationBatch = res.data.data
                    vm.registrationBatch.salesOrders = vm.registrationBatch.salesOrders.data
                })
        }
    })
