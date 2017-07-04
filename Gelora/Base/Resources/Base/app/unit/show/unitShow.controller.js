geloraBase
    .controller('UnitShowController', function(
        $state,
        UnitModel) {

        var vm = this

        vm.id = $state.params.id

        UnitModel.get($state.params.id)
            .then(function(res) {
                vm.unit = res.data.data
            })

        vm.action = {
            receive: function(unit, location) {
                UnitModel.action.receive(unit.id, { location_id: location.id })
                    .then(function(res) {
                        vm.unit = res.data.data
                    })
            },
            pdi: function(unit) {

                var dialog = $('<p>PDI berhasil dan unit dalam keadaan baik?</p>').dialog({
                    buttons: {
                        "Yes": function() {

                            UnitModel.action.pdi(unit.id, { pdi_success: true })
                                .then(function(res) {
                                    vm.unit = res.data.data
                                    dialog.dialog('close')
                                })
                        },
                        "Tidak": function() {
                            UnitModel.action.pdi(unit.id, { pdi_success: false })
                                .then(function(res) {
                                    vm.unit = res.data.data
                                    dialog.dialog('close')
                                })
                        },
                        "Batal": function() {

                            dialog.dialog('close')
                        }
                    }
                })

            }
        }
    })
