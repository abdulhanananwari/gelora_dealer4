geloraSalesShared
    .controller('SalesOrderReportController', function(
        SalesOrderModel, LinkFactory, JwtValidator) {

        var vm = this

        vm.filter = {}

        vm.download = function(filter) {

            vm.filter.jwt = JwtValidator.encodedJwt

            window.open(LinkFactory.dealer.sales.salesOrder.report + '?' + $.param(vm.filter))
        }

    })
