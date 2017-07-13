geloraSalesShared
    .controller('SalesOrderShowCddbController', function(
        $state,
        SalesOrderModel,
        ConfigModel) {

        var vm = this

        $(".birth-date").datepicker({
            dateFormat: "ddmmyy",
            maxDate: "-13Y",
            defaultDate: "-30y",
            changeYear: true,
            changeMonth: true,
            monthNames: ['Januari', 'Februari', 'Maret', 'April', 'May', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'],
            monthNamesShort: ['Jan', 'Feb', 'Mar', 'April', 'May', 'Juni', 'Juli', 'Agust', 'Sept', 'Okt', 'Nov', 'Des']
        });

        $('.sales-date').datepicker({
            dateFormat: "ddmmyy",
        })

        SalesOrderModel.get($state.params.id)
            .then(function(res) {
                
                vm.salesOrder = res.data.data

                if (!vm.salesOrder.cddb.propinsi_surat) {
                    vm.salesOrder.cddb.propinsi_surat = 3200
                }
            })

        vm.store = function(salesOrder) {

            SalesOrderModel.cddb.update(salesOrder.id, salesOrder.cddb)
                .then(function(res) {
                    vm.salesOrder = res.data.data
                    alert('CDDB berhasil di update')
                })
        }

        vm.copyFromSalesOrder = function() {

            vm.salesOrder.cddb.no_ktp = vm.salesOrder.registration.ktp;
            vm.salesOrder.cddb.entity_id = vm.salesOrder.registration.id;
            vm.salesOrder.cddb.alamat_surat = vm.salesOrder.registration.address;
            vm.salesOrder.cddb.no_hp = vm.salesOrder.customer.phone_number;

            var kelurahan = _.invert(vm.areaOptions.kelurahan_surat.options)[vm.salesOrder.registration.kelurahan]
            if (kelurahan) {
                vm.salesOrder.cddb.kelurahan_surat = kelurahan; vm.salesOrder.cddb.kelurahan_surat_name = vm.areaOptions.kelurahan_surat.options[vm.salesOrder.cddb.kelurahan_surat]
                vm.salesOrder.cddb.kecamatan_surat = vm.salesOrder.cddb.kelurahan_surat.substring(0,6); vm.salesOrder.cddb.kecamatan_surat_name = vm.areaOptions.kecamatan_surat.options[vm.salesOrder.cddb.kecamatan_surat]
                vm.salesOrder.cddb.kota_surat = vm.salesOrder.cddb.kecamatan_surat.substring(0,4); vm.salesOrder.cddb.kota_surat_name = vm.areaOptions.kota.options[vm.salesOrder.cddb.kota_surat]
                vm.filterKodePos(vm.salesOrder.cddb.kelurahan_surat_name)
            }
        }

        vm.filterKecamatanSurat = function(kota) {

            vm.areaOptions.kecamatan_surat.options_filtered = {}

            _.each(vm.areaOptions.kecamatan_surat.options, function(value, key) {
                if (key.substring(0, 4) == kota) {
                    vm.areaOptions.kecamatan_surat.options_filtered[key] = value
                }
            })
        }

        vm.filterKelurahanSurat = function(kecamatan) {

            vm.areaOptions.kelurahan_surat.options_filtered = {}

            _.each(vm.areaOptions.kelurahan_surat.options, function(value, key) {
                if (key.substring(0, 6) == kecamatan) {
                    vm.areaOptions.kelurahan_surat.options_filtered[key] = value
                }
            })
        }

        vm.filterKodePos = function(kelurahan) {
            vm.salesOrder.cddb.kode_pos_surat = vm.areaOptions.kode_pos.options[kelurahan]
        }

        function loadConfig() {

            ConfigModel.get('gelora.cdb.area')
                .then(function(res) {
                    vm.areaOptions = res.data.data
                })

            ConfigModel.get('gelora.cdb.cdb')
                .then(function(res) {

                    vm.cddbOptions = res.data.data.cddbOptions

                    vm.cddbOptions.hobi.options_formatted = []
                    _.each(vm.cddbOptions.hobi.options, function(val1, key1) {
                        _.each(val1, function(val2, key2) {
                            vm.cddbOptions.hobi.options_formatted.push({ name: val2, code: key2, group: key1 })
                        })
                    })
                })
        }
        loadConfig()

    })
    .filter('valueHas', function() {

        return function(items, query) {

            if (query) {
                items = _.pickBy(items, function(value, key) {
                    return value.toLowerCase().indexOf(query.toLowerCase()) >= 0
                })
            }

            return items
        };
    });
