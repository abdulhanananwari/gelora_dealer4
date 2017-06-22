geloraSalesShared
	.directive('salesOrderFilter', function(
		$timeout,
		SalesOrderModel) {

		return {
			restrict: "AE",
			templateUrl: '/gelora/sales-shared/app/salesOrder/directives/filter/salesOrderFilter.html',
			scope: {
				salesOrders: '=',
				meta: '=',
				page: '=',
				load: "&"
			},
			link: function(scope, element, attrs) {
				
				scope.filter = {
					time_type: 'created_at',
					order_by: 'created_at',
					order: 'desc'
				}

				$('.date').datepicker({dateFormat: "yy-mm-dd"});

				scope.modalId = Math.random().toString(36).substring(2, 7)
				scope.customerTypes = ['Perorangan', 'Badan Usaha']
				scope.paymentTypes = {'credit': 'Kredit', 'cash': 'Kas'}
				scope.statuses = {'validated' : 'Validasi', 'delivery_generated' : 'Sudah Buat Surat Jalan', 'delivery_handover_created': 'Sudah serah terima', 'financial_completed' : 'Konsumen yang sudah lunas'}
			    scope.dateTypes = {'created_at' : 'Tanggal SPK', 'validated_at' : 'Tanggal Validasi','delivery_generated_at':'Tanggal Buat Surat Jalan', 'delivery_handover_created_at': 'Tanggal Serah terima kendaraan'}
			    
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