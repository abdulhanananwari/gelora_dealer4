geloraInventoryManagement
    .factory('MovementOrderModel', function(
        $http, LinkFactory) {

        var movementOrderModel = {}

        movementOrderModel.index = function(params) {
            return $http.get(LinkFactory.dealer.inventoryManagement.movementOrder, { params: params })
        }

        movementOrderModel.get = function(id, params) {
            return $http.get(LinkFactory.dealer.inventoryManagement.movementOrder + id, { params: params })
        }

        movementOrderModel.store = function(movementOrder) {
            return $http.post(LinkFactory.dealer.inventoryManagement.movementOrder, movementOrder)
        }

        movementOrderModel.update = function(id, movementOrder) {
            return $http.post(LinkFactory.dealer.inventoryManagement.movementOrder + id, movementOrder)
        }
        
        movementOrderModel.close = function(id) {
            return $http.post(LinkFactory.dealer.inventoryManagement.movementOrder + 'close/' + id)
        }


        return movementOrderModel
    })
