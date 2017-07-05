geloraBaseShared
    .factory('SalesExtraModel', function(
        $http, LinkFactory) {

        var salesExtra = {}

        salesExtra.index = function(params) {
            return $http.get(LinkFactory.dealer.base.salesExtra.base, { params: params })
        }
        
        salesExtra.get = function(id) {
            return $http.get(LinkFactory.dealer.base.salesExtra.base + id)
        }
        
        salesExtra.store = function(salesExtra) {
            return $http.post(LinkFactory.dealer.base.salesExtra.base, salesExtra)
        }

        salesExtra.update = function(id, salesExtra) {
            return $http.post(LinkFactory.dealer.base.salesExtra.base + id, salesExtra)
        }

        return salesExtra
    })
