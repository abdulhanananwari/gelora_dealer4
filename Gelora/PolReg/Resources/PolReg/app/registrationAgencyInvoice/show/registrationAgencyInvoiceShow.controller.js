geloraPolReg
    .controller('RegistrationAgencyInvoiceShowController', function(
        $state,
        ConfigModel, JwtValidator,
        RegistrationModel, RegistrationFactory,
        RegistrationAgencyInvoiceModel) {

        var vm = this

        var defaultIncludes = {
            with: 'registrations.delivery.salesOrder,registrations.delivery.unit'
        }

        vm.registrationBatch = {}

        vm.store = function(registrationBatch) {

            if (registrationBatch.id) {

                RegistrationAgencyInvoiceModel.update(registrationBatch.id, registrationBatch, defaultIncludes)
                    .then(function(res) {
                        alert('Batch Berhasil Diupdate')
                        assignData(res.data)
                    })

            } else {

                RegistrationAgencyInvoiceModel.store(registrationBatch, defaultIncludes)
                    .then(function(res) {
                        alert('Batch Berhasil Disimpan')
                        $state.go('registrationAgencyInvoiceShow', { id: res.data.data.id })
                    })

            }

        }

        vm.close = function(registrationBatch) {

            RegistrationAgencyInvoiceModel.close(registrationBatch.id, registrationBatch, defaultIncludes)
                .then(function(res) {
                    alert('Batch Berhasil Ditutup')
                    assignData(res.data)
                })

        }

        if ($state.params.id) {

            RegistrationAgencyInvoiceModel.get($state.params.id, defaultIncludes)
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
            agencyInvoice: {
                displayedInput: JSON.stringify({
                    file: { label: "Kwitansi Penagihan BPKB Kendaraan Bermotor", show: true },
                }),
                additionalData: JSON.stringify({
                    image: { resize: { height: 1300, width: 1300 } },
                    path: 'registration-agency-invoice',
                    subpath: $state.params.id,
                    fileable_type: 'RegistrationAgencyInvoice',
                    fileable_id: $state.params.id,
                    name: 'Agency Invoice'
                })
            }
        }
    })
