geloraHumanResourceShared
        .directive('personnelFinder', function (
                PersonnelModel, TeamModel,
                $state, $timeout) {

            return {
                templateUrl: '/gelora/human-resource-shared/app/personnel/finder/personnelFinder.html',
                scope: {
                    selectedPersonnel: '=',
                    onPersonnelSelected: '&'
                },
                link: function (scope, element, attrs) {

                    scope.modalId = Math.random().toString(36).substring(2, 7)

                    scope.search = function (filter) {

                        PersonnelModel.index(filter)
                                .then(function (res) {
                                    scope.personnels = res.data.data
                                    scope.meta = res.data.meta
                                })

                    }

                    scope.select = function (personnel) {

                        scope.selectedPersonnel = personnel;
                        $timeout(function () {
                            scope.onPersonnelSelected();
                        }, 250);

                        $('#personnel-finder-modal-' + scope.modalId).modal('hide');
                    }

                    TeamModel.index()
                            .then(function (res) {
                                scope.teams = res.data.data
                            })

                }
            }
        })