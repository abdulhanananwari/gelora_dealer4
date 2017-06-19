geloraPolRegShared
    .directive('registrationHandover', function(
        RegistrationModel,
        LinkFactory, JwtValidator) {

        return {
            templateUrl: '/gelora/pol-reg-shared/app/registration/handover/registrationHandover.html',
            scope: {
                registrationId: '@',
                items: '='
            },
            link: function(scope, element, attrs) {

                scope.modalId = Math.random().toString(36).substring(2, 7)

                attrs.$observe('registrationId', function(newValue) {

                    if (newValue) {

                        RegistrationModel.get(newValue)
                            .then(function(res) {
                                scope.innerRegistration = res.data.data
                                scope.items = scope.innerRegistration.items
                            })
                    }

                })


                scope.itemIncomingEntry = function(item) {
                    scope.selectedItem = item
                    $('#item-incoming-entry-' + scope.modalId).modal('show')
                }

                scope.itemIncomingStore = function(item) {

                    RegistrationModel.update.itemIncoming(scope.innerRegistration.id, item)
                        .then(function(res) {
                            scope.innerRegistration = res.data.data
                            scope.items = scope.innerRegistration.items
                            $('#item-incoming-entry-' + scope.modalId).modal('hide')
                        })
                }

                scope.itemOutgoingEntry = function(item) {
                    scope.selectedItem = item
                    $('#item-outgoing-entry-' + scope.modalId).modal('show')
                }

                scope.itemOutgoingStore = function(item, params) {

                    RegistrationModel.update.itemOutgoing(scope.innerRegistration.id, item, params)
                        .then(function(res) {
                            scope.innerRegistration = res.data.data
                            scope.items = scope.innerRegistration.items
                            $('#item-outgoing-entry-' + scope.modalId).modal('hide')
                        }, function(res) {


                            if (res.userResponse) {

                                scope.itemOutgoingStore(item, res.userResponse)
                            }
                        })
                }

                scope.generateReceiptItemHandover = function(item) {

                    window.open(LinkFactory.dealer.polReg.registration.views + 'generate-receipt-item-handover/' + scope.innerRegistration.id + '?' + $.param({ jwt: JwtValidator.encodedJwt, item_name: item.name }));

                }

            }
        }

    })
