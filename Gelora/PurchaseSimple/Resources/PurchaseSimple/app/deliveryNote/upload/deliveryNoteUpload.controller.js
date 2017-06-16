geloraPurchaseSimple
    .controller('DeliveryNoteUploadController', function (
            $scope, ModelModel, UnitModel,DeliveryNoteFactory,
            CsvUploader) {

        var vm = this

        vm.units = []

        vm.loadSuratJalan = function () {

            var file = document.getElementById('surat_jalan_file').files[0]

            if (_.last(file.name.split('.')) != 'sj') {
                alert('Gagal. File yg diupload harus berextension .sj')
                return  
            }
            
            CsvUploader.parse(file, {
                header: false
            })
            .then(function (results) {

                vm.units = _.map(results.data, function (result) {

                    return {
                        sj_number: result[0],
                        sj_date: result[1],
                        so_number: result[2],
                        nd_date: result[3],
                        nd_number: result[4],
                        truk: result[5],
                        engine_number: result[6],
                        chasis_number: 'MH1' + result[7],
                        assembly_year: result[8],
                        type_code: result[9],
                        color_code: result[10],
                        subcode: result[11],
                        current_status: 'UNRECEIVED'
                    }

                })

                generateAvailableTypes()
                .then(function() {

                    _.each(vm.units, function(unit) {
                       DeliveryNoteFactory.validateLoadSuratJalan(unit)
                    })
                })
            })
        }

        vm.upload = function (units) {

            CsvUploader.upload(units, {
                upload: UnitModel.store
            })
        }

        vm.removeUnit = function (unit) {
            _.remove(vm.units, unit)
        }

        function generateAvailableTypes() {

            vm.loading = true
            var modelCodes = _.join(_.map(_.uniqBy(vm.units, 'type_code'), 'type_code'), ',')

           return ModelModel.index({codes: modelCodes})
            .success(function (data) {

                vm.availableTypes = data.data

                vm.units = _.map(vm.units, function (object) {


                    var model = _.find(data.data, {code: object.type_code})

                    if (!_.isUndefined(model)) {

                        object.brand = _.get(model, 'brand')
                        object.type_name = _.get(model, 'name')
                        object.current = _.get(model, 'current')

                        var color = _.find(model.variants, {code: object.color_code})

                        object.color_name = _.get(color, 'name')
                    }

                    return object
                })

                vm.loading = false
            })
        }
    })