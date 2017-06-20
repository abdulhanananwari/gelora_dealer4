geloraHumanResource
	.factory('PersonnelModel', function(
		$http,
		LinkFactory) {

		var personnelModel = {}

		personnelModel.index = function(params) {
			return $http.get(LinkFactory.dealer.humanResource.personnel.base, {params: params})
		}

		personnelModel.get = function(id, params) {
			return $http.get(LinkFactory.dealer.humanResource.personnel.base + id, {params: params})
		}

		personnelModel.store = function(personnel) {
			return $http.post(LinkFactory.dealer.humanResource.personnel.base, personnel)
		}

		personnelModel.update = function(id, personnel) {
			return $http.post(LinkFactory.dealer.humanResource.personnel.base + id, personnel)
		}

		personnelModel.registerNewUser = function(email) {
			return $http.post(LinkFactory.dealer.humanResource.personnel.base + 'register-new-user', {email: email})
		}

		return personnelModel

	})