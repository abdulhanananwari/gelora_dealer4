solumaxLoggerApp
	.factory('LogModel', function(
		$http) {

		var logModel = {}

		logModel.index = function(params) {
			return $http.get('/solumax/logger/api/log', {params: params})
		}
		
		logModel.get = function(id, params) {
			return $http.get('/solumax/logger/api/log' + id, {params: params})
		}
		
		return logModel
	})