geloraPolReg
    .controller('AgencySubmissionBatchShowController', function(
        $state,
        AgencySubmissionBatchModel, LinkFactory, JwtValidator) {

        var vm = this

        var defaultIncludes = {
            with: 'registrations.delivery.salesOrder, registrations.delivery.unit'
        }

        vm.registrationBatch = {}

        vm.store = function(registrationBatch) {

            if (registrationBatch.id) {

                AgencySubmissionBatchModel.update(registrationBatch.id, registrationBatch)
                    .then(function(res) {
                        alert('Batch Berhasil Diupdate')
                        assignData(res.data)
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

            AgencySubmissionBatchModel.close(registrationBatch.id, defaultIncludes)
                .then(function(res) {
                    alert('Batch Berhasil Ditutup')
                    assignData(res.data)
                })

        }
        vm.generateReceipt = function(registrationBatch) {
            window.open(LinkFactory.dealer.polReg.registrationAgencySubmissionBatch.views + 'generate-agency-receipt/' + registrationBatch.id + '?' + $.param({ jwt: JwtValidator.encodedJwt }));
        }
        vm.handover = function(registrationBatch) {
            AgencySubmissionBatchModel.handover(registrationBatch.id, defaultIncludes)
                .then(function(res) {
                    assignData(res.data)
                })
        }

        if ($state.params.id) {

            AgencySubmissionBatchModel.get($state.params.id, defaultIncludes)
                .then(function(res) {
                    assignData(res.data)
                })
        }

        function assignData(data) {

            vm.registrationBatch = data.data

            if (vm.registrationBatch.registrations) {

                vm.registrationBatch.registrations = vm.registrationBatch.registrations.data

                vm.registrationBatch.registrations = _.map(vm.registrationBatch.registrations, function(data) {

                    return RegistrationFactory.transform(data)
                })
            }
            return vm.registrationBatch
        }
    })
