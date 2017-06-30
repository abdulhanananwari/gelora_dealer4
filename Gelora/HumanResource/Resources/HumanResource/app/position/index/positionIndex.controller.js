geloraHumanResource
    .controller('PositionIndexController', function(
        SettingModel, ConfigModel) {

        var vm = this

        SettingModel.index({ settable_type: 'Position' })
            .then(function(res) {
                vm.positions = _.map(res.data.data, 'data_1')
            })

        ConfigModel.get('gelora.humanResource.availablePositions')
            .then(function(res) {
                vm.availablePositions = res.data.data
            })


        vm.store = function(position) {

            SettingModel.store({ settable_type: 'Position', data_1: position })
                .success(function() {

                })
        }


    })
