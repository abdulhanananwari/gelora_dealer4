geloraHumanResource
    .config(function($stateProvider, $urlRouterProvider) {

        $urlRouterProvider.otherwise('/index');

        $stateProvider
            .state('index', {
                url: '/index',
                templateUrl: 'app/index/index.html',
                controller: 'IndexController as ctrl',
                requireLogin: false,
                pageTitle: 'Dealer | Human Resource'
            })

        .state('positionIndex', {
                url: '/position/index',
                templateUrl: 'app/position/index/positionIndex.html',
                controller: 'PositionIndexController as ctrl',
                pageTitle: 'Dealer | Human Resource | Posisi'
            })
            .state('positionShow', {
                url: '/position/show/:id',
                templateUrl: 'app/position/show/positionShow.html',
                controller: 'PositionShowController as ctrl',
                pageTitle: 'Dealer | Human Resource | Posisi'
            })

        .state('teamIndex', {
                url: '/team/index',
                templateUrl: 'app/team/index/teamIndex.html',
                controller: 'TeamIndexController as ctrl',
                pageTitle: 'Dealer | Human Resource | Team'
            })
            .state('teamShow', {
                url: '/team/show/:id',
                templateUrl: 'app/team/show/teamShow.html',
                controller: 'TeamShowController as ctrl',
                pageTitle: 'Dealer | Human Resource | Team'
            })

        .state('personnelIndex', {
                url: '/personnel/index',
                templateUrl: 'app/personnel/index/personnelIndex.html',
                controller: 'PersonnelIndexController as ctrl',
                pageTitle: 'Dealer | Human Resource | Personnel'
            })
            .state('personnelShow', {
                url: '/personnel/show/:id',
                templateUrl: 'app/personnel/show/personnelShow.html',
                controller: 'PersonnelShowController as ctrl',
                pageTitle: 'Dealer | Human Resource | Personnel'
            })


        .state('adminIndex', {
                url: '/admin/index',
                templateUrl: 'app/admin/index/adminIndex.html',
                controller: 'AdminIndexController as ctrl',
                pageTitle: 'Dealer | Human Resource | Admin'
            })
    })
