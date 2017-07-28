geloraSalesShared
    .controller('SalesOrderShowDeliveryController', function(
        $state, $scope,
        LinkFactory, JwtValidator, SettingModel,
        SalesOrderModel, ConfigModel) {

        var vm = this

        SalesOrderModel.get($state.params.id)
            .then(function(res) {
                vm.salesOrder = res.data.data
                if (vm.salesOrder.delivery.generated_at) {
                    loadDrivers()
                }
            })

        ConfigModel.get('gelora.delivery.types')
            .then(function(res) {
                vm.deliveryTypes = res.data.data
            })

        ConfigModel.get('services.google.api_credential')
            .then(function(res) {
                vm.googleApiKey = res.data.data
            })

        function loadDrivers() {

            SettingModel.index({ object_type: 'DRIVERS', single: true })
                .then(function(res) {
                    vm.drivers = res.data.data.data_1
                })
        }

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
                        loadDrivers()
                    })
            },
            update: function(salesOrder) {

                SalesOrderModel.delivery.update(salesOrder.id, salesOrder.delivery)
                    .then(function(res) {
                        alert('SJ berhasil update')
                        vm.salesOrder = res.data.data
                    })
            },
            updateAfterHandoverCreated: function(salesOrder) {

                SalesOrderModel.delivery.updateAfterHandoverCreated(salesOrder.id, salesOrder.delivery)
                    .then(function(res) {
                        alert('SJ berhasil update')
                        vm.salesOrder = res.data.data
                    })
            },
            generateDeliveryNote: function() {
                window.open(LinkFactory.dealer.sales.salesOrder.delivery.views + 'generate-delivery-note/' + vm.salesOrder.id + '?' + $.param({ jwt: JwtValidator.encodedJwt }));
            },
            generateServiceBookBarcodeLabel: function(salesOrder) {
                window.open(LinkFactory.dealer.sales.salesOrder.views + salesOrder.id + '/document/service-book-barcode-label/?jwt=' + JwtValidator.encodedJwt)
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
                        if (res.userResponse) {
                            vm.delivery.handover(salesOrder, handover, res.userResponse)
                        }
                    })
            },
            handoverConfirmation: function(salesOrder, handoverConfirmation, params) {
                if (confirm('Yakin mau BAST SJ?')) {

                    SalesOrderModel.delivery.handoverConfirmation(salesOrder.id, handoverConfirmation, params)
                        .then(function(res) {
                            alert('Serah terima unit berhasil dikonfirmasi')
                            vm.salesOrder = res.data.data
                        })
                }
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

                    if (typeof vm.salesOrder.delivery.handover == 'undefined') {
                        vm.salesOrder.delivery.handover = {}
                    }

                    vm.salesOrder.delivery.handover.location = {
                        lng: position.coords.longitude,
                        lat: position.coords.latitude
                    }

                    console.log(vm.salesOrder.delivery.handover)

                    $scope.$apply()
                })
            }

        }

    })