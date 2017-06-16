geloraSalesShared
    .factory('ProspectSalesPersonnelModel', function(
        $http, JwtValidator,
        LinkFactory) {

        var prospect = []

        prospect.index = function(params) {
            return $http.get(LinkFactory.dealer.sales.prospect.salesPersonnel.base, { params: params })
        }

        prospect.get = function(id, params) {
            return $http.get(LinkFactory.dealer.sales.prospect.salesPersonnel.base + id, { params: params })
        }

        prospect.store = function(prospect, params) {
            return $http.post(LinkFactory.dealer.sales.prospect.salesPersonnel.base, prospect, { params: params })
        }

        prospect.update = function(id, prospect, params) {
            return $http.post(LinkFactory.dealer.sales.prospect.salesPersonnel.base + id, prospect, { params: params })
        }

        prospect.close = function(id, prospect, params) {
            return $http.post(LinkFactory.dealer.sales.prospect.salesPersonnel.base + id + '/close', prospect, { params: params })
        }

        prospect.respond = function(id, prospect, params) {
            return $http.post(LinkFactory.dealer.sales.prospect.salesPersonnel.base + id + '/respond', prospect, { params: params })
        }


        prospect.specificUpdate = {
            deliveryRequest: function(id, prospect, params) {
                return $http.post(LinkFactory.dealer.sales.prospect.salesPersonnel.base + id + '/specific-update/delivery-request/', prospect, { params: params })
            },
            price: function(id, prospect, params) {
                return $http.post(LinkFactory.dealer.sales.prospect.salesPersonnel.base + id + '/specific-update/price/', prospect, { params: params })
            }
        }

        prospect.leasingOrder = {
            select: function(id, leasingOrder, params) {
                return $http.post(LinkFactory.dealer.sales.prospect.salesPersonnel.base + id + '/leasing-order/select/', { leasing_order_id: leasingOrder.id }, { params: params })
            },
            deselect: function(id, params) {
                return $http.post(LinkFactory.dealer.sales.prospect.salesPersonnel.base + id + '/leasing-order/deselect/', {}, { params: params })
            },
        }

        prospect.document = {
            spk: {
                generate: function(id) {
                    return $http.post(LinkFactory.dealer.sales.prospect.salesPersonnel.base + id + '/document/spk/generate')
                },
                email: function(id) {
                    return $http.post(LinkFactory.dealer.sales.prospect.salesPersonnel.base + id + '/document/spk/email')
                }
            }
        }

        return prospect
    })
