geloraDealerCreditSales
    .controller('LeasingOrderReportController', function(
        LeasingOrderModel, LinkFactory, JwtValidator) {

        var vm = this
        
        vm.filter = {
            from: moment().subtract(30, 'days').format("YYYY-MM-DD"),
            until: moment().format("YYYY-MM-DD"),
        }

      
        $('.date').datepicker({ dateFormat: "yy-mm-dd" });

        vm.download = function(filter) {

            vm.filter.jwt = JwtValidator.encodedJwt

            window.open(LinkFactory.dealer.creditSales.leasingOrder.report + '?' + $.param(vm.filter))
        }

    })
