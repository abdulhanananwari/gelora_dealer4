geloraSalesShared
    .controller('SalesOrderDashboardController', function(
        SalesOrderModel) {

        var vm = this

        vm.filter = {
            from: moment().subtract(30, 'days').format("YYYY-MM-DD"),
            until: moment().format("YYYY-MM-DD"),
            time_type: 'delivery.generated_at',
            transformer: 'SalesOrderDashboardTransformer',
        }

        vm.load = function(filter) {

            SalesOrderModel.index(filter)
                .then(function(res) {

                	if (res.data.data.length == 0) {
                		alert('Tidak ada data penjualan ditemukan')
                	}

                    vm.salesOrders = _.map(res.data.data, function(data) {
                        data.delivery_generated_on = moment(data.delivery_generated_at).format('YYYY-MM-DD')
                        return data;
                    })

                    render(vm.salesOrders)
                })
        }
        vm.load(vm.filter)

        var grouped = {}

        var group = {
            byDate: function(salesOrders) {

                grouped.byDate = []

                var on = _.minBy(salesOrders, 'delivery_generated_on')['delivery_generated_on']
                var until = _.maxBy(salesOrders, 'delivery_generated_on')['delivery_generated_on']

                do {

                    grouped.byDate.push({
                        date: on,
                        salesOrders: _.filter(salesOrders, { 'delivery_generated_on': on })
                    })

                    on = moment(on).add(1, 'day').format('YYYY-MM-DD')

                } while (moment(on).isSameOrBefore(until))

                return grouped.byDate
            },
            run: function(salesOrders) {
                this.byDate(salesOrders)
            }
        }

        function render(salesOrders) {

            group.run(salesOrders)

            // Daily sales
            var chart = new Chart($('#daily-sales'), {
                type: 'line',
                data: {
                    labels: _.map(grouped.byDate, 'date'),
                    datasets: [{
                        label: 'Total',
                        data: _.map(grouped.byDate, function(value) {
                            return value.salesOrders.length
                        }),
                        borderColor: "rgba(255,0,0,1)",
                        fill: false
                    }, {
                        label: 'Kredit',
                        data: _.map(grouped.byDate, function(value) {
                            return _.filter(value.salesOrders, { 'payment_type' : 'credit' }).length
                        }),
                        borderColor: "rgba(234, 188, 2,1)",
                        fill: false
                    },{
                        label: 'Cash',
                        data: _.map(grouped.byDate, function(value) {
                            return _.filter(value.salesOrders, { 'payment_type' : 'cash' }).length
                        }),
                        borderColor: "rgba(66, 134, 244,1)",
                        fill: false
                    }],
                },
                options: {
                    title: {
                        text: 'Penjualan'
                    },
                }
            })
        }

    })
