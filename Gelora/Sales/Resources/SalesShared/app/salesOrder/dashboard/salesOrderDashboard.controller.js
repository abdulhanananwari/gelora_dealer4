geloraSalesShared
    .controller('SalesOrderDashboardController', function(
        SalesOrderModel) {

        var vm = this

        vm._ = _

        var keyParameters = {
            dates: [],
            mainLeasings: [],
            subLeasings: [],
            unitTypes: []
        }

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

                    group.all(vm.salesOrders)
                    render.all()
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

                    console.log(on)

                    grouped.byDate.push({
                        date: moment(on).startOf('day').format(),
                        salesOrders: _.filter(salesOrders, { 'delivery_generated_on': on })
                    })

                    on = moment(on).add(1, 'day').format('YYYY-MM-DD')
                    keyParameters.dates.push(on)

                } while (moment(on).isSameOrBefore(until))

                return grouped.byDate
            },
            byMainLeasing: function(salesOrders) {

                grouped.byMainLeasing = []

                keyParameters.mainLeasings = _.uniq(_.map(salesOrders, 'main_leasing_name'))

                _.each(keyParameters.mainLeasings, function(leasingName) {

                    grouped.byMainLeasing.push({
                        main_leasing_name: leasingName,
                        salesOrders: _.filter(salesOrders, { 'main_leasing_name': leasingName })
                    })

                })

                return grouped.byMainLeasing
            },
            all: function(salesOrders) {
                this.byDate(salesOrders)
                this.byMainLeasing(salesOrders)
            }
        }


        var render = {
            totalDaily: function() {

                var totalDaily = new CanvasJS.Chart("daily-sales", {
                    backgroundColor: 'transparent',
                    axisX: {
                        valueFormatString: "YYYY-MM-DD",
                        interval: 1,
                        intervalType: "day"
                    },
                    data: [{
                        type: "line",
                        name: "Kredit",
                        showInLegend: true,
                        dataPoints: _.map(grouped.byDate, function(value) {
                            return {
                                x: new Date(value.date),
                                y: _.filter(value.salesOrders, { 'payment_type': 'credit' }).length
                            }
                        }),
                        lineColor: '#f4602a',
                        markerColor: '#f4602a'
                    }, {
                        type: "line",
                        name: "Tunai",
                        showInLegend: true,
                        dataPoints: _.map(grouped.byDate, function(value) {
                            return {
                                x: new Date(value.date),
                                y: _.filter(value.salesOrders, { 'payment_type': 'cash' }).length
                            }
                        }),
                        lineColor: '#08109b',
                        markerColor: '#08109b'
                    }, {
                        type: "line",
                        name: "Total",
                        showInLegend: true,
                        dataPoints: _.map(grouped.byDate, function(value) {
                            return {
                                x: new Date(value.date),
                                y: value.salesOrders.length
                            }
                        }),
                        lineColor: 'red',
                        markerColor: 'red'
                    }, ],
                });
                totalDaily.render()
            },
            cashCreditShare: function(salesOrders) {

                var cashCreditShare = new CanvasJS.Chart("cash-credit-share", {
                    data: [{
                        type: "doughnut",
                        dataPoints: [{
                            indexLabel: 'Tunai',
                            y: _.filter(vm.salesOrders, { 'payment_type': 'cash' }).length
                        }, {
                            indexLabel: 'Kredit',
                            y: _.filter(vm.salesOrders, { 'payment_type': 'credit' }).length
                        }]
                    }],
                })
                cashCreditShare.render()
            },
            leasingShare: function(salesOrders) {

                var leasingShare = new CanvasJS.Chart("leasing-share", {
                    data: [{
                        type: "doughnut",
                        dataPoints: _.map(grouped.byMainLeasing, function(value) {
                            return {
                                indexLabel: value.main_leasing_name,
                                y: value.salesOrders.length
                            }
                        })
                    }],
                })
                leasingShare.render()
            },
            all: function() {
                this.totalDaily()
                this.leasingShare()
                this.cashCreditShare()
            }
        }

    })
