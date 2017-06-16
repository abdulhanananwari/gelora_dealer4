geloraDealerLeasingApp
	.factory('LinkFactory', function() {

		var hostname = window.location.hostname
		var env = hostname.substring(0,3) == '192' ? 'dev' : 'prod';

		var domains = {
			accounts: 'https://accounts.xolura.com/',
			dealer: window.location.protocol + '//' + window.location.host + '/',
			vehicle: 'https://kendaraan.hondagelora.com/',
		}

		var apps = {
			authentication: domains.accounts + 'views/user/',
			dealer: {
				base: domains.dealer + 'base/',
				creditSales: domains.dealer + 'credit-sales/leasing-app/'
			},
			vehicle: domains.vehicle + 'api/',
		}

		var urls = {

			authentication: {
				login: apps.authentication + 'authentication/login',
				tenantSelect: apps.authentication + 'token-exchange/tenant-select'
			},

			dealer: {
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
						views:apps.dealer.creditSales + 'views/leasing-order/'
					}
				},
				plugins: {
					leasingSelector: domains.dealer + 'gelora/dealer-plugins/leasing-selector/app.js',
					salesOrderFilter: domains.dealer + 'gelora/dealer-plugins/salesOrder-filter/app.js',
					unitSearch: domains.dealer + 'gelora/dealer-plugins/unit-search/app.js',
				},
			},

			vehicle: {
				plugins: {
					modelFinder: domains.vehicle + 'plugins/model-finder/app.js'
				},
				model: {
					base: apps.vehicle + 'model/'
				}
			},
		}


		return urls
	})