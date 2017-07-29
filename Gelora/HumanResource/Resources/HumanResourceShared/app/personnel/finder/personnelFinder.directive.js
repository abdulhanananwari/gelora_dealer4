geloraHumanResourceShared
    .directive('personnelFinder', function(
        PersonnelModel, TeamModel,
        $state, $timeout) {

        return {
            templateUrl: '/gelora/human-resource-shared/app/personnel/finder/personnelFinder.html',
            scope: {
                selectedPersonnel: '=',
                onPersonnelSelected: '&'
            },
            link: function(scope, element, attrs) {

                _.mixin({
                    'deepPick': function(object, keys) {

                        var obj = {}

                        _.each(keys, function(key) {
                            _.set(obj, key, _.get(object, key))
                        })

                        return obj
                    }
                })

                scope.modalId = Math.random().toString(36).substring(2, 7)

                scope.filter = {
                    paginate: 10,
                    with: 'team'
                }

                scope.search = function(filter) {

                    PersonnelModel.index(filter)
                        .then(function(res) {
                            scope.personnels = res.data.data
                            scope.meta = res.data.meta
                        })

                }

                scope.select = function(personnel) {

                    if (personnel.team) { personnel.team = personnel.team.data }

                    scope.selectedPersonnel = _.deepPick(personnel, ['id',
                        'entity.id', 'entity.name', 'entity_id',
                        'user.id', 'user.name', 'user_id',
                        'team_id', 'team.name', 'team.id', 'team.leader.name', 'team.leader.id',
                        'name', 'email', 'phone_number',
                        'registration_code', 'position', 'position_text'
                    ])

                    $timeout(function() {
                        scope.onPersonnelSelected();
                    }, 250);

                    $('#personnel-finder-modal-' + scope.modalId).modal('hide');
                }

                scope.load = {
                    teams: function() {

                        TeamModel.index()
                            .then(function(res) {
                                scope.teams = res.data.data
                            })
                    },
                    
                }

            }
        }
    })