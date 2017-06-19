geloraPolReg
    .controller('MdSubmissionBatchShowController', function(
        $state,
        MdSubmissionBatchModel) {

        var vm = this

        vm.registrationBatch = {}

        var defaultIncludes = { with: 'registrations.delivery.salesOrder.cddb' }

        vm.store = function(registrationBatch) {

            if (registrationBatch.id) {

                MdSubmissionBatchModel.update(registrationBatch.id, registrationBatch)
                    .then(function(res) {
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

            MdSubmissionBatchModel.close(registrationBatch.id, {}, defaultIncludes)
                .then(function(res) {
                    alert('Berhasil ditutup')
                    assignData(res.data.data)
                })
        }

        vm.confirm = function(registration, confirmed_success) {

            RegistrationModel.update.confirmMdSubmissionBatch(registration.id, { confirmed_success: confirmed_success })
                .then(function(res) {
                    alert('Berhasil dikonfirmasi')
                })

        }

        vm.sendEmail = function(registrationBatch, email) {

            MdSubmissionBatchModel.sendEmail(registrationBatch.id, { email: email }, defaultIncludes)
                .then(function(res) {
                    assignData(res.data.data)
                })
        }

        if ($state.params.id) {

            MdSubmissionBatchModel.get($state.params.id, defaultIncludes)
                .then(function(res) {
                    vm.registrationBatch = assignData(res.data.data)
                })
        }
    })
