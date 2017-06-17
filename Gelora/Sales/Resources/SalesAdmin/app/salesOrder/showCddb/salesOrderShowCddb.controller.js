geloraSalesAdmin
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

        vm.store = function(salesOrder) {

            SalesOrderModel.cddb.update(salesOrder.id, salesOrder.cddb)
                .then(function(res) {
                    vm.salesOrder = res.data.data
                    alert('CDDB berhasil di update')
                })

        }

        vm.generateString = function(cddb) {

            CddbModel.action.generateString(cddb.id)
                .success(function(data) {
                    assignCddb(data)
                })
        }

        vm.copyFromSalesOrder = function() {

            vm.salesOrder.cddb.no_ktp = vm.salesOrder.registration.ktp;
            vm.salesOrder.cddb.entity_id = vm.salesOrder.customer.id;
            vm.salesOrder.cddb.alamat_surat = vm.salesOrder.customer.address;
            vm.salesOrder.cddb.no_hp = vm.salesOrder.customer.phone_number;
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

                    if (!vm.salesOrder.cddb.created_at) {
                        _.each(vm.cddbOptions, function(value, key) {
                            vm.salesOrder.cddb[key] = _.get(value, 'default')
                        })
                    }

                    vm.cddbOptions.hobi.options_formatted = []

                    _.each(vm.cddbOptions.hobi.options, function(val1, key1) {

                        _.each(val1, function(val2, key2) {
                            vm.cddbOptions.hobi.options_formatted.push({ name: val2, code: key2, group: key1 })
                        })
                    })

                    loadCdb()
                })


        }
        loadConfig()

        if ($state.params.id) {
            SalesOrderModel.get($state.params.id)
                .then(function(res) {
                    vm.salesOrder = res.data.data
                })
        }

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
