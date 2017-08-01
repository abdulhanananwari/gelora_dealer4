geloraInventoryManagement
    .controller('UnitDashboardController', function(
        UnitModel) {

        var vm = this

        vm.filter = {
            transformer: 'UnitDashboardTransformer',
            statuses_in: 'IN_STOCK_SELLABLE,IN_STOCK_NOT_SELLABLE,UNRECEIVED',
            include: 'currentLocation'
        }

        vm.data = {}

        vm.load = function(filter) {

            UnitModel.index(filter)
                .then(function(res) {

                    if (res.data.data.length == 0) {
                        alert('Tidak ada data unit ditemukan')
                    }

                    vm.units = _.map(res.data.data, function(unit) {
                        if (unit.currentLocation) {
                            unit.currentLocation = unit.currentLocation.data
                        }
                        return unit;
                    })

                    render.all()
                })
        }
        vm.load(vm.filter)

        var render = {
            currentStocks: function() {

                var typeCodes = _.uniqBy(vm.units, 'type_code')

                var currentStocks = new CanvasJS.Chart("current-stocks", {
                    axisX: {
                        interval: 1,
                        gridThickness: 0,
                        labelFontSize: 10,
                        labelFontStyle: "normal",
                        labelFontWeight: "normal",
                        labelFontFamily: "Lucida Sans Unicode"

                    },
                    axisY2: {
                        interlacedColor: "rgba(1,77,101,.2)",
                        gridColor: "rgba(1,77,101,.1)"

                    },
                    data: [{
                        type: "bar",
                        name: "salesmans",
                        axisYType: "secondary",
                        color: "#014D65",
                        toolTipContent: '{infoString}',
                        dataPoints: _.orderBy(_.map(typeCodes, function(typeCode) {

                            var colors = _.map(_.uniqBy(_.filter(vm.units,  { type_code: typeCode['type_code']}), 'color_code'), function(color) {
                                color.count = _.filter(vm.units,  { type_code: typeCode['type_code'], color_code: color['color_code'] }).length
                                return color
                            })

                            var count = _.filter(vm.units, { type_code: typeCode['type_code'] }).length

                            var infoString = typeCode['type_name']  + ' (' + typeCode['type_code'] + ')' + '<br>'
                            infoString = infoString + 'TOTAL UNIT: ' + count  + '<br>'

                            _.each(colors, function(color) {
                                infoString = infoString + color.color_name  + ' (' + color.color_code + ') : ' + color.count + '<br>'
                            })

                            console.log(infoString)

                            return {
                                label: typeCode['type_name'],
                                y: count,
                                infoString: infoString
                            }
                        }), 'y')
                    }],
                })
                currentStocks.render()
            },
            otherYears: function() {

                var year = moment().format("YYYY")
                console.log(year)

                var uniques = _.filter(_.uniqBy(vm.units, function(elem) { return elem['assembly_year'] + '|' + elem['type_code'] }), function(unique) {
                    return unique.assembly_year  != year
                })

                vm.data.otherYears = _.map(uniques, function(unique) {
                    unique.count = _.filter(vm.units, {type_code: unique.type_code, assembly_year: unique.assembly_year}).length
                    return unique
                })

            },
            all: function() {
                this.currentStocks()
                this.otherYears()

            }
        }

    })