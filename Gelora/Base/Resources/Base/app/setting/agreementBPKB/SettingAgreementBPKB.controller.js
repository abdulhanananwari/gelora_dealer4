geloraBase
	.controller('SettingAgreementBPKBController', function(
		$state,
		ConfigModel, SettingModel) {

		var vm = this
		vm.settings ={}


		ConfigModel.get('gelora.creditSales.agreementBPKB')
		.then(function(res) {
			
			vm.agreementBPKB = res.data.data
		})

		SettingModel.index({object_type: 'AGREEMENT_BPKB', single:true})
		.then(function(res){
			
			vm.settings.settingAgreementBPKB = res.data.data.data_1

		}, function(res) {
			
			vm.settings.settingAgreementBPKB = {}
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