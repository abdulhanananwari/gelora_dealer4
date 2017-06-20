geloraSalesShared
    .factory('ProspectModel', function(
        $http, JwtValidator,
        LinkFactory) {

        var prospect = []

        prospect.index = function(params) {
            return $http.get(LinkFactory.dealer.sales.prospect.base, { params: params })
        }

        prospect.get = function(id, params) {
            return $http.get(LinkFactory.dealer.sales.prospect.base + id, { params: params })
        }

        prospect.store = function(prospect, params) {
            return $http.post(LinkFactory.dealer.sales.prospect.base, prospect, { params: params })
        }

        prospect.update = function(id, prospect, params) {
            return $http.post(LinkFactory.dealer.sales.prospect.base + id, prospect, { params: params })
        }

        prospect.action = {
            close: function(id, prospect, params) {
                return $http.post(LinkFactory.dealer.sales.prospect.base + id + '/close/', prospect, { params: params })
            },
            respond: function(id, prospect, params) {
                return $http.post(LinkFactory.dealer.sales.prospect.base + id + '/respond/', prospect, { params: params })
            },
        }

        return prospect
    })
