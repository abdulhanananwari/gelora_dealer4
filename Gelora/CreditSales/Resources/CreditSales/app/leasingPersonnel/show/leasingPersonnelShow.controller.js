geloraDealerCreditSales
    .controller('LeasingPersonnelShowController', function(
        $state, LeasingPersonnelModel, LeasingModel) {

        var vm = this

        vm.store = function(leasingPersonnel) {

            if (!leasingPersonnel.id) {

                LeasingPersonnelModel.store(leasingPersonnel)
                    .success(function(data) {
                        $state.go('leasingPersonnelShow', { id: data.data.id })
                    })

            } else {

                LeasingPersonnelModel.update(leasingPersonnel.id, leasingPersonnel)
                    .success(function(data) {

                        vm.leasingPersonnel = data.data
                        alert('Data Berhasil Di Update')
                    })
            }

        }

        vm.delete = function(leasingPersonnel) {

            if (confirm('Yakin mau hapus personnel leasing ini?')) {

                LeasingPersonnelModel.delete(leasingPersonnel.id)
                    .success(function(data) {
                        alert('Data personnel leasing berhasil dihapus')
                        $state.go('leasingShow', { id: leasingPersonnel.leasing.mainLeasing.id })
                    })
            }
        }

        if ($state.params.id) {

            LeasingPersonnelModel.get($state.params.id)
                .success(function(data) {

                    vm.leasingPersonnel = data.data;
                })

        } else if ($state.params.mainLeasingId) {

            LeasingModel.get($state.params.mainLeasingId)
                .success(function(data) {

                    vm.leasingPersonnel = {
                        leasing: data.data
                    }
                })

        }

        vm.addPersonnel = function(personal_entity) {

            vm.leasingPersonnel.personnel_entity_id = personal_entity.id;
            vm.leasingPersonnel.email = personal_entity.email;
        }




    });
