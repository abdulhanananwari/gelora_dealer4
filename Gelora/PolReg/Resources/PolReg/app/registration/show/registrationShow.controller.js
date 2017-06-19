geloraPolReg
    .controller('RegistrationShowController', function(
        $state, $scope,
        ConfigModel, JwtValidator,
        RegistrationModel, RegistrationFactory, DeliveryModel,
        RegistrationMdSubmissionBatchModel,
        RegistrationAgencySubmissionBatchModel,
        RegistrationAgencyInvoiceModel,
        RegistrationLeasingBpkbSubmissionBatchModel) {

        var vm = this

        var defaultIncludes = { include: 'delivery.salesOrder,cddb' }
        var deliveryIncludes = { with: 'salesOrder.cddb,unit' }

        vm.generateFromDelivery = function(registration) {

            RegistrationModel.action.generateFromDelivery(registration.delivery.id, defaultIncludes)
                .then(function(res) {
                    $state.go('registrationShow', { id: res.data.data.id })
                })
        }

        if ($state.params.id) {

            RegistrationModel.get($state.params.id, defaultIncludes)
                .then(function(res) {
                    vm.registration = RegistrationFactory.transform(res.data.data)
                })

        } else if ($state.params.deliveryId) {

            DeliveryModel.get($state.params.deliveryId, deliveryIncludes)
                .then(function(res) {
                    vm.registration = RegistrationFactory.transform({ delivery: res.data })
                })

        }

        $scope.$watch(function() { return vm.items }, function(newValue) {

            console.log(newValue)

            var completedItems = _.map(_.filter(newValue, function(item) {
                return item.incoming && !item.outgoing
            }), 'name').join(', ')

            vm.smsString = 'Kepada Yth ' + vm.registration.delivery.salesOrder.customer.name + '. Proses ' +  completedItems + ' sudah selesai. Silahkan diambil di dealer'
            console.log(vm.smsString)
        })

    })
