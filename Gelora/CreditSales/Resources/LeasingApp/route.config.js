geloraDealerLeasingApp
    .config(function($stateProvider, $urlRouterProvider) {

        $urlRouterProvider.otherwise('/index');

        $stateProvider
            .state('index', {
                url: '/index',
                templateUrl: 'app/index/index.html',
                controller: 'IndexController as ctrl',
                requireLogin: false,
                pageTitle: 'Dealer | Credit Sales'
            })
            .state('leasingOrderShow', {
                url: '/leasingOrder/show/:id',
                templateUrl: 'app/leasingOrder/show/leasingOrderShow.html',
                controller: 'LeasingOrderShowController as ctrl',
                pageTitle: 'Dealer | Credit Sales'
            })
            .state('leasingOrderIndex', {
                url: '/leasingOrder/index/:id',
                templateUrl: 'app/leasingOrder/index/leasingOrderIndex.html',
                controller: 'LeasingOrderIndexController as ctrl',
                pageTitle: 'Dealer | Credit Sales'
            })


    })
