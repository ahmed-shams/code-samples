
define(

    [
        'bacon',
        'lodash',
        'common/model/utils'
    ],

    function(Bacon, _, Utils) {

        /**
         * @inject AddFirmService, AddService, EditService, RemoveService, FirmStream
         */
        return function AddFirmModel(AddFirmService, AddService, EditService, RemoveService, FirmStream) {

            return AddFirmService
                .map(function(data){

                    return _.sortBy(data, function(item){

                        return Utils.toTitleCase(item.name);
                    });
                })
                .flatMapLatest(function(data) {

                    return Bacon.update(data,

                        [AddService], function(collection, itemToAdd) {

                            FirmStream.push({});

                            return [itemToAdd].concat(collection);
                        },

                        [RemoveService], function(collection, itemToRemove) {

                            FirmStream.push({});

                            return _.filter(collection, function(item) {

                                return item.uid !== itemToRemove.uid;
                            });
                        },

                        [EditService], function(collection, itemToUpdate) {

                            FirmStream.push({});

                            return _.map(collection, function(item) {

                                return item.uid === itemToUpdate.uid ? itemToUpdate : item;

                            });
                        }
                    );
                })
                .toProperty([]);
        };
    }
);
