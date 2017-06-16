geloraDealerCreditSales
	.controller('LeasingProgramUploadController', function(
		$state,
		LeasingModel,
		LeasingProgramModel, ModelModel) {

		var vm = this


		vm.loadFile = function() {
					
			var file = document.getElementById('file').files[0];

			CsvUploader.parse(file)
			.then(function(results)  {

				LeasingModel.index()
				.success(function(data) {

					vm.leasings = data.data

					processFileContent(results.data);
					$scope.$apply()

				})

			}, function(error) {
				
				console.log(error)
			})
		}

		vm.uploadAll = function() {

			vm.loading = CsvUploader.uploading;
			vm.uploadStarted = CsvUploader.uploading;

			CsvUploader.upload(vm.remunerations, {
				upload: function(remuneration) {
					
					return RemunerationModel.store(remuneration, {from_csv: true})
				}
			})

		}

		function processFileContent(data) {

			vm.leasingPrograms = _.map(data, function(rawData) {

				var leasingProgram = {
					main_leasing_id: rawData['main_leasing_id'],
					vehicle_model_selection_type: rawData['vehicle_model_selection_type'],
					tenor_selection_type: rawData['tenor_selection_type'],
					dp_selection_type: rawData['dp_selection_type'],
				}
				

				if (leasingProgram.vehicle_model_selection_type == 'group') {

					leasingProgram.vehicle_model_group = rawData['vehicle_model_group']

				} else if (leasingProgram.vehicle_model_selection_type == 'single') {

					leasingProgram.vehicle_model = rawData['vehicle_model']
				}



				if (leasingProgram.tenor_selection_type == 'range') {

					leasingProgram.min_tenor = rawData['min_tenor']
					leasingProgram.max_tenor = rawData['max_tenor']

				} else if (leasingProgram.dp_selection_type == 'single') {
					
					leasingProgram.tenor = rawData['tenor']
				}



				if (leasingProgram.dp_selection_type == 'range') {

					leasingProgram.min_dp = rawData['min_dp']
					leasingProgram.max_dp = rawData['max_dp']

				} else if (leasingProgram.dp_selection_type == 'single') {
					
					leasingProgram.dp = rawData['dp']
				}
			})
		}
	})