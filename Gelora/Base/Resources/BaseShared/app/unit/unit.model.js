geloraBaseShared
	.factory('UnitModel', function(
		$http, LinkFactory) {

		var unitModel = {}

		unitModel.index = function (params) {
			return $http.get(LinkFactory.dealer.base.unit.base, {params: params})
		}

		unitModel.get = function (id, params) {
			return $http.get(LinkFactory.dealer.base.unit.base + id, {params: params})
		}

		unitModel.store = function (unit) {
			return $http.post(LinkFactory.dealer.base.unit.base, unit)
		}
		
		unitModel.update = function (id, unit) {
			return $http.post(LinkFactory.dealer.base.unit.base + id, unit)
		}
		
		unitModel.delete = function (id) {
			return $http.delete(LinkFactory.dealer.base.unit.base + id)
		}

		unitModel.assign = {
			costOfGood: function(id, costOfGood) {
				return $http.post(LinkFactory.dealer.base.unit.base + 'assign/cost-of-good/' +  id, {cost_of_good: costOfGood})
			}
		}

		unitModel.action = {
			receive: function(id, body) {
				return $http.post(LinkFactory.dealer.base.unit.base + 'action/receive/' + id, body)
			},
			pdi: function(id, body) {
				return $http.post(LinkFactory.dealer.base.unit.base + 'action/pdi/' + id, body)
			}
		}

		unitModel.maintenance = {
			updateStatus: function(id, status) {
				return $http.post(LinkFactory.dealer.base.unit.base + 'maintenance/status/' + id, {new_status: status})
			},
			moveLocation: function(id, newLocationId) {
				return $http.post(LinkFactory.dealer.base.unit.base + 'maintenance/location/' + id, {new_location_id: newLocationId})
			}
		}

		return unitModel
	})	