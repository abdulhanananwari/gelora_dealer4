geloraBase
        .controller('SalesProgramShowController', function(
        $state,
        SalesProgramModel) {
            var vm =this
            
            vm.salesProgram ={
                valid_from: moment().format("YYYY-MM-DD"),
                valid_until: moment().format("YYYY-MM-DD"),
                active: true
            }
            
            $('.date').datepicker({dateFormat: "yy-mm-dd"});

            vm.store =function(salesProgram) {

                if(!salesProgram.id) {

                    SalesProgramModel.store(salesProgram)
                    .then(function(res) {
                        alert('Sales Program Berhasil Disimpan')
                        $state.go('salesProgramShow', {id: res.data.data.id})
                    })
    
                } else {
            
                    SalesProgramModel.update(salesProgram.id, salesProgram)
                    .then(function(res){
                        alert('Sales Program berhasil diupdate')
                        vm.salesProgram = res.data.data
                    })
                
                }
            }
            

             if ($state.params.id) {
                
                SalesProgramModel.get($state.params.id)
                .then(function(res) {
                    vm.salesProgram = res.data.data
                })
            }
        })

