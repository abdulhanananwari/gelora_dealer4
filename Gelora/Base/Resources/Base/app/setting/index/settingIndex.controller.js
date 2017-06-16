geloraBase
	.controller('SettingIndexController', function(
		$state,
		ConfigModel, SettingModel) {

		var vm = this
		vm.settings ={}

		ConfigModel.get('gelora.base.settings.tenantInfo')
		.then(function(res) {
			
			vm.tenantInfo = res.data.data
		})
		SettingModel.index({object_type: 'TENANT_INFO', single: true})
		.then(function(res) {

			vm.settings.tenantInfoSetting = res.data.data.data_1

		}, function(res) {
			
			vm.settings.tenantInfoSetting = {}
		})
		
		ConfigModel.get('gelora.base.settings.businessProcedure')
		.then(function(res){
			
			vm.businessProcedure = res.data.data
		})
		
		SettingModel.index({object_type: 'BUSINESS_PROCEDURES', single:true})
		.then(function(res){
			
			vm.settings.businessProcedure = res.data.data.data_1

		}, function(res) {
			
			vm.settings.businessProcedure = {}
		})

		vm.update = function(objectType, data) {

			console.log(data)

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