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

                    grouped.byDate.push({
                        date: moment(on).startOf('day').format(),
                        salesOrders: _.filter(salesOrders, { 'delivery_generated_on': on })
                    })

                    on = moment(on).add(1, 'day').format('YYYY-MM-DD')
                    keyParameters.dates.push(on)

                } while (moment(on).isSameOrBefore(until))

                return grouped.byDate
            },
            all: function(salesOrders) {
                this.byDate(salesOrders)
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
            leasingShare: function() {

                var mainLeasings = _.uniqBy(vm.salesOrders, 'main_leasing_name')

                var leasingShare = new CanvasJS.Chart("leasing-share", {
                    data: [{
                        type: "doughnut",
                        dataPoints: _.map(mainLeasings, function(mainLeasing) {
                            return {
                                indexLabel: mainLeasing['main_leasing_name'],
                                y: _.filter(vm.salesOrders, {main_leasing_name: mainLeasing['main_leasing_name']}).length
                            }
                        })
                    }],
                })
                leasingShare.render()
            },
            salesPositionShare: function() {

                var positions = _.uniqBy(vm.salesOrders, 'sales_personnel_position_text')

                var salesPositionShare = new CanvasJS.Chart("sales-position-share", {
                    data: [{
                        type: "doughnut",
                        dataPoints: _.map(positions, function(position) {
                            return {
                                indexLabel: position['sales_personnel_position_text'],
                                y: _.filter(vm.salesOrders, {sales_personnel_position_text: position['sales_personnel_position_text']}).length
                            }
                        })
                    }],
                })
                salesPositionShare.render()
            },
            all: function() {
                this.totalDaily()
                this.leasingShare()
                this.cashCreditShare()
                this.salesPositionShare()
            }
        }

    })
