geloraSalesAdmin
    .controller('SalesOrderReportController', function(
        SalesOrderModel, LinkFactory, JwtValidator) {

        var vm = this

        vm.filter = {
            delivery_from: moment().subtract(30, 'days').format("YYYY-MM-DD"),
            delivery_until: moment().format("YYYY-MM-DD"),
            sales_order_from: moment().subtract(30, 'days').format("YYYY-MM-DD"),
            sales_order_until: moment().format("YYYY-MM-DD"),
        }

        vm.customerTypes = ['Perorangan', 'Badan Usaha']
        vm.paymentTypes = { 'credit': 'Kredit', 'cash': 'Kas' }

        $('.date').datepicker({ dateFormat: "yy-mm-dd" });

        vm.download = function(filter) {

            vm.filter.jwt = JwtValidator.encodedJwt

            window.open(LinkFactory.dealer.sales.salesOrder.report + '?' + $.param(vm.filter))
        }

    })
