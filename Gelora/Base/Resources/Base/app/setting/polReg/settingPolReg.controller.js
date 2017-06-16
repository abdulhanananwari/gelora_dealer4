geloraBase
	.controller('SettingPolRegController', function(
		$state,
		ConfigModel, SettingModel) {

		var vm = this
		vm.settings ={}

		ConfigModel.get('gelora.polReg.formatSubjectEmails')
		.then(function(res) {
			
			vm.formatSubjectEmail = res.data.data
		})

		SettingModel.index({object_type: 'SUBJECT_EMAIL', single: true})
		.then(function(res) {

			vm.settings.polRegSubjectEmail = res.data.data.data_1

		}, function(res) {
			
			vm.settings.polRegSubjectEmail = {}
		})
	
		vm.update = function(objectType, data) {

			var data = {
				object_type: objectType,
				data_1: data,
				unique: true
			}

			SettingModel.store(data)
			.success(function(data) {
				alert('Setting berhasil disimpan')
			})
		}

	})