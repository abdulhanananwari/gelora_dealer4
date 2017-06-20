geloraHumanResource
    .controller('PersonnelShowController', function(
        $state,
        PersonnelModel, TeamModel,
        ConfigModel) {

        var vm = this

        vm.personnel = {}

        ConfigModel.get('gelora.humanResource.availablePositions')
            .then(function(res) {
                vm.positions = res.data.data
            })

        TeamModel.index()
            .then(function(res) {
                vm.teams = res.data.data
            })

        vm.store = function(personnel) {

            if (personnel.id) {

                PersonnelModel.update(personnel.id, personnel)
                    .then(function(res) {
                        vm.personnel = res.data.data
                    })

            } else {

                PersonnelModel.store(personnel)
                    .then(function(res) {
                        $state.go('personnelShow', { id: res.data.data.id })
                        vm.personnel = res.data.data
                    })

            }
        }

        vm.delete = function(personnel) {
            if (confirm('Yakin mau hapus sales?')) {

                PersonnelModel.delete(personnel.id)
                    .then(function(res) {
                        $state.go('personnelIndex')
                    })
            }
        }

        vm.registerNewUser = function(email) {

            PersonnelModel.registerNewUser(email)
                .then(function(res) {
                    vm.personnel.user = res.data.data
                    alert('Pendaftaran berhasil. Nomor User: '.vm.personnel.user.id)
                })
        }


        if ($state.params.id) {

            PersonnelModel.get($state.params.id)
                .then(function(res) {
                    vm.personnel = res.data.data
                })
        }
    })
