geloraSalesAdmin
    .controller('SalesOrderShowDeliveryController', function(
        $state, $scope,
        LinkFactory,
        SalesOrderModel, ConfigModel) {

        var vm = this

        SalesOrderModel.get($state.params.id)
            .then(function(res) {
                vm.salesOrder = res.data.data
            })

        ConfigModel.get('gelora.delivery.types')
            .then(function(res) {
                vm.deliveryTypes = res.data.data
            })

        ConfigModel.get('services.google.api_credential')
            .then(function(res) {
                vm.googleApiKey = res.data.data
            })

        vm.store = function(salesOrder) {

            SalesOrderModel.specificUpdate.deliveryRequest(salesOrder.id, _.pick(salesOrder, ['deliveryRequest']))
                .then(function(res) {
                    vm.salesOrder = res.data.data
                    alert('Delivery request berhasil diupdate')
                });
        }

        vm.delivery = {
            generate: function(salesOrder, unit) {
                SalesOrderModel.delivery.generate(salesOrder.id, unit)
                    .then(function(res) {
                        alert('SJ berhasil digenerate')
                        vm.salesOrder = res.data.data
                    })
            },
            scan: function(salesOrder, scannedUnit) {
                SalesOrderModel.delivery.scan(salesOrder.id, scannedUnit)
                    .then(function(res) {
                        alert('Unit yang di scan cocok')
                        vm.salesOrder = res.data.data
                    })
            },
            travelStart: function(salesOrder) {
                SalesOrderModel.delivery.travelStart(salesOrder.id)
                    .then(function(res) {
                        alert('Pengiriman unit dimulai')
                        vm.salesOrder = res.data.data
                    })
            },
            handover: function(salesOrder, handover, params) {
                SalesOrderModel.delivery.handover(salesOrder.id, handover, params)
                    .then(function(res) {
                        alert('Penerimaan unit berhasil dikonfirmasi')
                        vm.salesOrder = res.data.data
                    }, function(res) {
                        console.log(res)
                        if (res.userResponse) {
                            vm.delivery.handover(salesOrder, handover, res.userResponse)
                        }
                    })
            },
            cancel: function(salesOrder) {
                SalesOrderModel.delivery.cancel(salesOrder.id)
                    .then(function(res) {
                        alert('SJ berhasil dibatalkan')
                        vm.salesOrder = res.data.data
                    })
            },
            setHandoverLocation: function() {

                navigator.geolocation.getCurrentPosition(function(position) {

                    if (typeof vm.salesOrder.delivery.handover == 'undefined') { vm.salesOrder.delivery.handover = {} }
                    vm.salesOrder.delivery.handover.lat = position.coords.latitude
                    vm.salesOrder.delivery.handover.lon = position.coords.longitude

                    $scope.$apply()
                })
            }

        }

    })
