geloraBaseShared
	.factory('LinkFactory', function() {

		var hostname = window.location.hostname
		var env = hostname.substring(0,3) == '192' ? 'dev' : 'prod';

		var domains = {
			accounts: 'https://accounts.xolura.com/',
			dealer: window.location.protocol + '//' + window.location.host + '/',
			// entity: env == 'dev' ? 'http://' + hostname + ':10777/' : 'https://entity.hondagelora.com/',
			// vehicle: env == 'dev' ? 'http://' + hostname + ':11088/' : 'https://kendaraan.hondagelora.com/',
			entity:  env == 'dev' ? 'http://' + hostname + ':10777/' : 'https://entity.hondagelora.com/',
			vehicle: 'https://kendaraan.hondagelora.com/',
			transaction: env == 'dev' ? 'http://' + hostname + ':11019/' : 'https://transaction.hondagelora.com/',
		}

		var apps = {
			authentication: domains.accounts + 'views/user/',
			dealer: {
				base: domains.dealer + 'base/',
				purchase: domains.dealer + 'purchase/api/',
				inventoryManagement: domains.dealer + 'inventory-management/api/',
				creditSales: domains.dealer + 'credit-sales/',
				humanResource: domains.dealer + 'human-resource/api/',
				sales: domains.dealer + 'sales/',
				consignment: domains.dealer + 'consignment/',
				polReg: domains.dealer + 'pol-reg/',
				cdb: domains.dealer + 'cdb/',
				delivery: domains.dealer + 'delivery/'
			},
			vehicle: domains.vehicle + 'api/',
			transaction: domains.transaction + 'api/'
		}

		var urls = {

			authentication: {
				login: apps.authentication + 'authentication/login',
				tenantSelect: apps.authentication + 'token-exchange/tenant-select'
			},

			dealer: {
				base: {
					account: apps.dealer.base + 'api/account/',
					
					price: {
						base: apps.dealer.base + 'api/price/',
						report: apps.dealer.base + 'report/price'
					},
					unit: {
						base: apps.dealer.base + 'api/unit/',
						report: apps.dealer.base + 'report/unit'
					},
					location: {
						base: apps.dealer.base + 'api/location/'
					},
					salesProgram : {
						base: apps.dealer.base + 'api/sales-program/'
					}
				},
				purchase: {
					purchase: apps.dealer.purchase + 'purchase/'
				},
				inventoryManagement: {
					movementOrderHeader: apps.dealer.inventoryManagement + 'movement-order-header/',
					movementOrderDetail: apps.dealer.inventoryManagement + 'movement-order-detail/',
				},
				creditSales: {
					leasing: {
						base: apps.dealer.creditSales + 'api/leasing/'
					},
					leasingPromo: {
						base: apps.dealer.creditSales + 'api/leasing-promo/'
					},
					leasingProgram: {
						base: apps.dealer.creditSales + 'api/leasing-program/'
					},
					leasingPersonnel: {
						base: apps.dealer.creditSales + 'api/leasing-personnel/'
					},
					leasingOrder: {
						base: apps.dealer.creditSales + 'api/leasing-order/',
						redirectApp: apps.dealer.creditSales + 'redirect-app/leasing-order/',
						views:apps.dealer.creditSales + 'views/leasing-order/',
                        report:apps.dealer.creditSales + 'report/leasing-order'
					}
				},
				delivery: {
					delivery: {
						base:apps.dealer.delivery + 'api/delivery/',
						scan:apps.dealer.delivery + 'trigger/delivery/',
						print:apps.dealer.delivery+ 'views/delivery/print/',
						redirectApp: apps.dealer.delivery + 'redirect-app/delivery/'
					},
					deliveryBatch: {
						base:apps.dealer.delivery + 'api/delivery-batch/'
					}
				},
				sales: {
					salesOrder: {
						base: apps.dealer.sales + 'api/sales-order/',
						report: apps.dealer.sales + 'report/sales-order',
						print:apps.dealer.sales + 'views/sales-order/delivery/print/',
						scan:apps.dealer.sales + 'trigger/sales-order/delivery/',
					},
					prospect: {
						base: apps.dealer.sales + 'api/prospect/',
						report: apps.dealer.sales + 'report/prospect',
						salesPersonnel: {
							base: apps.dealer.sales + 'api-sales-personnel/prospect/',
						}
					},
					salesOrderExtra: {
						base: apps.dealer.sales + 'api/sales-order-extra/'
					},
					cancelledSalesOrder: {
						base: apps.dealer.sales + 'api/cancelled-sales-order/'
					},
				},
				humanResource: {
					position: {
						base: apps.dealer.humanResource + 'position/'
					},
					team: {
						base: apps.dealer.humanResource + 'team/'
					},
					personnel: {
						base: apps.dealer.humanResource + 'personnel/'
					},
				},
				consignment: {
					consignmentDetail: {
						base: apps.dealer.consignment + 'api/consignment-detail/',
						generate: {
							fromSalesOrder: apps.dealer.consignment + 'generate/consignment-detail/from-sales-order/'
						}
					},
					consignmentHeader: {
						base: apps.dealer.consignment + 'api/consignment-header/'
					}
				},
				polReg: {
					registration: {
						base: apps.dealer.polReg + 'api/registration/',
						views: apps.dealer.polReg + 'views/registration/',
						report: apps.dealer.polReg + 'report/registration/',
					}, 
					registrationMdSubmissionBatch: {
						base: apps.dealer.polReg + 'api/registration-md-submission-batch/',
					},
					registrationAgencySubmissionBatch: {
						base: apps.dealer.polReg + 'api/registration-agency-submission-batch/',
						views: apps.dealer.polReg + 'views/registration-agency-submission-batch/',
					},
					registrationAgencyInvoice: {
						base: apps.dealer.polReg + 'api/registration-agency-invoice/',
					},
					registrationLeasingBpkbSubmissionBatch: {
						base: apps.dealer.polReg + 'api/registration-leasing-bpkb-submission-batch/',
						views: apps.dealer.polReg + 'views/registration-leasing-bpkb-submission-batch/',
					}
				},
				cdb: {
					cddb: {
						base: apps.dealer.cdb + 'api/cddb/'
					}
				},
				views: {
					base: {
						unitSearch: apps.dealer.base + 'view/dealer-unit-search.html',
						unitFilter: apps.dealer.base + 'view/dealer-unit-filter.html',
						locationFinder:  apps.dealer.base + 'view/dealer-location-finder.html',
						unitBarcodeFinder: apps.dealer.base + 'view/dealer-unit-barcode-finder.html'
					}
				},
				plugins: {
					leasingSelector: domains.dealer + 'gelora/dealer-plugins/leasing-selector/app.js',
					salesOrderFilter: domains.dealer + 'gelora/dealer-plugins/salesOrder-filter/app.js',
					unitSearch: domains.dealer + 'gelora/dealer-plugins/unit-search/app.js',
				},
			},

			setting: {
				setting: {
					base: domains.dealer + 'setting/api/setting/'
				}
			},

			vehicle: {
				plugins: {
					modelFinder: domains.vehicle + 'plugins/model-finder/app.js'
				},
				model: {
					base: apps.vehicle + 'model/'
				}
			},

			entity: {
				base: domains.entity,
				plugins: {
					entityFinder: domains.entity + 'plugins/entity-finder/app.js',
					entityUpdater: domains.entity + 'plugins/entity-updater/app.js'
				}
			},

			transaction: {
				transaction: {
					base: domains.transaction + 'api/transaction/'
				},
				receivable: {
					base: domains.transaction + 'api/receivable/'
				},
				plugins: {
					transaction: domains.transaction + 'plugins/all.js'
				},
				printer: {
					transaction: domains.transaction + 'printer/transaction/',
				}
			}

		}


		return urls
	})