geloraHumanResource
    .controller('AdminIndexController', function(
        SettingModel) {

        var vm = this

        vm.admins = []

        vm.add = function(user) {
            vm.admins.push({
                user: user
            })
        }

        vm.delete = function(admin) {
            _.remove(vm.admins, admin)
        }

        vm.store = function() {

            SettingModel.store({ unique: true, object_type: 'ADMINS', data_1: vm.admins })
                .then(function(res) {
                    alert('Setting berhasil disimpan')
                })
        }

        SettingModel.index({ unique: true, object_type: 'ADMINS' })
            .then(function(res) {
                if (res.data.data.data_1) {
                    vm.admins = res.data.data.data_1
                }
            })

    })
