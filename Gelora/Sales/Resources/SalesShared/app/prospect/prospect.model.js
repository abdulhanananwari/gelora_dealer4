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

        prospect.calculate = function(id) {
            return $http.post(LinkFactory.dealer.sales.prospect.base + id + '/calculate')
        }

        prospect.specificUpdate = {
            deliveryRequest: function(id, prospect, params) {
                return $http.post(LinkFactory.dealer.sales.prospect.base + id + '/specific-update/delivery-request/', prospect, { params: params })
            },
            price: function(id, prospect, params) {
                return $http.post(LinkFactory.dealer.sales.prospect.base + id + '/specific-update/price/', prospect, { params: params })
            }
        }

        prospect.leasingOrder = {
            select: function(id, leasingOrder, params) {
                return $http.post(LinkFactory.dealer.sales.prospect.base + id + '/leasing-order/select/', { leasing_order_id: leasingOrder.id }, { params: params })
            },
            deselect: function(id, params) {
                return $http.post(LinkFactory.dealer.sales.prospect.base + id + '/leasing-order/deselect/', {}, { params: params })
            },
        }

        prospect.document = {
            spk: {
                generate: function(id) {
                    return $http.post(LinkFactory.dealer.sales.prospect.base + id + '/document/spk/generate')
                },
                email: function(id) {
                    return $http.post(LinkFactory.dealer.sales.prospect.base + id + '/document/spk/email')
                }
            }
        }

        return prospect
    })
