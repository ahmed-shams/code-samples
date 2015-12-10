
define(

    [
        'common-ui',
        'lodash',
        'markdown-it',
        'react'
    ],

    function(CUI, _, MarkdownIt, React) {

        /**
         * @inject ModalStream, ProcessingStream, RemoveStream, FirmModel, AddFirmView, ConfirmActionView, FooterView, NoDataView, NoFirmsView, Copy
         */
        return function Config(

            ModalStream,
            ProcessingStream,
            RemoveStream,
            FirmModel,
            AddFirmView,
            ConfirmActionView,
            FooterView,
            NoDataView,
            NoFirmsView,
            Copy) {

            function onClose() {
                ModalStream.push(null);
            }

            var ADD_BUTTON = {
                label: Copy.get('add_button'),
                css: 'add-button',
                icon: 'Plus',
                action: function() {
                    ModalStream.push(<AddFirmView onClose={onClose} />);
                }
            };

            this.noFirms = function() {

                var msg = new MarkdownIt().render(Copy.get('no_firms_msg')).replace(/\n/g, '<br />');

                return <NoFirmsView msg={msg} />;
            }

            this.noData = function() {

                var msg = new MarkdownIt().render(Copy.get('no_data_msg')).replace(/\n/g, '<br />');

                return <NoDataView action={ADD_BUTTON.action} label={ADD_BUTTON.label} msg={msg} />;
            }

            this.columns = function() {

                var remove = {
                    label: Copy.get('remove_button'),
                    css: 'action remove',
                    action: function(data) {

                        ModalStream.push(
                            <ConfirmActionView
                                title={Copy.get('remove_firm_confirmation_title')}
                                msg={Copy.get('remove_firm_confirmation_message')}
                                action={function() {
                                    ProcessingStream.push(true);
                                    RemoveStream.push({
                                        payload: [{
                                            clientId: data.id,
                                            clientType: data.type,
                                            clientName: data.name
                                        }],
                                        vo: data
                                    });
                                }}
                            />
                        );
                    }
                };

                var edit = {
                    label: Copy.get('edit_button'),
                    css: 'edit-button',
                    action: function(firm) {

                        ModalStream.push(
                            <AddFirmView
                                onClose={onClose}
                                firmData={_.cloneDeep(firm.raw)}
                                />
                        );
                    }
                };

                var list = FirmModel.getList();
                var index = FirmModel.getIndex();

                return [
                    {
                        field: 'name',
                        label: Copy.get('firm_name'),
                        sortBy: 'name',
                        filter: {
                            as: 'String'
                        },
                        resizeable: true
                    }, {
                        field: 'type',
                        label: Copy.get('client_type'),
                        sortBy: 'type',
                        canFilter: true,
                        resizeable: true
                    }, {
                        field: 'id',
                        label: Copy.get('sap_id'),
                        sortBy: 'id',
                        filter: {
                            as: 'String'
                        }
                    }, {
                        field: 'status',
                        label: Copy.get('status'),
                        sortBy: 'status',
                        canFilter: true,
                        resizeable: true
                    }, {
                        field: function(data) {

                            var actionsList = [edit];

                            if(data.id !== list[index].id) {
                                actionsList.push(remove)
                            }

                            function doAction(e) {
                                e.item.action(data);
                            }

                            return (
                                <CUI.DropDownList
                                    options={actionsList}
                                    onSelect={doAction}
                                />
                            );
                        },
                        label: Copy.get('actions'),
                        width: 200
                    }
                ];
            };

            this.footer = function() {

                return <FooterView buttons={[ADD_BUTTON]} />;
            }
        }
    }
);
