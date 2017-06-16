geloraBase
	.config(function($stateProvider, $urlRouterProvider) {

		$urlRouterProvider.otherwise('/index');

		$stateProvider
		.state('index', {
			url: '/index',
  			templateUrl: 'app/index/index.html',
  			controller: 'IndexController as ctrl',
  			requireLogin: false,
  			pageTitle: 'Dealer | Base'
		})

		.state('unitIndex', {
			url: '/unit/index',
  			templateUrl: 'app/unit/index/unitIndex.html',
  			controller: 'UnitIndexController as ctrl',
  			pageTitle: 'Dealer | Base | unit Index'
		})
		.state('unitShow', {
			url: '/unit/show/:id',
  			templateUrl: 'app/unit/show/unitShow.html',
  			controller: 'UnitShowController as ctrl',
  			pageTitle: 'Dealer | Base | unit Show'
		})

		.state('accountIndex', {
			url: '/account/index',
  			templateUrl: 'app/account/index/accountIndex.html',
  			controller: 'AccountIndexController as ctrl',
  			pageTitle: 'Dealer | Base | Account Index'
		})
		.state('accountShow', {
			url: '/account/show',
  			templateUrl: 'app/account/show/accountShow.html',
  			controller: 'AccountShowController as ctrl',
  			pageTitle: 'Dealer | Base | Account Show'
		})

		.state('priceIndex', {
			url: '/price/index',
  			templateUrl: 'app/price/index/priceIndex.html',
  			controller: 'PriceIndexController as ctrl',
  			pageTitle: 'Dealer | Base | Price Index'
		})
		.state('priceShow', {
			url: '/price/show/:id',
  			templateUrl: 'app/price/show/priceShow.html',
  			controller: 'PriceShowController as ctrl',
  			pageTitle: 'Dealer | Base | Price Show'
		})
		.state('priceUpload', {
			url: '/price/upload',
  			templateUrl: 'app/price/upload/priceUpload.html',
  			controller: 'PriceUploadController as ctrl',
  			pageTitle: 'Dealer | Base | Price Show'
		})

		.state('settingIndex', {
			url: '/setting/index',
  			templateUrl: 'app/setting/index/settingIndex.html',
  			controller: 'SettingIndexController as ctrl',
  			pageTitle: 'Dealer | Base | Setting'
		})
		.state('settingDriver', {
			url: '/setting/driver',
  			templateUrl: 'app/setting/driver/settingDriver.html',
  			controller: 'SettingDriverController as ctrl',
  			pageTitle: 'Dealer | Base | Setting'
		})
		.state('settingAgreementBPKB', {
			url: '/setting/settingAgreementBPKB',
  			templateUrl: 'app/setting/agreementBPKB/settingAgreementBPKB.html',
  			controller: 'SettingAgreementBPKBController as ctrl',
  			pageTitle: 'Dealer | Base | Setting'
		})
		.state('settingPolReg', {
			url: '/setting/settingPolReg',
  			templateUrl: 'app/setting/polReg/settingPolReg.html',
  			controller: 'SettingPolRegController as ctrl',
  			pageTitle: 'Dealer | Base | Setting'
		})
		.state('locationIndex', {
			url: '/location/index',
  			templateUrl: 'app/location/index/locationIndex.html',
  			controller: 'LocationIndexController as ctrl',
  			pageTitle: 'Dealer | Base | Location Index'
		})
		.state('locationShow', {
			url: '/location/show/:id',
  			templateUrl: 'app/location/show/locationShow.html',
  			controller: 'LocationShowController as ctrl',
  			pageTitle: 'Dealer | Base | Location Show'
		})
		.state('salesProgramIndex', {
			url: '/salesProgram/index',
  			templateUrl: 'app/salesProgram/index/salesProgramIndex.html',
  			controller: 'SalesProgramIndexController as ctrl',
  			pageTitle: 'Dealer | Base | Sales Program Index'
		})
		.state('salesProgramShow', {
			url: '/salesProgram/show/:id',
  			templateUrl: 'app/salesProgram/show/salesProgramShow.html',
  			controller: 'SalesProgramShowController as ctrl',
  			pageTitle: 'Dealer | Base | Sales Program Show'
		})
	})