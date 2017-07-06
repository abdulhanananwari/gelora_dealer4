geloraPolRegShared
    .directive('registrationHandover', function(
        SalesOrderModel,
        LinkFactory, JwtValidator) {

        return {
            templateUrl: '/gelora/pol-reg-shared/app/registration/handover/registrationHandover.html',
            scope: {
                salesOrder: '='
            },
            link: function(scope, element, attrs) {

                scope.modalId = Math.random().toString(36).substring(2, 7)

                scope.addItem = function(name) {
                    scope.salesOrder.polReg.items[name] = {
                        name: name
                    }
                }

                scope.itemIncomingEntry = function(item) {
                    scope.selectedItem = item
                    $('#item-incoming-entry-' + scope.modalId).modal('show')
                }

                scope.itemIncomingStore = function(item) {

                    SalesOrderModel.polReg.item.incoming(scope.salesOrder.id, item)
                        .then(function(res) {
                            scope.salesOrder = res.data.data
                            $('#item-incoming-entry-' + scope.modalId).modal('hide')
                        })
                }

                scope.itemOutgoingEntry = function(item) {
                    scope.selectedItem = item
                    $('#item-outgoing-entry-' + scope.modalId).modal('show')
                }

                scope.itemOutgoingStore = function(item, params) {

                    SalesOrderModel.polReg.item.outgoing(scope.salesOrder.id, item, params)
                        .then(function(res) {
                            scope.salesOrder = res.data.data
                            $('#item-outgoing-entry-' + scope.modalId).modal('hide')
                        }, function(res) {
                            if (res.userResponse) {
                                scope.itemOutgoingStore(item, res.userResponse)
                            }
                        })
                }

                scope.generateReceiptItemHandover = function(item) {
                    window.open(LinkFactory.dealer.sales.salesOrder.polReg.views + 'generate-receipt-item-handover/' + scope.salesOrder.id + '?' + $.param({ jwt: JwtValidator.encodedJwt, item_name: item.name }));
                }

            }
        }

    })
