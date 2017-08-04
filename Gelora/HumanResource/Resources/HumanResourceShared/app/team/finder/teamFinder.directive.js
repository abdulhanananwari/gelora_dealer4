geloraHumanResourceShared
    .directive('teamFinder', function(
        PersonnelModel, TeamModel,
        $state, $timeout) {

        return {
            templateUrl: '/gelora/human-resource-shared/app/team/finder/teamFinder.html',
            scope: {
                selectedTeam: '=',
                onTeamSelected: '&'
            },
            link: function(scope, element, attrs) {

                scope.modalId = Math.random().toString(36).substring(2, 7)

                scope.select = function(team) {

                    scope.selectedTeam = team

                    $timeout(function() {
                        scope.onTeamSelected();
                    }, 250);

                    $('#personnel-finder-modal-' + scope.modalId).modal('hide');
                }

                scope.loadTeams = function() {

                    TeamModel.index()
                        .then(function(res) {
                            scope.teams = res.data.data
                        })
                }

            }
        }
    })