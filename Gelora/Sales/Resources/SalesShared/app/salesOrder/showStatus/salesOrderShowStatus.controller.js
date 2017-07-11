geloraSalesShared
    .controller('SalesOrderShowStatusController', function(
        $state,
        LinkFactory,
        SalesOrderModel, CancelledSalesOrderSharedModel) {

        var vm = this

        var validationBypasses = {}

        function load() {

            SalesOrderModel.get($state.params.id, { include: 'salesOrderExtras' })
                .then(function(res) {

                    vm.salesOrder = res.data.data
                    vm.salesOrder.salesOrderExtras = res.data.data.salesOrderExtras.data

                })
        }
        load()

        vm.store = function(salesOrder) {

            SalesOrderModel.specificUpdate.plafond(salesOrder.id, _.pick(salesOrder, ['plafond']))
                .then(function(res) {
                    vm.salesOrder = res.data.data
                    alert('Berhasil mengupdate SPK');
                })

        }

        vm.action = {
            lock: function() {

                SalesOrderModel.action.lock.lock($state.params.id)
                    .then(function(res) {
                        vm.salesOrder = res.data.data
                    })
            },
            validate: function() {

                SalesOrderModel.action.validation.validate($state.params.id, validationBypasses)
                    .then(function(res) {
                        vm.salesOrder = res.data.data
                    }, function(res) {

                        if (res.userResponse) {
                            _.assignWith(validationBypasses, res.userResponse)
                            vm.action.validate()
                        }

                    })
            },
            unvalidate: function() {

                SalesOrderModel.action.validation.unvalidate($state.params.id)
                    .then(function(res) {
                        vm.salesOrder = res.data.data
                    })
            },
            indent: function(note) {

                SalesOrderModel.action.indent.indent($state.params.id, note)
                    .then(function(res) {
                        alert('Data indent berhasil dibuat')
                        vm.salesOrder = res.data.data
                    })
            },
            cancel: function(cancellation) {

                cancellation.sales_order_id = vm.salesOrder.id

                CancelledSalesOrderSharedModel.store(cancellation)
                    .then(function(res) {
                        alert('SPK berhasil dibatalkan')
                    })
            }
        }
    })
