geloraSalesShared
    .directive('salesOrderFilterPreset', function(
        $timeout,
        JwtValidator,
        SettingModel) {

        return {
            restrict: "AE",
            templateUrl: '/gelora/sales-shared/app/salesOrder/directives/filterPreset/salesOrderFilterPreset.html',
            scope: {
                filter: '=',
                onSet: '&'
            },
            link: function(scope, element, attrs) {

                scope.loadPresets = function() {

                    SettingModel.index({ object_type: 'SettingPreset', object_id: JwtValidator.decodedJwt.sub, single: true })
                        .then(function(res) {
                            scope.presets = res.data.data.data_1
                        }, function(res) {
                            scope.presets = []
                        })
                }
                scope.loadPresets()

                scope.set = function(preset) {
                    scope.filter = preset.filter

                    $timeout(function() {
                        scope.onSet()
                    }, 500)
                }

                scope.edit = function(preset) {
                    scope.focusedPreset = preset
                }

                scope.savePreset = function(name, filter) {
                    
                    _.remove(scope.presets, { name: name })
                    
                    scope.presets.push({
                        name: name,
                        filter: filter,
                    })

                    SettingModel.store({ object_type: 'SettingPreset', object_id: JwtValidator.decodedJwt.sub, single: true, data_1: scope.presets })
                        .then(function(res) {
                            alert('Berhasil menyimpan setting filter')
                            scope.presets = res.data.data.data_1
                        }, function(res) {
                            scope.presets = []
                        })
                }
            }
        }
    })