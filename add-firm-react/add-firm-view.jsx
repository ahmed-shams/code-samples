
define(

    [
        'common-ui',
        'react',
        'lodash',
        '../common/model/firm-vo',
        '../common/constants/firms',
        '../common/view/field',
        '../common/view/form-group'
    ],

    function(CUI, React, _, FirmVO, Firms, Field, FormGroup) {

        /**
         * @inject AddStream, ProcessingStream, ReactivateStream, FirmModel, ErrorStream, EditStream, AddFirmModel, Copy
         */
        return function AddFirmItem(AddStream, ProcessingStream, ReactivateStream, FirmModel, ErrorStream, EditStream, AddFirmModel, Copy) {

            var getSyncFirms = function() {

                return _(FirmModel.getList())
                    .filter(function(firm) {

                        return firm.isSyncDealer;
                    })
                    .map(function(syncDealer) {

                        return (
                            <option value={syncDealer.id}>{syncDealer.name}</option>
                        );
                    })
                    .value();
            };

            return React.createClass({

                mixins: [CUI.mixin.BaconMixin, CUI.mixin.CommonMixin],

                getDefaultProps: function() {
                    return {
                        firmData: {}
                    };
                },

                getInitialState: function() {

                    var clientType = this.props.firmData.clientType || '';

                    return {

                        isEditMode: _.size(this.props.firmData.clientId) > 0,
                        clientName: this.props.firmData.clientName || '',
                        clientId: this.props.firmData.clientId || '',
                        clientType: this.props.firmData.clientType || Firms.BUY_SIDE,
                        status: this.props.firmData.status || Firms.INACTIVE,
                        excludedDealers: this.props.firmData.excludedDealers || [],
                        syncDealer: this.props.firmData.syncDealer || false,
                        errorMessage: '',
                        showReactivate: false,
                        deletedFirm: null,
                        activeClientType: this.props.firmData.clientType ? _.find(Firms.CLIENT_TYPE_OPTIONS, function(option) {
                                                                                                                    return option.value === clientType;
                                                                                                                })
                                                                          : _.first(Firms.CLIENT_TYPE_OPTIONS)
                    };
                },

                componentDidMount: function() {
                    this.subscribe(

                        ErrorStream.onValue(function(data) {
                            this.setState({errorMessage: data.msg});
                            ProcessingStream.push(false);
                            if(data.errors.hasOwnProperty('item_in_deleted_state_error')) {
                                var firm = _.first(data.data);
                                firm.status = 'ACTIVE';
                                delete firm.bloombergDealer;
                                this.setState({errorMessage: Copy.get('setup_reactivation_message')});
                                this.setState({
                                    showReactivate: true,
                                    isEditMode: true,
                                    deletedFirm: firm,
                                    clientId: firm.clientId
                                });
                            }

                        }.bind(this)),

                        AddFirmModel.skip(1).onValue(this.props.onClose)
                    );

                    this.refs.firmName.focus();
                },

                _hideReactivate: function(){
                    this.setState({showReactivate: false, errorMessage: '', isEditMode: false});
                },

                _onReactivate: function() {

                    var data = this._getSaveData();
                    data.status = 'ACTIVE';
                    EditStream.push({
                        payload: [data],
                        vo: new FirmVO(data),
                        squashError: true,
                        id: FirmModel.getCurrent().id
                    });

                    ProcessingStream.push(true);
                },

                _onSave: function() {
                    if (this._validateFields(['firmName', 'sapId'])) {

                        var data = this._getSaveData();

                        (this.state.isEditMode ? EditStream : AddStream).push({

                            payload: [data],
                            vo: new FirmVO(data),
                            squashError: true,
                            id: FirmModel.getCurrent().id
                        });

                        ProcessingStream.push(true);
                    }
                },

                _getSaveData: function() {
                    return {
                        clientId: this.state.clientId,
                        clientName: this.state.clientName,
                        syncDealer: this.state.syncDealer,
                        excludedDealers: this.state.excludedDealers,
                        clientType: this.state.clientType,
                        status: this.state.status
                    }
                },

                _updateState: function(name, e) {
                    var change = {};
                    change[name] = e.value;
                    this.setState(change);
                },

                _onClientTypeChange: function(e) {

                    this.setState({
                        clientType: e.item.value,
                        activeClientType: e.item
                    });
                },

                _onStatusChange: function(value) {

                    this.setState({status: value ? Firms.ACTIVE : Firms.INACTIVE});
                },

                _onExcludedChange: function(e) {

                    this.setState({
                        excludedDealers: _.map(e.target.options, function(option) {
                            return option.selected ? option.value : null;
                        }).filter(_.identity)
                    });
                },

                _onSyncDealerChange: function(value) {

                    this.setState({syncDealer: value});
                },

                _onLoopFocus: function(e) {

                    this.refs.firmName.focus();
                },

                render: function() {

                    return (
                        <CUI.Modal
                            className="add-panel"
                            title={Copy.get(this.state.isEditMode ? 'edit_title' : this.state.showReactivate ? 'reactivate_title' : 'add_title')}
                            render={true}
                            closable={true}
                            onClose={this.props.onClose}
                        >
                            <FormGroup className="modal-wrapper" onLoopFocus={this._onLoopFocus}>

                                {_.size(this.state.errorMessage) > 0 && (

                                    <div className="error">
                                        <span className="msg">{this.state.errorMessage}</span>
                                    </div>
                                )}

                                {
                                    (this.state.showReactivate) ?
                                        <div className="_reactivate-firm">
                                            <ul className="panel-footer">
                                                <li>
                                                    <CUI.Button ref="saveBtn" onClick={this._onReactivate} className="save-firm">{Copy.get('reactivate_button')}</CUI.Button>
                                                </li>
                                                <li>
                                                    <CUI.Button ref="cancelBtn" onClick={this._hideReactivate}>{Copy.get('cancel_button')}</CUI.Button>
                                                </li>
                                            </ul>
                                        </div>
                                        :
                                        <div>
                                            <Field
                                                ref="firmName"
                                                className="firm-name-field"
                                                type="text"
                                                label={Copy.get('firm_name_label')}
                                                value={this.state.clientName}
                                                validator={CUI.utils.InputValidators.makeTextValidator(Copy.get('firm_name_error'))}
                                                isRequired={true}
                                                maxLength="64"

                                                onChange={_.partial(this._updateState, 'clientName')}
                                                onComplete={this._onSave}
                                            />

                                            <Field
                                                ref="sapId"
                                                className="sap-id-field"
                                                type="text"
                                                label={Copy.get('sap_id')}
                                                value={this.state.clientId}
                                                validator={CUI.utils.InputValidators.makeTextValidator(Copy.get('sap_id_error'))}
                                                isRequired={true}
                                                disabled={this.state.isEditMode && this.state.deletedFirm === null}
                                                maxLength="64"
                                                restrict={function(value) {
                                                    return value.replace(/[a-z]/g, function(match) {
                                                        return String.prototype.toUpperCase.apply(match);
                                                    });
                                                }}

                                                onChange={_.partial(this._updateState, 'clientId')}
                                                onComplete={this._onSave}
                                            />

                                            <CUI.DropDownList
                                                ref="clientType"
                                                label={Copy.get('client_type_label')}
                                                options={Firms.CLIENT_TYPE_OPTIONS}
                                                disabled={this.state.isEditMode && this.state.deletedFirm === null}
                                                showSelected={true}
                                                selectedItem={this.state.activeClientType}
                                                onSelect={this._onClientTypeChange}

                                            />

                                            <div className="switch-group">
                                                <span>{Copy.get('status_label')}</span>
                                                <CUI.Switch
                                                    ref="status"
                                                    className="app-dealer-toggle"
                                                    leftLabel={Copy.get('no_button')}
                                                    rightLabel={Copy.get('yes_button')}
                                                    checked={this.state.status === Firms.ACTIVE}

                                                    onClick={this._onStatusChange}
                                                />
                                            </div>

                                            {this.state.clientType === Firms.BUY_SIDE ?

                                                <div className="excluded-dealer-list">
                                                    <p>{Copy.get('excluded_dealers_list')}</p>

                                                    <select ref="excluded"
                                                            multiple={true}
                                                            defaultValue={this.state.excludedDealers}
                                                            onChange={this._onExcludedChange}>
                                                        {getSyncFirms()}
                                                    </select>
                                                    <p className="how-to-text">{Copy.get('excluded_dealers_list_usr_msg')}</p>
                                                </div> :

                                                <div className="switch-group">
                                                    <span>{Copy.get('sync_dealer')}</span>
                                                    <CUI.Switch
                                                        ref="syncDealer"
                                                        className="app-dealer-toggle"
                                                        leftLabel={Copy.get('no_button')}
                                                        rightLabel={Copy.get('yes_button')}
                                                        checked={this.state.syncDealer}
                                                        onClick={this._onSyncDealerChange}
                                                    />
                                                </div>
                                            }
                                            <ul className="panel-footer">
                                                <li>
                                                    <CUI.Button ref="saveBtn" onClick={this._onSave} className="save-firm">{Copy.get('save_button')}</CUI.Button>
                                                </li>
                                                <li>
                                                    <CUI.Button ref="cancelBtn" onClick={this.props.onClose}>{Copy.get('cancel_button')}</CUI.Button>
                                                </li>
                                            </ul>
                                        </div>
                                }

                            </FormGroup>

                        </CUI.Modal>
                    );
                }
            });
        };
    }
);