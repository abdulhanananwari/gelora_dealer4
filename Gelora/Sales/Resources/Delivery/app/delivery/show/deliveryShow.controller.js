geloraDelivery
    .controller('DeliveryShowController', function(
        $state, $scope,SalesOrderModel,
        SalesOrderExtraSharedModel, UnitModel, ConfigModel,
        LinkFactory, JwtValidator) {

        var vm = this

        ConfigModel.get('gelora.delivery.types')
            .then(function(res) {
                vm.deliveryTypes = res.data.data
            })

        vm.generateDelivery = function(salesOrder, unit) {
         
            SalesOrderModel.delivery.generate(salesOrder.id, unit)
                .then(function(res) {
                   assignData(res.data)
                })
        }

        vm.deselectUnit = function() {

            if (confirm('Yakin mau hapus pilihan unit?')) {

                SalesOrderModel.unit.deselect(vm.salesOrder.id)
                    .then(function(res) {
                        assignData(res.data)
                    })
            }

        }

        vm.scan = function() {
            window.open('zxing://scan/?ret=' + encodeURIComponent(LinkFactory.dealer.sales.salesOrder.scan + vm.salesOrder.id + '/scan/{CODE}/' + '?' + $.param({ jwt: JwtValidator.encodedJwt })));
        }

        vm.generateDeliveryNote = function() {
            window.open(LinkFactory.dealer.sales.salesOrder.print + vm.salesOrder.id + '?' + $.param({ jwt: JwtValidator.encodedJwt }));
        }

        // vm.selectDeliveryBatch = function(deliveryBatchId) {

        //     DeliveryModel.deliveryBatch.select($state.params.id, deliveryBatchId, { with: 'deliveryBatch' })
        //         .then(function(res) {

        //             assignMainData(res.data)
        //         })
        // }

        // vm.deselectDeliveryBatch = function() {

        //     DeliveryModel.deliveryBatch.deselect($state.params.id, { with: 'deliveryBatch' })
        //         .then(function(res) {

        //             assignMainData(res.data)
        //         })
        // }

        vm.setHandoverLocation = function() {

            navigator.geolocation.getCurrentPosition(function(position) {

                vm.salesOrder.delivery.handover_lat = position.coords.latitude
                vm.salesOrder.delivery.handover_lon = position.coords.longitude

                $scope.$apply()
            })
        }

        vm.handover = function(salesOrder, status) {

            if (!status && !confirm('Yakin delivery GAGAL?')) {
                return
            }

            SalesOrderModel.delivery.handover(salesOrder.id,salesOrder, { status: status })
                .then(function(res) {
                    assignData(res.data)
                    alert('Serah terima berhasil dibuat');
                })
        }
        // vm.cancelDelivery = function(delivery) {
        //     if (confirm('Yakin Mau membatalkan delivery?')) {

        //         DeliveryModel.action.cancel(delivery.id, delivery)
        //             .then(function(res) {
        //                 assignMainData(res.data)
        //                 alert('Delivery Berhasil Dibatalkan')
        //             })
        //     }
        // }

        if ($state.params.id) {

            // var params = {
            //     with: 'deliveryBatch'
            // }

            SalesOrderModel.get($state.params.id)
                .then(function(res) {

                   assignData(res.data)

                    vm.unitSearchAdditionalParams = {
                         statuses_in: 'IN_STOCK_SELLABLE',
                         type_code: vm.salesOrder.vehicle.code,
                     }

                })
        }

        // } else if ($state.params.salesOrderId) {

        //     SalesOrderModel.get($state.params.salesOrderId)
        //         .then(function(res) {

        //             vm.delivery = {
        //                 salesOrder: res.data.data
        //             }

        //             vm.unitSearchAdditionalParams = {
        //                 statuses_in: 'IN_STOCK_SELLABLE',
        //                 type_code: vm.delivery.salesOrder.vehicle.code,
        //             }

        //         })

        // }
        function assignData(data) {

            vm.salesOrder = data.data

            if (data.data.unit) {
                vm.salesOrder.unit = data.data.unit.data
                if (data.data.unit.currentLocation) {
                    vm.salesOrder.unit.currentLocation = data.data.unit.currentLocation.data
                }
            }
        }
        // function assignMainData(data) {

        //     vm.delivery = data.data

        //     if (data.data.salesOrder) {
        //         vm.delivery.salesOrder = data.data.salesOrder.data
        //     }


        //     if (data.data.unit) {
        //         vm.delivery.unit = data.data.unit.data
        //         if (data.data.unit.currentLocation) {
        //             vm.delivery.unit.currentLocation = data.data.unit.currentLocation.data
        //         }
        //     }

        //     if (data.data.deliveryBatch) {
        //         vm.delivery.deliveryBatch = data.data.deliveryBatch.data
        //     }

        //     vm.unitSearchAdditionalParams = {
        //         statuses_in: 'IN_STOCK_SELLABLE',
        //         type_code: vm.delivery.salesOrder.vehicle.code,
        //         color_code: vm.delivery.salesOrder.vehicle.variant.code
        //     }
        // }

        vm.fileManager = {
            handoverIndentification: {
                displayedInput: JSON.stringify({
                    file: { label: "KTP / ID Card Penerima", show: true },
                }),
                additionalData: JSON.stringify({
                    image: { resize: { height: 1300, width: 1300 } },
                    path: 'delivery',
                    subpath: $state.params.id + '/receiver-identification',
                    fileable_type: 'Delivery',
                    fileable_id: $state.params.id,
                    name: 'Receiver Identification'
                }),
                validations: JSON.stringify({
                    fileSize: 1024
                })
            },
            handover: {
                displayedInput: JSON.stringify({
                    file: { label: "Serah Terima", show: true },
                }),
                additionalData: JSON.stringify({
                    image: { resize: { height: 1300, width: 1300 } },
                    path: 'delivery',
                    subpath: $state.params.id + '/handover',
                    fileable_type: 'Delivery',
                    fileable_id: $state.params.id,
                    name: 'Handover'
                }),
                validations: JSON.stringify({
                    fileSize: 1024
                })
            }
        }
    })
