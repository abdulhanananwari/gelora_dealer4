geloraBase
        .controller('LocationShowController', function(
        $state,
        ConfigModel,
        LocationModel) {
            var vm =this
            
            vm.location ={
                active: true
            }

            vm.store =function(location) {

                if(!location.id) {

                    LocationModel.store(location)
                    .then(function(res) {
                        $state.go('locationShow', {id: res.data.data.id})
                    })
    
                } else {
            
                    LocationModel.update(location.id, location)
                    .then(function(res){
                        alert('Lokasi berhasil diupdate')
                        vm.location = res.data.data
                    })
                
                }
            }
            

             if ($state.params.id) {
                
                LocationModel.get($state.params.id)
                .then(function(res) {
                    vm.location = res.data.data
                })
            }
           
            ConfigModel.get('gelora.base.location.types')
            .then(function(res){
                vm.types = res.data.data
            
            })
            
        })

