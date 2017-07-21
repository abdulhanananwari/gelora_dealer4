geloraSalesAdmin
    .controller('SalesOrderIndexLeasingPaymentController', function(
        SalesOrderModel, SettingModel,
        JwtValidator) {

        var vm = this

        var load = function(filter) {

            SalesOrderModel.index(filter)
                .then(function(res) {

                    vm.salesOrders = res.data.data
                })

        }

        vm.load = {
            notCreated: function() {
                load({
                    payment_type: 'credit',
                    status: 'delivery_generated_and_not_invoiced',
                })
            },
            notSent: function() {
                load({
                    payment_type: 'credit',
                    status: 'invoice_generated_and_not_batched',
                })
            },
            notPaid: function() {
                load({
                    payment_type: 'credit',
                    status: 'invoice_batched_and_not_paid',
                })
            },
        }

    })