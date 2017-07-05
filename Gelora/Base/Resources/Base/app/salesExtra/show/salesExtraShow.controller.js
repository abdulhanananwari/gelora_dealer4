geloraBase
    .controller('SalesExtraShowController', function(
        $state,
        ConfigModel,
        SalesExtraModel) {

        var vm = this

        ConfigModel.get('gelora.base.salesExtras')
            .then(function(res) {
                vm.types = res.data.data.types
            })

        vm.store = function(salesExtra) {

            if (!salesExtra.id) {

                SalesExtraModel.store(salesExtra)
                    .then(function(res) {
                        alert('Sales Extra Berhasil Disimpan')
                        $state.go('salesExtraShow', { id: res.data.data.id })
                    })

            } else {

                SalesExtraModel.update(salesExtra.id, salesExtra)
                    .then(function(res) {
                        alert('Sales Extra berhasil diupdate')
                        vm.salesExtra = res.data.data
                    })

            }
        }


        if ($state.params.id) {

            SalesExtraModel.get($state.params.id)
                .then(function(res) {
                    vm.salesExtra = res.data.data
                })
        }
    })
