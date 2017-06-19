geloraPolReg
    .controller('MdSubmissionBatchShowController', function(
        $state,
        MdSubmissionBatchModel) {

        var vm = this

        vm.registrationBatch = {}

        var defaultIncludes = { with: 'registrations.delivery.salesOrder.cddb' }

        vm.store = function(registrationBatch) {

            if (registrationBatch.id) {

                RegistrationMdSubmissionBatchModel.update(registrationBatch.id, registrationBatch)
                    .then(function(res) {
                        alert('Berhasil diupdate')
                    })

            } else {

                RegistrationMdSubmissionBatchModel.store(registrationBatch)
                    .then(function(res) {
                        alert('Berhasil disimpan')
                        $state.go('registrationMdSubmissionBatchShow', { id: res.data.data.id })
                    })

            }
        }

        vm.close = function(registrationBatch) {

            RegistrationMdSubmissionBatchModel.close(registrationBatch.id, {}, defaultIncludes)
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

            RegistrationMdSubmissionBatchModel.sendEmail(registrationBatch.id, { email: email }, defaultIncludes)
                .then(function(res) {
                    assignData(res.data.data)
                })
        }

        if ($state.params.id) {

            RegistrationMdSubmissionBatchModel.get($state.params.id, defaultIncludes)
                .then(function(res) {
                    vm.registrationBatch = assignData(res.data.data)
                })
        }

        function assignData(data) {

            vm.registrationBatch = data

            if (vm.registrationBatch.registrations) {

                vm.registrationBatch.registrations = vm.registrationBatch.registrations.data

                vm.registrationBatch.registrations = _.map(vm.registrationBatch.registrations, function(data) {
                    return RegistrationFactory.transform(data)
                })
            }

            return vm.registrationBatch
        }
    })
