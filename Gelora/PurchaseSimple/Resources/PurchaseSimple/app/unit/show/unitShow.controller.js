geloraPurchaseSimple
        .controller('UnitShowController', function (
                $state,
                UnitModel) {

            var vm = this

            vm.store = function (unit) {

                if (!unit.id) {

                    UnitModel.store(unit)
                            .then(function (res) {
                                alert('Unit berhasil disimpan')
                                $state.go('unitShow', {id: res.data.data.id})
                            })

                } else {

                    UnitModel.update(unit.id, unit)
                            .then(function (res) {
                                vm.unit = res.data.data
                                alert('Unit berhasil diupdate')
                            })
                }
            }

            if ($state.params.id) {

                UnitModel.get($state.params.id)
                        .then(function (res) {
                            vm.unit = res.data.data
                        })

            } else {
                
                vm.unit = {
                    current_status: 'UNRECEIVED'
                }
            }
        })