geloraInventoryManagement
        .factory('MovementOrderHeaderModel', function (
                $http, LinkFactory) {

            var movementOrderHeaderModel = {}

            movementOrderHeaderModel.index = function (params) {
                return $http.get(LinkFactory.dealer.inventoryManagement.movementOrderHeader, {params: params})
            }

            movementOrderHeaderModel.get = function (id, params) {
                return $http.get(LinkFactory.dealer.inventoryManagement.movementOrderHeader + id, {params: params})
            }

            movementOrderHeaderModel.store = function (movementOrderHeader) {
                return $http.post(LinkFactory.dealer.inventoryManagement.movementOrderHeader, movementOrderHeader)
            }

            movementOrderHeaderModel.update = function (id, movementOrderHeader) {
                return $http.post(LinkFactory.dealer.inventoryManagement.movementOrderHeader + id, movementOrderHeader)
            }
            movementOrderHeaderModel.close = function (id) {
                return $http.post(LinkFactory.dealer.inventoryManagement.movementOrderHeader + 'close/' + id)
            }


            return movementOrderHeaderModel
        })