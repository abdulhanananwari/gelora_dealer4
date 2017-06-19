geloraPolReg
    .controller('RegistrationLeasingBpkbSubmissionBatchShowController', function(
        $state,
        RegistrationLeasingBpkbSubmissionBatchModel,
        RegistrationFactory, LinkFactory, JwtValidator) {

        var vm = this


        var defaultIncludes = {
            with: 'registrations.delivery.salesOrder,registrations.delivery.unit'
        }

        vm.registrationBatch = {}

        vm.store = function(registrationBatch) {

            if (registrationBatch.id) {

                RegistrationLeasingBpkbSubmissionBatchModel.update(registrationBatch.id, registrationBatch)
                    .then(function(res) {
                        assignData(res.data)
                    })

            } else {

                RegistrationLeasingBpkbSubmissionBatchModel.store(registrationBatch)
                    .then(function(res) {
                        $state.go('registrationLeasingBpkbSubmissionBatchShow', { id: res.data.data.id })
                    })

            }
        }

        vm.close = function(registrationBatch) {

            RegistrationLeasingBpkbSubmissionBatchModel.close(registrationBatch.id, defaultIncludes)
                .then(function(res) {
                    assignData(res.data)
                })

        }

        vm.handover = function(registrationBatch) {

            RegistrationLeasingBpkbSubmissionBatchModel.handover(registrationBatch.id, defaultIncludes)
                .then(function(res) {
                    assignData(res.data)
                })
        }

        vm.generateReceipt = function(registrationBatch) {
            window.open(LinkFactory.dealer.polReg.registrationLeasingBpkbSubmissionBatch.views + 'generate-leasing-bpkb-receipt/' + registrationBatch.id + '?' + $.param({ jwt: JwtValidator.encodedJwt }));
        }

        if ($state.params.id) {

            RegistrationLeasingBpkbSubmissionBatchModel.get($state.params.id, defaultIncludes)
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

        vm.fileManager = {
            leasingBpkb: {
                displayedInput: JSON.stringify({
                    file: { label: "Bukti Tanda Terima BPKB ke Leasing", show: true },
                }),
                additionalData: JSON.stringify({
                    image: { resize: { height: 1300, width: 1300 } },
                    path: 'registration-leasing-bpkb',
                    subpath: $state.params.id,
                    fileable_type: 'RegistrationLeasingBpkb',
                    fileable_id: $state.params.id,
                    name: 'Leasing Bpkb'
                }),
            }
        }

    })
