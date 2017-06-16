geloraSalesShared
    .factory('SalesOrderModel', function(
        $http, JwtValidator,
        LinkFactory) {

        var salesOrder = []

        salesOrder.index = function(params) {
            return $http.get(LinkFactory.dealer.sales.salesOrder.base, { params: params })
        }

        salesOrder.get = function(id, params) {
            return $http.get(LinkFactory.dealer.sales.salesOrder.base + id, { params: params })
        }

        salesOrder.store = function(salesOrder, params) {
            return $http.post(LinkFactory.dealer.sales.salesOrder.base, salesOrder, { params: params })
        }

        salesOrder.update = function(id, salesOrder, params) {
            return $http.post(LinkFactory.dealer.sales.salesOrder.base + id, salesOrder, { params: params })
        }

        salesOrder.calculate = function(id) {
            return $http.post(LinkFactory.dealer.sales.salesOrder.base + id + '/calculate')
        }

        salesOrder.specificUpdate = {
            deliveryRequest: function(id, salesOrder, params) {
                return $http.post(LinkFactory.dealer.sales.salesOrder.base + id + '/specific-update/delivery-request/', salesOrder, { params: params })
            },
            price: function(id, salesOrder, params) {
                return $http.post(LinkFactory.dealer.sales.salesOrder.base + id + '/specific-update/price/', salesOrder, { params: params })
            },
            plafond: function(id, salesOrder, params) {
                return $http.post(LinkFactory.dealer.sales.salesOrder.base + id + '/specific-update/plafond/', salesOrder, { params:params })
            }
        }

        salesOrder.leasingOrder = {
            update: function(id, leasingOrder, params) {
                return $http.post(LinkFactory.dealer.sales.salesOrder.base + id + '/leasing-order/', { leasingOrder : leasingOrder }, { params: params })
            },
            assignFromLeasingOrder: function(id, leasingOrderId, params) {
                return $http.post(LinkFactory.dealer.sales.salesOrder.base + id + '/leasing-order/assign-from-leasing-order/', { leasing_order_id : leasingOrderId }, { params: params })  
            }
        }

        salesOrder.document = {
            spk: {
                generate: function(id) {
                    return $http.post(LinkFactory.dealer.sales.salesOrder.base + id + '/document/spk/generate')
                },
                email: function(id) {
                    return $http.post(LinkFactory.dealer.sales.salesOrder.base + id + '/document/spk/email')
                }
            }
        }

        salesOrder.delivery = {
            generate: function(id) {
                return $http.post(LinkFactory.dealer.sales.salesOrder.base + id + '/delivery-detail/generate/')
            }
        }
        salesOrder.unit = {
            indent: function(id) {
                return $http.post(LinkFactory.dealer.sales.salesOrder.base + id + '/unit/indent/')
            }
        }
        
        salesOrder.action = {
            lock: {
                request: function(id) {
                    return $http.post(LinkFactory.dealer.sales.salesOrder.base + id + '/action/lock/request/')
                },
                lock: function(id) {
                    return $http.post(LinkFactory.dealer.sales.salesOrder.base + id + '/action/lock/lock/')
                },
                unlock: function(id) {
                    return $http.post(LinkFactory.dealer.sales.salesOrder.base + id + '/action/lock/unlock/')
                },
            },
            validation: {
                validate: function(id) {
                    return $http.post(LinkFactory.dealer.sales.salesOrder.base + id + '/action/validation/validate/')
                },
                unvalidate: function(id) {
                    return $http.post(LinkFactory.dealer.sales.salesOrder.base + id + '/action/validation/unvalidate/')
                }
            }
        }

        return salesOrder
    })
