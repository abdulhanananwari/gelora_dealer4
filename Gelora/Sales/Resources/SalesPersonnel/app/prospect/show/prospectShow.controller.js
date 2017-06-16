geloraSalesPersonnel
    .controller('ProspectShowController', function(
        $state, $scope, JwtValidator,
        ProspectSalesPersonnelModel, PersonnelModel) {

        var vm = this


        $scope._ = _

        vm.prospect = {
            id: $state.params.id,
            sales_condition: 'isi',
            payment_type: 'credit',
            mediator_fee: 0,
            discount: 0,
        }

        vm.newFollowUp = {
            date: moment().format("YYYY-MM-DD"),
        }

        vm.idTypes = ['KTP', 'NPWP']
        vm.customerTypes = ['Perorangan', 'Badan Usaha']
        vm.salesConditions = { 'isi': 'On The Road', 'kosong': 'Off The Road' }
        vm.paymentTypes = { 'credit': 'Kredit', 'cash': 'Kas' }



        vm.copyRegistrationFromCustomer = function() {
            vm.prospect.registration = angular.copy(vm.prospect.customer);
        }
        vm.store = function(prospect) {

            if (prospect.id) {

                ProspectSalesPersonnelModel.update(prospect.id, prospect)
                    .then(function(res) {
                        vm.prospect = res.data.data
                        alert('Berhasil mengupdate SPK');
                    })

            } else {

                ProspectSalesPersonnelModel.store(prospect)
                    .then(function(res) {
                        $state.go('prospectShow', { id: res.data.data.id })
                    })
            }
        }

        vm.close = function(prospect) {

            ProspectSalesPersonnelModel.close(prospect.id, prospect)
                .then(function(res) {
                    vm.prospect = res.data.data
                    alert('Berhasil mengkonfirmasi SPK');
                })
        }

        vm.respond = function(prospect, params) {

            ProspectSalesPersonnelModel.respond(prospect.id, prospect, params)
                .then(function(res) {
                    vm.prospect = res.data.data
                    alert('Berhasil merespond SPK');
                }, function(res) {

                    if (res.userResponse) {
                        vm.respond(prospect, res.userResponse)
                    }
                })


        }

        vm.followUp = {
            store: function(followUp) {

                vm.prospect.follow_ups.push(followUp)

                vm.store(vm.prospect)
            },
            storeResult: function(followUp) {

                followUp.completed_at = new Date()
                vm.store(vm.prospect)
            }
        }

        if ($state.params.id) {

            ProspectSalesPersonnelModel.get($state.params.id)
                .then(function(res) {
                    vm.prospect = res.data.data
                })

        } else {

            PersonnelModel.index({ user_id: JwtValidator.decodedJwt.sub, unique: true })
                .then(function(res) {
                    vm.prospect.salesPersonnel = res.data.data
                })

        }


        vm.fileManager = {
            customerIdentification: {
                displayedInput: JSON.stringify({
                    file: { label: "KTP / ID Card Kustomer", show: true },
                }),
                additionalData: JSON.stringify({
                    image: { resize: { height: 1300, width: 1300 } },
                    path: 'prospect',
                    subpath: $state.params.id + '/customer-identification',
                    fileable_type: 'Prospect',
                    fileable_id: $state.params.id,
                    name: 'Customer Identification'
                })
            },
            registrationIdentification: {
                displayedInput: JSON.stringify({
                    file: { label: "KTP / ID  (Untuk STNK)", show: true },
                }),
                additionalData: JSON.stringify({
                    image: { resize: { height: 1300, width: 1300 } },
                    path: 'prospect',
                    subpath: $state.params.id + '/registration-identification',
                    fileable_type: 'Prospect',
                    fileable_id: $state.params.id,
                    name: 'Registration Identification'
                })
            },
            mediatorIdentification: {
                displayedInput: JSON.stringify({
                    file: { label: "KTP / ID  Card Mediator", show: true },
                }),
                additionalData: JSON.stringify({
                    image: { resize: { height: 1300, width: 1300 } },
                    path: 'prospect',
                    subpath: $state.params.id + '/mediator-identification',
                    fileable_type: 'Prospect',
                    fileable_id: $state.params.id,
                    name: 'Mediator Identification'
                })
            }

        }
    })
