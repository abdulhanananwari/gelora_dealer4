geloraBaseShared
    .factory('PriceModel', function(
        $http, LinkFactory) {

        var priceModel = {}

        priceModel.index = function(params) {
            return $http.get(LinkFactory.dealer.base.price.base, { params: params })
        }

        priceModel.get = function(id, params) {
            return $http.get(LinkFactory.dealer.base.price.base + id, { params: params })
        }

        priceModel.store = function(price, params) {
            return $http.post(LinkFactory.dealer.base.price.base, price, { params: params })
        }

        priceModel.update = function(id, price, params) {
            return $http.post(LinkFactory.dealer.base.price.base + id, price, { params: params })
        }

        priceModel.delete = function(id) {
            return $http.delete(LinkFactory.dealer.base.price.base + id)
        }

        priceModel.currentPrice = {
            byModelId: function(modelId) {
                return priceModel.get('current-price-by-model-id/' + modelId)
            }
        }

        priceModel.extensive = {
            index: function(params) {
                return $http.get(LinkFactory.dealer.base.price.base + 'extensive/', { params: params })
            },
            get: function(id, params) {
                return $http.get(LinkFactory.dealer.base.price.base + 'extensive/' + id, { params: params })
            },
            store: function(price, params) {
                return $http.post(LinkFactory.dealer.base.price.base + 'extensive/', price, { params: params })
            },
            update: function(id, price, params) {
                return $http.post(LinkFactory.dealer.base.price.base + 'extensive/' + id, price, { params: params })
            }
        }

        return priceModel
    })
