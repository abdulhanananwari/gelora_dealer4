geloraBase
	.factory('SettingModel', function(
		$http,
		LinkFactory) {

		var settingModel = {}

		settingModel.index = function(params) {

			return $http.get(LinkFactory.setting.setting.base, {params: params})
		}

		settingModel.store = function(setting) {

			return $http.post(LinkFactory.setting.setting.base, setting)
		}
		settingModel.get = function(params) {
			return $http.get(LinkFactory.setting.setting.base, {params: params})
		}

		return settingModel
	})