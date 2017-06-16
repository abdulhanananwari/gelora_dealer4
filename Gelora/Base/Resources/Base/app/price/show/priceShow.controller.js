geloraBase
    .controller('PriceShowController', function(
        $state,
        PriceModel,
        ModelModel) {

        var vm = this

        vm.params = {}

        vm.store = function(price) {

            if (!price.created_at) {

                PriceModel.extensive.store(price, vm.params)
                    .then(function(res) {
                        $state.go('priceShow', { id: res.data.data.model_id })
                    })

            } else {

                PriceModel.extensive.update(price.model_id, price, vm.params)
                    .then(function(res) {
                        vm.price = res.data.data
                        alert('Data Berhasil Di Update')
                    })

            }
        }

        if ($state.params.id) {

            PriceModel.extensive.get($state.params.id, vm.params)
                .then(function(res) {
                    vm.price = res.data.data
                })
        }

        PriceModel.index({ transformer: "PricePlafondGroupTransformer" })
            .then(function(res) {
                var plafondGroups = _.map(res.data.data, 'plafond_group')
                $('input#plafond-group').autocomplete({
                    source: plafondGroups
                })
            })

    })
