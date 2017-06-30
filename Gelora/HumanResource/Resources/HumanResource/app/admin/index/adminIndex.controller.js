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

        vm.store = {
            admin: function() {

                SettingModel.store({ unique: true, object_type: 'ADMINS', data_1: vm.admins })
                    .then(function(res) {
                        alert('Setting berhasil disimpan')
                    })
            },
            channel: function() {

                SettingModel.store({ unique: true, object_type: 'ADMIN_SLACK_CHANNELS', data_1: vm.adminSlackChannels })
                    .then(function(res) {
                        alert('Setting berhasil disimpan')
                    })
            }
        }

        SettingModel.index({ unique: true, object_type: 'ADMINS' })
            .then(function(res) {
                if (res.data.data.data_1) {
                    vm.admins = res.data.data.data_1
                }
            })

        SettingModel.index({ unique: true, object_type: 'ADMIN_SLACK_CHANNELS' })
            .then(function(res) {
                if (res.data.data.data_1) {
                    vm.adminSlackChannels = res.data.data.data_1
                }
            }, function() {

                vm.adminSlackChannels = {
                    'PROSPECT_SPK': {
                        name: 'PROSPECT_SPK',
                        description: 'Penginputan SPK dan prospek'
                    },
                    'SPK_VALIDATION': {
                        name: 'SPK_VALIDATION',
                        description: 'Request Validasi SPK'
                    }
                }
            })

    })
