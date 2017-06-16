geloraSalesAdmin
    .controller('SalesOrderShowController', function(
        $state, $scope,
        SalesOrderModel) {

        var vm = this

        $scope._ = _

        vm.currentStateName = $state.current.name

        vm.salesOrder = {
            id: $state.params.id,
            sales_condition: 'isi',
            payment_type: 'credit',
            mediator_fee: 0,
            discount: 0
        }

        vm.idTypes = ['KTP', 'NPWP']
        vm.customerTypes = ['Perorangan', 'Badan Usaha']
        vm.salesConditions = { 'isi': 'On The Road', 'kosong': 'Off The Road' }
        vm.paymentTypes = { 'credit': 'Kredit', 'cash': 'Kas' }

        vm.copyRegistrationFromCustomer = function() {
            vm.salesOrder.registration = angular.copy(vm.salesOrder.customer);
        }

        vm.store = function(salesOrder) {

            if (salesOrder.id) {

                SalesOrderModel.update(salesOrder.id, salesOrder)
                    .then(function(res) {
                        vm.salesOrder = res.data.data
                        alert('Berhasil mengupdate SPK');
                    })

            } else {

                document.dispatchEvent(new CustomEvent("loading"))

                SalesOrderModel.store(salesOrder)
                    .then(function(res) {
                        $state.go('salesOrderShow', { id: res.data.data.id })
                    })
            }
        }

        if ($state.params.id) {

            SalesOrderModel.get($state.params.id)
                .then(function(res) {
                    vm.salesOrder = res.data.data
                })
        }


        vm.fileManager = {
            customerIdentification: {
                displayedInput: JSON.stringify({
                    file: { label: "KTP / ID Card Kustomer", show: true },
                }),
                additionalData: JSON.stringify({
                    image: { resize: { height: 1300, width: 1300 } },
                    path: 'sales-order',
                    subpath: $state.params.id + '/customer-identification',
                    fileable_type: 'SalesOrder',
                    fileable_id: $state.params.id,
                    name: 'Customer Identification'
                }),
                validations: JSON.stringify({
                    // fileSize: 2048
                })
            },
            registrationIdentification: {
                displayedInput: JSON.stringify({
                    file: { label: "KTP / ID  (Untuk STNK)", show: true },
                }),
                additionalData: JSON.stringify({
                    image: { resize: { height: 1300, width: 1300 } },
                    path: 'sales-order',
                    subpath: $state.params.id + '/registration-identification',
                    fileable_type: 'SalesOrder',
                    fileable_id: $state.params.id,
                    name: 'Registration Identification'
                }),
                validations: JSON.stringify({
                    // fileSize: 2048
                })
            },
            mediatorIdentification: {
                displayedInput: JSON.stringify({
                    file: { label: "KTP / ID  Card Mediator", show: true },
                }),
                additionalData: JSON.stringify({
                    image: { resize: { height: 1300, width: 1300 } },
                    path: 'sales-order',
                    subpath: $state.params.id + '/mediator-identification',
                    fileable_type: 'SalesOrder',
                    fileable_id: $state.params.id,
                    name: 'Mediator Identification'
                }),
                validations: JSON.stringify({
                    // fileSize: 2048
                })
            }

        }
    })
