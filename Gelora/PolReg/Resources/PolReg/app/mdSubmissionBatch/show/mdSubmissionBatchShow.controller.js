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
                        assignData(res)
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
                    assignData(res)
                })
        }

        vm.sendEmail = function(registrationBatch, email) {

            MdSubmissionBatchModel.sendEmail(registrationBatch.id, { email: email })
                .then(function(res) {
                    assignData(res)

                })
        }

        if ($state.params.id) {

            MdSubmissionBatchModel.get($state.params.id)
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
