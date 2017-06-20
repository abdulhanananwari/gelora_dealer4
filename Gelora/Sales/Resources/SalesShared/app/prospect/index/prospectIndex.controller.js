geloraSalesShared
    .controller('ProspectIndexController', function(
        ProspectModel, ConfigModel) {

        var vm = this

        vm.types = {
            salespersonnel: [
                { code: 'self', name: 'Sendiri' },
                { code: 'team', name: 'Team' },
            ],
            admin: [
                { code: 'self', name: 'Sendiri' },
                { code: 'team', name: 'Team' },
                { code: 'all', name: 'Semua' },
            ]
        }

        vm.filter = {
            type: 'self'
        }

        vm.load = function(filter) {
            ProspectModel.index(filter)
                .then(function(res) {
                    vm.prospects = res.data.data
                })
        }

        ConfigModel.get('gelora.sales.prospectProgressQuery')
            .then(function(res) {
                vm.statuses = res.data.data
            })
    })
