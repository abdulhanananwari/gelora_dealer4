geloraInventoryManagement
	.controller('MovementOrderHeaderShowController', function(
		$state, 
		JwtValidator,
		UnitModel,
		MovementOrderHeaderModel, MovementOrderDetailModel) {

		var vm = this

		vm.movementOrderHeader = {
			date: moment().format("YYYY-MM-DD"),
			movementOrderDetails: []
		}

		$('#date').datepicker({dateFormat: "yy-mm-dd"});

		vm.unitSearchAdditionalParams = {
			statuses_in:'IN_STOCK_SELLABLE,IN_STOCK_NOT_SELLABLE',
			current_location_id_not: vm.movementOrderHeader.to_location_id
		}

		vm.addUnit = function(unit) {

			// Validasi ini perlu dipindahkan ke laravel saja
			if (_.includes(_.map(vm.movementOrderHeader.movementOrderDetails, 'unit_id'), unit.id)) {
				alert('Unit sudah ada di perintah perpindahan ini')
				return ;
			}

			MovementOrderDetailModel.store(vm.movementOrderHeader, unit)
			.then(function() {
				load(vm.movementOrderHeader.id)
			})
		}

		vm.store = function (movement){

			if (!movement.id) {
				MovementOrderHeaderModel.store(movement)
				.then(function(res) {

					$state.go('movementOrderHeaderShow', {id: res.data.data.id})

				})

			} else{
				MovementOrderHeaderModel.update(movement.id, movement)
				.then(function(res) {
					vm.movementOrderHeader =res.data.data
					alert('Data Berhasil Di Update')
					load($state.params.id)
				})

			}
		}

		vm.close = function(movement){
			MovementOrderHeaderModel.close(movement.id, movement)
			.success(function(data){
				vm.movementOrderHeader = data.data
				alert('Perpindahan Unit Telah Selesai')
				load($state.params.id)
				
			})
		}

		vm.print = function() {

			var w = window.open();

			window.setTimeout(function() {
				w.document.write($('#printarea').html());

				w.print();
				w.close();
			}, 2000);
		}


		function load(id) {

			var params = {
				with: 'movementOrderDetails.unit' 
			}

			MovementOrderHeaderModel.get($state.params.id, params)
			.success(function(data){

				vm.movementOrderHeader = data.data;
				vm.unitSearchAdditionalParams.current_location_id_not = data.data.to_location_id

				if (typeof vm.movementOrderHeader.movementOrderDetails != 'undefined') {
					vm.movementOrderHeader.movementOrderDetails = vm.movementOrderHeader.movementOrderDetails.data
				}

			})
		}

		vm.printData = {
			creatorName: JwtValidator.decodedJwt.name,
			template: 'app/movementOrderHeader/print/print.html'
		}

		if ($state.params.id) {
			load($state.params.id)
		}
		
			
})