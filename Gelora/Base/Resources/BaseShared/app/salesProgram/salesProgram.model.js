geloraBaseShared
	.factory('SalesProgramModel', function(
		$http,LinkFactory){

		var salesProgram ={}

		salesProgram.index = function(params) {
			return $http.get(LinkFactory.dealer.base.salesProgram.base, {params: params})
		}
		salesProgram.get = function(id) {
			return $http.get(LinkFactory.dealer.base.salesProgram.base + id)
		}
		salesProgram.store = function(salesProgram) {
			return $http.post(LinkFactory.dealer.base.salesProgram.base, salesProgram)
		}
		salesProgram.update = function(id,salesProgram) {
			return $http.put(LinkFactory.dealer.base.salesProgram.base + id , salesProgram)
		}
		return salesProgram
	})