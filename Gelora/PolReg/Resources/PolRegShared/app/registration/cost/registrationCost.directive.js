geloraPolRegShared
    .directive('registrationCost', function(
        SalesOrderModel) {

        return {
            templateUrl: '/gelora/pol-reg-shared/app/registration/cost/registrationCost.html',
            scope: {
                salesOrder: '=',
            },
            link: function(scope, element, attrs) {

                scope.modalId = Math.random().toString(36).substring(2, 7)

                scope.costEntry = function(cost) {
                    scope.selectedCost = cost
                    $('#cost-entry-' + scope.modalId).modal('show')
                }

                scope.costStore = function(cost) {

                    SalesOrderModel.polReg.cost.store(scope.salesOrder.id, cost)
                        .then(function(res) {
                            scope.salesOrder = res.data.data
                            $('#cost-entry-' + scope.modalId).modal('hide')
                        })
                }

                scope.addCost = function(name) {

                    scope.salesOrder.polReg.costs[name] = {
                        name: name
                    }
                }

                scope.$watch('salesOrder', function(newVal) {
                    scope.salesOrder.polReg.total_cost = _.sum(_.map(scope.salesOrder.polReg.costs, 'amount'))
                })
            }
        }

    })
