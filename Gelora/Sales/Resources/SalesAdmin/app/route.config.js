geloraSalesAdmin
        .config(function ($stateProvider, $urlRouterProvider, $locationProvider) {

            $locationProvider.hashPrefix('');
            $urlRouterProvider.otherwise('/index');

            $stateProvider
                    .state('index', {
                        url: '/index',
                        templateUrl: 'app/index/index.html',
                        controller: 'IndexController as ctrl',
                        requireLogin: false,
                        pageTitle: 'Dealer | Sales Admin'
                    })

                    .state('salesOrderIndex', {
                        url: '/salesOrder/index/:status',
                        templateUrl: '/gelora/sales-shared/app/salesOrder/index/salesOrderIndex.html',
                        controller: 'SalesOrderIndexController as ctrl',
                        pageTitle: 'Dealer | Sales Admin | Sales Order'
                    })
                    .state('salesOrderShow', {
                        url: '/salesOrder/show/:id',
                        templateUrl: '/gelora/sales-shared/app/salesOrder/show/salesOrderShow.html',
                        controller: 'SalesOrderShowController as ctrl',
                        pageTitle: 'Dealer | Sales Admin | Sales Order'
                    })
                    .state('salesOrderShowFinancial', {
                        url: '/salesOrder/showFinancial/:id',
                        templateUrl: '/gelora/sales-shared/app/salesOrder/showFinancial/salesOrderShowFinancial.html',
                        controller: 'SalesOrderShowFinancialController as ctrl',
                        pageTitle: 'Dealer | Sales Admin | Sales Order Financial'

                    })
                    .state('salesOrderShowCredit', {
                        url: '/salesOrder/showCredit/:id',
                        templateUrl: '/gelora/sales-shared/app/salesOrder/showCredit/salesOrderShowCredit.html',
                        controller: 'SalesOrderShowCreditController as ctrl',
                        pageTitle: 'Dealer | Sales Admin | Sales Order Credit'

                    })
                    .state('salesOrderShowCddb', {
                        url: '/salesOrder/showCddb/:id',
                        templateUrl: '/gelora/sales-shared/app/salesOrder/showCddb/salesOrderShowCddb.html',
                        controller: 'SalesOrderShowCddbController as ctrl',
                        pageTitle: 'Dealer | Sales Admin | Sales Order CDDB'

                    })
                    .state('salesOrderShowDelivery', {
                        url: '/salesOrder/showDelivery/:id/:chasisNumber',
                        templateUrl: '/gelora/sales-shared/app/salesOrder/showDelivery/salesOrderShowDelivery.html',
                        controller: 'SalesOrderShowDeliveryController as ctrl',
                        pageTitle: 'Dealer | Sales Admin | Sales Order Delivery'

                    })
                    .state('salesOrderShowExtra', {
                        url: '/salesOrder/showExtra/:id',
                        templateUrl: '/gelora/sales-shared/app/salesOrder/showExtra/salesOrderShowExtra.html',
                        controller: 'SalesOrderShowExtraController as ctrl',
                        pageTitle: 'Dealer | Sales Admin | Sales Order Financial'
                    })
                    .state('salesOrderShowStatus', {
                        url: '/salesOrder/showStatus/:id',
                        templateUrl: '/gelora/sales-shared/app/salesOrder/showStatus/salesOrderShowStatus.html',
                        controller: 'SalesOrderShowStatusController as ctrl',
                        pageTitle: 'Dealer | Sales Admin | Sales Order Status'
                    })
                    .state('salesOrderShowUnit', {
                        url: '/salesOrder/showUnit/:id',
                        templateUrl: '/gelora/sales-shared/app/salesOrder/showUnit/salesOrderShowUnit.html',
                        controller: 'SalesOrderShowUnitController as ctrl',
                        pageTitle: 'Dealer | Sales Admin | Sales Order Unit'
                    })
                    .state('salesOrderShowNote', {
                        url: '/salesOrder/showNote/:id',
                        templateUrl: '/gelora/sales-shared/app/salesOrder/showNote/salesOrderShowNote.html',
                        controller: 'SalesOrderShowNoteController as ctrl',
                        pageTitle: 'Dealer | Sales Admin | Sales Order Catatan'
                    })
                    .state('salesOrderShowRegistration', {
                        url: '/salesOrder/showRegistration/:id',
                        templateUrl: '/gelora/sales-shared/app/salesOrder/showRegistration/salesOrderShowRegistration.html',
                        controller: 'SalesOrderShowRegistrationController as ctrl',
                        pageTitle: 'Dealer | Sales Admin | Sales Order Registrasi'
                    })
                    .state('salesOrderShowDocumentation', {
                        url: '/salesOrder/showDocumentation/:id',
                        templateUrl: '/gelora/sales-shared/app/salesOrder/showDocumentation/salesOrderShowDocumentation.html',
                        controller: 'SalesOrderShowDocumentationController as ctrl',
                        pageTitle: 'Dealer | Sales Admin | Sales Order Dokumentasi'
                    })
                    .state('salesOrderShowLog', {
                        url: '/salesOrder/showLog/:id',
                        templateUrl: '/gelora/sales-shared/app/salesOrder/showLog/salesOrderShowLog.html',
                        controller: 'SalesOrderShowLogController as ctrl',
                        pageTitle: 'Dealer | Sales Admin | Log'
                    })
                    .state('salesOrderReport', {
                        url: '/salesOrder/report',
                        templateUrl: '/gelora/sales-shared/app/salesOrder/report/salesOrderReport.html',
                        controller: 'SalesOrderReportController as ctrl',
                        pageTitle: 'Dealer | Sales Admin | Sales Order Report'
                    })
                    .state('salesOrderDashboard', {
                        url: '/salesOrder/dashboard',
                        templateUrl: '/gelora/sales-shared/app/salesOrder/dashboard/salesOrderDashboard.html',
                        controller: 'SalesOrderDashboardController as ctrl',
                        pageTitle: 'Dealer | Sales Admin | Sales Order Report'
                    })
                    .state('cancelledSalesOrderIndex', {
                        url: '/cancelledSalesOrder/index',
                        templateUrl: 'app/cancelledSalesOrder/index/cancelledSalesOrderIndex.html',
                        controller: 'CancelledSalesOrderIndexController as ctrl',
                        pageTitle: 'Dealer | Sales Admin | Cancel Sales Order'
                    })


                    .state('salesOrderCustomerInvoiceIndex', {
                        url: '/salesOrder/customerInvoiceIndex/',
                        templateUrl: 'app/salesOrder/customerInvoiceIndex/salesOrderCustomerInvoiceIndex.html',
                        controller: 'SalesOrderCustomerInvoiceIndexController as ctrl',
                        pageTitle: 'Dealer | Sales Admin | Daftar Kustomer Invoice Pending'

                    })
                    .state('salesOrderIndexDelivery', {
                        url: '/salesOrder/indexDelivery',
                        templateUrl: 'app/salesOrder/index/delivery/salesOrderIndexDelivery.html',
                        controller: 'SalesOrderIndexDeliveryController as ctrl',
                        pageTitle: 'Dealer | Sales Admin | Daftar Kustomer Invoice Pending'

                    })

                    .state('prospectIndex', {
                        url: '/prospect/index',
                        templateUrl: '/gelora/sales-shared/app/prospect/index/prospectIndex.html',
                        controller: 'ProspectIndexController as ctrl',
                        pageTitle: 'Dealer | Sales | Prospect Index'
                    })
                    .state('prospectShow', {
                        url: '/prospect/show/:id',
                        templateUrl: '/gelora/sales-shared/app/prospect/show/prospectShow.html',
                        controller: 'ProspectShowController as ctrl',
                        pageTitle: 'Dealer | Sales | Prospect Show'
                    })

        })