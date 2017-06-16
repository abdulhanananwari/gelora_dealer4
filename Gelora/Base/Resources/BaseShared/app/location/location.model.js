geloraBaseShared
	.factory('LocationModel', function(
		$http,LinkFactory){

		var locationModel ={}

		locationModel.index = function(params) {
			return $http.get(LinkFactory.dealer.base.location.base, {params: params})
		}
		locationModel.get = function(id) {
			return $http.get(LinkFactory.dealer.base.location.base + id)
		}
		locationModel.store = function(location) {
			return $http.post(LinkFactory.dealer.base.location.base, location)
		}
		locationModel.update = function(id,location) {
			return $http.put(LinkFactory.dealer.base.location.base + id , location)
		}
		return locationModel
	})