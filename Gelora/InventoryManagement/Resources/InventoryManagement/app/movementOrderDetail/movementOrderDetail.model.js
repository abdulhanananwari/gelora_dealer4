geloraInventoryManagement
        .factory('MovementOrderDetailModel', function (
                $http, LinkFactory) {

            var movementOrderDetailModel = {}

            movementOrderDetailModel.index = function (params) {
                return $http.get(LinkFactory.dealer.inventoryManagement.movementOrderDetail, {params: params})
            }

            movementOrderDetailModel.store = function (movementOrderHeader, unit) {
                
                return $http.post(LinkFactory.dealer.inventoryManagement.movementOrderDetail, {
                    movement_order_header_id: movementOrderHeader.id, 
                    unit_id: unit.id
                })
            }

            movementOrderDetailModel.delete = function (id) {
                return $http.delete(LinkFactory.dealer.inventoryManagement.movementOrderDetail + id)
            }

            return movementOrderDetailModel

        })