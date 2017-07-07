geloraSalesShared
    .controller('SalesOrderShowNoteController', function(
        $state,
        SalesOrderModel) {

        var vm = this

        SalesOrderModel.get($state.params.id)
            .then(function(res) {
                vm.salesOrder = res.data.data
            })

        vm.store = function(note) {


            SalesOrderModel.specificUpdate.insertNote(vm.salesOrder.id, note)
                .then(function(res) {
                    vm.salesOrder = res.data.data
                    note = {}
                    alert('Note berhasil disimpan')
                })
        }

    })
