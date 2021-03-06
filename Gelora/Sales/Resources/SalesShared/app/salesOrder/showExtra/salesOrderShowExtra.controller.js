geloraSalesShared
    .controller('SalesOrderShowExtraController', function(
        $scope, $state,
        SalesOrderModel, SalesOrderExtraSharedModel, SalesProgramModel, SalesExtraModel,
        LinkFactory, JwtValidator) {

        var vm = this

        function load() {

            vm.focused = null

            SalesOrderModel.get($state.params.id, { include: 'salesOrderExtras' })
                .then(function(res) {

                    vm.salesOrder = res.data.data
                    vm.salesOrder.salesOrderExtras = res.data.data.salesOrderExtras.data

                })
        }
        load()

        vm.storeFocused = function(salesOrderExtra) {

            salesOrderExtra.sales_order_id = vm.salesOrder.id

            if (salesOrderExtra.id) {

                SalesOrderExtraSharedModel.update(salesOrderExtra.id, salesOrderExtra)
                    .then(function() {
                        load()
                    })

            } else {

                SalesOrderExtraSharedModel.store(salesOrderExtra)
                    .then(function() {
                        load()
                    })
            }
        }

        vm.deleteFocused = function(salesOrderExtra) {

            if (confirm('Yakin mau hapus?')) {

                SalesOrderExtraSharedModel.delete(salesOrderExtra.id)
                    .then(function() {
                        load()
                    })
            }

        }

        vm.createHandover = function(salesOrderExtra) {

            if (confirm('Mau buat serah terima untuk ' + salesOrderExtra.item_name)) {

                var receiverName = prompt('Nama penerima')

                var params = {
                    jwt: JwtValidator.encodedJwt,
                    receiver_name: receiverName
                }

                window.open(LinkFactory.dealer.sales.salesOrderExtra.views + salesOrderExtra.id + '/generate-receipt-handover/?' + $.param(params))
            }

        }

        SalesProgramModel.index({ active: true })
            .then(function(res) {
                vm.salesPrograms = res.data.data
            })

        SalesExtraModel.index()
            .then(function(res) {
                vm.salesExtras = res.data.data
            })

    })