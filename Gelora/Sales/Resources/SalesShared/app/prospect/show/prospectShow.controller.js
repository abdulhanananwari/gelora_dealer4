geloraSalesShared
    .controller('ProspectShowController', function(
        $state, $scope, JwtValidator, SolumaxLoading,
        ProspectModel, PersonnelModel) {

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

        $('.date').datepicker({
            dateFormat: "yy-mm-dd",
            yearRange: 'c-90:c-10',
            changeYear: true,
            changeMonth: true
        });

        vm.copyRegistrationFromCustomer = function() {
            vm.prospect.registration = angular.copy(vm.prospect.customer)
        }

        vm.store = function(prospect) {

            if (prospect.id) {

                ProspectModel.update(prospect.id, prospect)
                    .then(function(res) {
                        vm.prospect = res.data.data
                        alert('Berhasil mengupdate Prospect');
                    })

            } else {


                SolumaxLoading.start()

                ProspectModel.store(prospect)
                    .then(function(res) {
                        $state.go('prospectShow', { id: res.data.data.id })
                    })
            }
        }

        vm.close = function(prospect, requestCreateSalesOrder) {

            prospect.create_sales_order_request = requestCreateSalesOrder

            ProspectModel.action.close(prospect.id, prospect)
                .then(function(res) {
                    vm.prospect = res.data.data
                    alert('Berhasil mengkonfirmasi prospect');
                })
        }

        vm.respond = function(prospect, respond) {

            prospect.create_sales_order_response = respond

            SolumaxLoading.start()

            ProspectModel.action.respond(prospect.id, prospect)
                .then(function(res) {

                    vm.prospect = res.data.data
                    alert('Berhasil merespond prospect');
                    SolumaxLoading.stop()

                }, function(res) {

                    SolumaxLoading.stop()

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

            ProspectModel.get($state.params.id)
                .then(function(res) {
                    vm.prospect = res.data.data
                })

        } else {

            PersonnelModel.index({ user_id: JwtValidator.decodedJwt.sub, unique: true })
                .then(function(res) {
                    vm.prospect.salesPersonnel = res.data.data
                })
        }

    })
