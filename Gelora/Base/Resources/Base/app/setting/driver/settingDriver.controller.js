geloraBase
	.controller('SettingDriverController', function(
		SettingModel) {

		var vm = this

		vm.driver = {
			data_1: [],
			object_type: 'DRIVERS'
		}

		SettingModel.index({object_type: 'DRIVERS', single: true})
		.then(function(res) {
			
			if (!_.isEmpty(res.data.data)) {
				vm.driver = res.data.data
			}
		})
		
		vm.store = function(setting) {

			setting.unique = true

			SettingModel.store(setting)
			.then(function(res) {
				alert('Berhasil disimpan')
			})
		}

		vm.addDriver = function(driver) {
			vm.driver.data_1.push(_.pick(driver, ['id','name']));
		}
		
		vm.removeDriver = function(driver) {
			_.remove(vm.driver.data_1, driver)
		}
	})
