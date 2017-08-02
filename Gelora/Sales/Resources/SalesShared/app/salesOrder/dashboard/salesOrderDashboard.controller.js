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
                        type: "spline",
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
                        type: "spline",
                        name: "Tunai",
                        showInLegend: true,
                        dataPoints: _.map(grouped.byDate, function(value) {
                            return {
                                x: new Date(value.date),
                                y: _.filter(value.salesOrders, { 'payment_type': 'cash' }).length
                            }
                        }),
                        lineColor: 'red',
                        markerColor: 'red'
                    }, {
                        type: "spline",
                        name: "Total",
                        showInLegend: true,
                        dataPoints: _.map(grouped.byDate, function(value) {
                            return {
                                x: new Date(value.date),
                                y: value.salesOrders.length
                            }
                        }),
                        lineColor: '#08109b',
                        markerColor: '#08109b'
                    }, ],
                });
                totalDaily.render()
            },
            cashCreditShare: function(salesOrders) {

                var cashCreditShare = new CanvasJS.Chart("cash-credit-share", {
                    data: [{
                        type: "doughnut",
                        toolTipContent: "{y} Unit",
                        dataPoints: [{
                            indexLabel: 'Tunai',
                            y: _.filter(vm.salesOrders, { 'payment_type': 'cash' }).length,
                        }, {
                            indexLabel: 'Kredit',
                            y: _.filter(vm.salesOrders, { 'payment_type': 'credit' }).length,
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
                        toolTipContent: "{y} Unit ({percentage} %)",
                        dataPoints: _.map(mainLeasings, function(mainLeasing) {
                            var y = _.filter(vm.salesOrders, { main_leasing_name: mainLeasing['main_leasing_name'] }).length
                            return {
                                indexLabel: mainLeasing['main_leasing_name'],
                                y: y,
                                percentage: _.round(y / vm.salesOrders.length, 1) * 100
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
                        toolTipContent: "{y} unit ({percentage} %)",
                        dataPoints: _.map(positions, function(position) {
                            var y = _.filter(vm.salesOrders, { sales_personnel_position_text: position['sales_personnel_position_text'] }).length
                            return {
                                indexLabel: position['sales_personnel_position_text'],
                                y: y,
                                percentage: _.round(y / vm.salesOrders.length, 1) * 100
                            }
                        })
                    }],
                })
                salesPositionShare.render()
            },
            teamShare: function() {

                var teams = _.uniqBy(vm.salesOrders, 'sales_personnel_team_name')

                var salesPositionShare = new CanvasJS.Chart("team-share", {
                    data: [{
                        type: "doughnut",
                        toolTipContent: "{y} unit ({percentage} %)",
                        dataPoints: _.map(teams, function(team) {
                            var y = _.filter(vm.salesOrders, { sales_personnel_team_name: team['sales_personnel_team_name'] }).length
                            return {
                                indexLabel: team['sales_personnel_team_name'],
                                y: y,
                                percentage: _.round(y / vm.salesOrders.length, 1) * 100
                            }
                        })
                    }],
                })
                salesPositionShare.render()
            },
            salesmanShare: function() {

                var salesmans = _.uniqBy(vm.salesOrders, 'sales_personnel_name')

                var salesPositionShare = new CanvasJS.Chart("salesman-share", {
                    axisX: {
                        interval: 1,
                        labelFontSize: 10,
                        labelFontStyle: "normal",
                        labelFontWeight: "normal",
                        labelFontFamily: "Lucida Sans Unicode"

                    },
                    axisY2: {

                        gridColor: "rgba(1,77,101,.1)"
                    },
                    data: [{
                        type: "stackedBar",
                        showInLegend: true,
                        name: "Cash",
                        toolTipContent: 'Cash: {y}',
                        axisYType: "secondary",
                        color: "#014D65",
                        dataPoints: _.orderBy(_.map(salesmans, function(salesman) {
                            var inType = _.filter(vm.salesOrders, { sales_personnel_name: salesman['sales_personnel_name'] })
                            return {
                                label: salesman['sales_personnel_name'],
                                y: _.filter(inType, { 'payment_type': 'cash' }).length,
                                total_type: inType.length
                            }
                        }), 'total_type')
                    }, {
                        type: "stackedBar",
                        showInLegend: true,
                        name: "Credit",
                        toolTipContent: 'Credit: {y}',
                        axisYType: "secondary",
                        color: "#e62739",
                        dataPoints: _.orderBy(_.map(salesmans, function(salesman) {
                            var inType = _.filter(vm.salesOrders, { sales_personnel_name: salesman['sales_personnel_name'] })
                            return {
                                label: salesman['sales_personnel_name'],
                                y: _.filter(inType, { 'payment_type': 'credit' }).length,
                                total_type: inType.length
                            }
                        }), 'total_type')
                    }],
                })
                salesPositionShare.render()
            },
            typeShare: function() {

                var types = _.uniqBy(vm.salesOrders, 'unit_type_code')


                var salesPositionShare = new CanvasJS.Chart("type-share", {
                    axisX: {
                        interval: 1,
                        gridThickness: 0,
                        labelFontSize: 10,
                        labelFontStyle: "normal",
                        labelFontWeight: "normal",

                    },
                    axisY2: {
                        gridColor: "rgba(1,77,101,.1)"

                    },
                    data: [{
                        type: "stackedBar",
                        showInLegend: true,
                        name: "Cash",
                        toolTipContent: 'Cash: {y}',
                        axisYType: "secondary",
                        color: "#014D65",
                        dataPoints: _.orderBy(_.map(types, function(type) {
                            var inType = _.filter(vm.salesOrders, { unit_type_code: type['unit_type_code'] })
                            return {
                                label: type['unit_type_name'],
                                y: _.filter(inType, { 'payment_type': 'cash' }).length,
                                total_type: inType.length
                            }
                        }), 'total_type')
                    }, {
                        type: "stackedBar",
                        showInLegend: true,
                        name: "Credit",
                        toolTipContent: 'Credit: {y}',
                        axisYType: "secondary",
                        color: "#e62739",
                        dataPoints: _.orderBy(_.map(types, function(type) {
                            var inType = _.filter(vm.salesOrders, { unit_type_code: type['unit_type_code'] })
                            return {
                                label: type['unit_type_name'],
                                y: _.filter(inType, { 'payment_type': 'credit' }).length,
                                total_type: inType.length
                            }
                        }), 'total_type')
                    }],
                })
                salesPositionShare.render()
            },
            all: function() {
                this.totalDaily()
                this.leasingShare()
                this.cashCreditShare()
                this.salesPositionShare()
                this.teamShare()
                this.salesmanShare()
                this.typeShare()

            }
        }

    })