geloraPolRegShared
	.directive('registrationCost', function(
		RegistrationModel,
                LinkFactory,JwtValidator) {

		return {
			templateUrl: '/gelora/pol-reg-shared/app/registration/cost/registrationCost.html',
			scope: {
				registrationId: '@',
			},
			link: function(scope, element, attrs) {

				scope.modalId = Math.random().toString(36).substring(2, 7)

				attrs.$observe('registrationId', function(newValue) {
				if (newValue) {

        	                	RegistrationModel.get(newValue)
        	                	.then(function(res) {
        	                		scope.innerRegistration = res.data.data
        	                	})
				}
                                
                        })
                        scope.costEntry = function(cost) {
                                scope.selectedCost = cost
                                $('#cost-entry-' + scope.modalId).modal('show')
                        }
                        
                        scope.costStore = function(cost) {
                                RegistrationModel.update.cost(scope.innerRegistration.id, cost)
                                .then(function(res) {
                                        scope.innerRegistration = res.data.data
                                        $('#cost-entry-' + scope.modalId).modal('hide')
                                })
                        }
                        scope.generateReceiptRegistrationCost =  function(cost) {

                                window.open(LinkFactory.dealer.polReg.registration.views + 'generate-receipt-registration-cost/' + scope.innerRegistration.id + '?' + $.param({jwt: JwtValidator.encodedJwt, cost_name: cost.name}));
               
                        }
                
			}
		}

	})