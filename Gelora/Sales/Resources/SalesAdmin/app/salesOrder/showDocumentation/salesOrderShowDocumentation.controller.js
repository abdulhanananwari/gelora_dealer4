geloraSalesAdmin
    .controller('SalesOrderShowDocumentationController', function(
        $http, $state,
        LinkFactory, JwtValidator,
        SalesOrderModel) {

        var vm = this

        function load() {

            SalesOrderModel.get($state.params.id)
                .then(function(res) {
                    vm.salesOrder = res.data.data
                })

            $http.get('/file-manager/file/', {
                    params: {
                        fileable_type: 'SalesOrder',
                        fileable_id: $state.params.id,
                        name: 'SPK',
                        sort: 'desc'
                    }
                })
                .then(function(res) {
                    vm.documentations = res.data.data
                })

        }
        load()

        vm.generateAndDownload = function(salesOrder) {

            SalesOrderModel.document.spk.generate($state.params.id)
                .then(function(res) {
                    window.open(res.data.url)
                })

        }
        vm.sendEmail = function(salesOrder) {
        	
            SalesOrderModel.document.spk.email($state.params.id)
                .then(function(res) {
                    vm.salesOrder = res.data.data
                })
        }
    })
