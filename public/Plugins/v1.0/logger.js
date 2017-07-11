var solumaxLoggerApp = angular
	.module('Solumax.LoggerPlugins', [])
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
solumaxLoggerApp
    .directive('logIndex', function(
        LogModel) {

        return {
            templateUrl: '',
            scope: {
                loggableType: '@',
                loggableId: '@',
            },
            link: function(scope, elem, attrs) {

                var watches = ['loggableType', 'loggableId']
                watches.each(function(watch) {

                    scope.$watch('scope.' + watch, function(newVal) {

                    })
                })

                function retrieve() {

                    LogModel.index({ loggable_type: scope.loggableType, loggable_id: scope.loggableId })
                        .then(function(res) {
                            scope.logs = res.data.data
                            scope.meta = res.data.meta
                        })
                }

            }
        }
    })

//# sourceMappingURL=logger.js.map
