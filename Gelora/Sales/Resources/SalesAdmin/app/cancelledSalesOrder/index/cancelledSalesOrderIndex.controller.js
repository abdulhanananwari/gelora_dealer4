geloraSalesAdmin
    .controller('CancelledSalesOrderIndexController', function(
        $state,
        CancelledSalesOrderSharedModel) {

        var vm = this
        
        vm.filter = {
            paginate: 20,
            restored_at: null,
            order_by: 'created_at',
            order: 'desc'
        }
        
        vm.load = function(page) {

            if (page) {
                vm.filter.page = page
            }

            CancelledSalesOrderSharedModel.index(vm.filter)
                .then(function(res) {
                    vm.cancelledSalesOrders = res.data.data
                    vm.meta = res.data.meta
                })
        }
        vm.load(1)

        vm.restore = function(cancelledSalesOrder) {

            if (confirm('Yakin mau restore SPK ? ')) {

                CancelledSalesOrderSharedModel.restore(cancelledSalesOrder.id, cancelledSalesOrder)
                    .then(function(res) {
                        alert('Data SPK berhasil di restore')
                        $state.go('salesOrderShow', { id: res.data.data.salesOrder.id })
                    })
            }

        }
    })
