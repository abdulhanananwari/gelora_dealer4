geloraSalesShared
	.directive('salesOrderFilter', function(
		$timeout,
		SalesOrderModel) {

		return {
			restrict: "AE",
			templateUrl: '/gelora/sales-shared/app/salesOrder/filter/salesOrderFilter.html',
			scope: {
				salesOrders: '=',
				meta: '=',
				page: '=',
				load: "&"
			},
			link: function(scope, element, attrs) {
				
				scope.filter = {}

				$('.date').datepicker({dateFormat: "yy-mm-dd"});

				scope.modalId = Math.random().toString(36).substring(2, 7)
				scope.customerTypes = ['Perorangan', 'Badan Usaha']
				scope.paymentTypes = {'credit': 'Kredit', 'cash': 'Kas'}
			    scope.$watch('page', function() {
			    	
			    	scope.filter.page = scope.page
			    	scope.load(scope.filter)
			    })

				scope.load = function(filter) {

					SalesOrderModel.index(filter)
					.then(function(res) {

						scope.salesOrders = res.data.data
						scope.meta = res.data.meta

						$('#spk-filter-modal-' + scope.modalId).modal('hide')

						if (scope.meta.pagination) {
							scope.filter.paginate = scope.meta.pagination.per_page
						}


					})
				}

			}
		}
	})