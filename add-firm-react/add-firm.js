
define(

    [
        'bacon',
        'lodash',
        'context',

        'common/model/copy-model',

        'common/constants/endpoints',
        'common/service/list-parser',
        'common/utils/helpers',

        '../common/model/firm-vo'
    ],

    function(Bacon, _, Context, Copy, uri, ListParser, Helpers, FirmVO) {

        return {

            make: function(injector) {

                var context = new Context(injector);

                // Copy.
                // --------------------
                context.mapValue('Copy', {
                    target: new Copy(injector.get('Copy'))
                });

                // Parsers.
                // --------------------
                context.mapValue('AddFirmParser', {
                    target: new ListParser(FirmVO)
                });

                context.mapValue('AddFirmItemParser', {
                    target: function(res, req) {
                        return req.vo;
                    }
                });

                // Streams.
                // --------------------
                context.mapValue('AddFirmStream', {
                    target: new Bacon.Bus()
                });

                context.mapValue('AddStream', {
                    target: new Bacon.Bus()
                });

                context.mapValue('RemoveStream', {
                    target: new Bacon.Bus()
                });

                context.mapValue('EditStream', {
                    target: new Bacon.Bus()
                });

                context.mapValue('ReactivateStream', {
                    target: new Bacon.Bus()
                });

                // URI.
                // --------------------
                context.mapValue('AddURI', {
                    target: function() {
                        return uri.ADD_FIRM_ADD;
                    }
                });

                context.mapValue('RemoveURI', {
                    target: function() {
                        return uri.ADD_FIRM_REMOVE;
                    }
                });

                context.mapValue('EditURI', {
                    target: function(data) {
                        return uri.ADD_FIRM_EDIT.replace('{{id}}', data.id);
                    }
                });

                context.mapValue('GetFirmlistURI', {
                    target: _.partial(Helpers.makeURI, uri.ADD_FIRM)
                });

                var manifest = require('./manifest.config.di');

                return context.startUpResolved(manifest).then(function(ctx) {

                    ctx('Copy').putAll(ctx('AddFirmCopy'));

                    return {

                        view: function() {

                            return ctx('DataGridPage')({
                                requiresFirms: false,
                                viewId: 'add-firm'
                            });
                        }
                    };
                });
            }
        };
    });
