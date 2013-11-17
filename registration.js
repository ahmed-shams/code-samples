var SHORT_FORM = 0;
var LONG_FORM = 1;
var registrationFormType = -1, registrationTimer = -1;


function RegistrationFormParams(options) {
    this.smallTitle = options.smallTitle;
    this.smallSubTitle = options.smallSubtitle;
    this.smallImage = options.smallImage;
    this.largeTitle = options.largeTitle;
    this.largeSubTitle = options.largeSubtitle;
    this.largeImage = options.largeImage;
    this.college = options.college;
    this.userkey = options.userkey;
    this.source = options.source;
    this.fbFormImage = "images/logos/" + options.college + "_r.png";
    this.longFields = options.longFields;
    this.shortFields = options.shortFields;
    this.country = options.country;
}

function RegistrationField(id, title, required, type, list){
	this.id = id;
	this.title = title;
	this.required = required;
	this.type = type;
	this.subType = "";
	this.list = list==undefined?"":list;
	this.cachedValues = new Array();
	
	RegistrationField.prototype.getCachedValue = function(id){
		var i;
		for(i=0;i<this.cachedValues.length;i++){
			if(this.cachedValues[i][0] == id){
				return this.cachedValues[i][1];
			}
		}
		return null;
	}
	
	RegistrationField.prototype.setCachedValue = function(id, value){
		var i;
		for(i=0;i<this.cachedValues.length;i++){
			if(this.cachedValues[i][0] == id){
				this.cachedValues[i][1] = value;
				return;
			}
		}
		this.cachedValues.push(new Array(id, value));
	}
}

function updateRegistrationCounter(userkey, type, college, source, facebook) {
    ajaxRequest({
        url: "/recordRegistration.php",
        params: "userkey="+userkey+"&collegeid="+college+"&type="+type+"&source="+source+'&facebook='+facebook
    });
}

function skipShortRegistration(college, source, facebook) {
    ajaxRequest({
        url: "/functions.php",
        params: "method=skipShortRegistrationForm&college="+college+"&source="+source+'&facebook='+facebook
    });
}

function skipLongRegistration(college, source, firstTime, facebook) {
    ajaxRequest({
        url: "/functions.php",
        params: "method=skipLongRegistrationForm&college="+college+"&source="+source + "&fullDismissal=" + (firstTime?"0":"1")+'&facebook='+facebook
    });
}


function getRegField(id){
    return document.getElementById(id + "_reg").value;
}

function getRadioRegField(id){
    var field = document.getElementsByName(id + "_reg"),
        i;
    for (i = 0; i < field.length; i++){
       if (field[i].checked){
          return field[i].value;
       }
    }
    return "";
}

function highlightRegField(id, errorMsg){
    if (errorMsg === "") {
        document.getElementById(id+"_error_reg").innerHTML = "";
        document.getElementById(id+"_label_reg").className = "mediumInputLabel";
    } else {
        document.getElementById(id+"_error_reg").innerHTML = errorMsg;
        document.getElementById(id+"_label_reg").className = "errormediumInputLabel";
    }
}

function validateField(value, field){
	if(field.required){
		if(trim(value) === ""){
			highlightRegField(field.id, "Value is required");
	        return 1;
		}
	}
	if(trim(value) == ""){
		return 0;
	}
	if(field.type == "number"){
		if(!$.isNumeric(value)){
			highlightRegField(field.id, "Value must be a number");
	        return 1;
		}	
	}else if(field.type == "tel"){
		var phone = value.match(/\d/g);
		if(phone != null && phone.length<10){
			highlightRegField(field.id, "Value must have at least 10 digits");
	        return 1;
		}	
	}
	return 0;
}


function resetErrorOnField(id){
	highlightRegField(id, "");
}

function createInputField(label, id, type, required, excludeRow){
	if(excludeRow == undefined){
		excludeRow = false;
	}
	var val = "", requiredStr = "";
    if(!excludeRow){
    	val += '<tr id=' + id + '_field>';
    }
    if(required){
    	label = label + "*";
    	requiredStr = "required";
    }
    val += '<td class="mediumInputLabel" id='+id + '_label_reg nowrap>' + label + ':</td>';
    val += '<td colspan=3 class="mediumInputCell">';
    val += '<input class="mediumInput" type="' + type + '" id='+id+'_reg ' + requiredStr + '></td>';
    if(!excludeRow){
    	val += '</tr><tr><td></td><td colspan=3 id="'+id+'_error_reg" class="mediumInputError"></td></tr>';
    }
    return val;
}


function createDropdownField(label, id, values, required, excludeRow){
	if(excludeRow == undefined){
		excludeRow = false;
	}
	var val = "", i, requiredStr="", value="";
    if(!excludeRow){
    	val += '<tr id=' + id + '_field>';
    }
    if(required){
    	label = label + "*";
    	requiredStr = "required";
    }
    val += '<td class="mediumInputLabel" id='+id + '_label_reg nowrap>' + label + ':</td>';
    val += '<td colspan=3  class="mediumInputCell">';
    val += '<select class=mediumInputDropdown id="'+id+'_reg" ' + requiredStr + ' style="width: 209px">';
    val += '<option value="">Select...</option>';

    for(i = 0; i < values.length; i++){
    	value = values[i].value;
    	if(value == undefined){
    		value = values[i].label;
    	}
       	val += '<option value="' + value + '">'+values[i].label+ '</option>';
    }
    val += '</select></td>';
    if(!excludeRow){
    	val += '</tr><tr><td></td><td colspan=3 id="'+id+'_error_reg" class="mediumInputError"></td></tr>';
    }
    return val;
}

function createRadioButtonField(label, id, values, required){
	var i =0;
	if(required){
    	label = label + "*";
    }
    var val = '<tr id=' + id + '_field><td class="mediumInputLabel" id='+id + '_label_reg>' + label + ':</td>'+
       '<td colspan=3 class="mediumInputCell">';
    for(i = 0; i < values.length; i++){
    	val += '<input type="radio" value="' + values[i] + '" name="'+id+'_reg" id="'+id+'_reg">'+values[i];
    }
    val += '</td></tr><tr><td></td><td colspan=3 id="'+id+'_error_reg" class="mediumInputError"></td></tr>';
    return val;
}

function createCalendarField(label, id, required, excludeRow){
	if(excludeRow == undefined){
		excludeRow = false;
	}
	
    var calendar = new tcal ({"controlname" : id+"_reg"}, false);
    var val = "", requiredStr="";
    if(required){
    	label = label + "*";
    	requiredStr = "required";
    }
    if(!excludeRow){
    	val += '<tr id=' + id + '_field>';
    }
    val += '<td class="mediumInputLabel" id='+id + '_label_reg>' + label + ':</td>';
    val += '<td colspan=3 class="mediumInputCell">';
    val += '<input class="mediumInput" readonly ' + requiredStr + ' onclick="'+calendar.getTriggerScript() + '"';
    val += ' type="text" id="'+id+'_reg"/>' + calendar.getIcon() + '</td>';
    if(!excludeRow){
    	val +=  '</tr><tr><td></td><td colspan=3 id="'+id+'_error_reg" class="mediumInputError"></td></tr>';
    }
    return val;
      
}

function createInputFields(fields, college){	
	var i = 0;
	var str = "";
    for(i;i<fields.length;i++){
    	var field = fields[i];
    	if(field.type=="text" || field.type =="number" || field.type=="email" || field.type=="date" || field.type=="tel"){
    		str += createInputField(field.title, field.id, field.type, field.required);
    	}else if(field.type=="list"){
    		getDynamicFieldListValue({id:field.id, collegeid:college, 
    			cArgs:field, callback:dynamicFieldListCallback, async:true});
    		str += createInputField(field.title, field.id, "text", field.required);
    	}else if(field.type == "dynamic-server"){
    		getDynamicFieldListValue({id:field.id, collegeid:college,
    			cArgs:field, callback:dynamicFieldListCallback, async:true});
    		str += createInputField(field.title, field.id, "text", field.required);
    	}else if(field.type == "dynamic-client"){
    		str += createInputField(field.title, field.id, field.type, field.required);
    	}else if(field.type == "radio"){
    		str += createRadioButtonField(field.title, field.id, ["Yes", "No"], field.required);
    	}
    }
    return str;  
}

function dynamicFieldListCallback(response, field){
	if(response=="")return;
	
	var dynField = JSON.parse(response);
	field.subType = dynField.type;
	if(dynField.type == "list"){
		field.list = dynField.list;
		$("#" + field.id + "_field").html(createDropdownField(field.title, field.id, field.list, field.required, true));
	}else if(dynField.type == "date"){
		$("#" + field.id + "_field").html(createCalendarField(field.title, field.id, field.required, true));
	}else if(dynField.type == "text" || dynField.type == "number" || dynField.type == "email"){
		$("#" + field.id + "_field").html(createInputField(field.title, field.id, dynField.type, field.required, true));
	}
	registrationFieldRecreated(field);
}

function registrationFieldRecreated(field){
	if(field.id == "country" && $("#state_field").length>0){
		$("#country_reg").change(function(){
			countryFieldChanged();
		});
	}
	if(field.id == "citizenship" && $("#needsvisa_field").length>0){
		$("#citizenship_reg").change(function(){
			updateNeedsVisaField();
		});
	}
}

function postRegistrationDialogCreate(college, fields){
	if($("#state_field").length>0){
		$("#country_reg").change(function(){
			countryFieldChanged();
		});
		countryFieldChanged();
	}
	if($("#needsvisa_field").length>0){
		$("#citizenship_reg").change(function(){
			updateNeedsVisaField();
		});
		updateNeedsVisaField();
	}

	$("#registrationform input[type=date]").datepicker({
        dateFormat: 'mm/dd/yy',
        showOn: "button",
        buttonImage: "/images/calendar/cal.gif",
        buttonImageOnly: true
    }).css('margin-right', '5px').next().css('cursor', 'pointer');
	
}

function updateNeedsVisaField(){
	var country = $("#citizenship_reg").val();
	if(country != "" && country != registrationFormParams.country){
		if($("#needsvisa_field").is(":hidden")){
			$("#needsvisa_field").show();
			$("input:radio[name=needsvisa_reg]").attr("checked", false);
		}
	}else{
		$("#needsvisa_field").hide();
		$("input:radio[name=needsvisa_reg]").attr("checked", false);
	}
	
}

function countryFieldChanged(){
	var stateField = getRegistrationFieldById("state");
	var country = $("#country_reg").val();
	
	
	// Hide fields if no country is selected
	if(country != ""){
		$("#state_field, #street_field, #city_field, #postal_field").show();
	}else{
		$("#state_field, #street_field, #city_field, #postal_field").hide();
	}
	
	// State field changes
	var value = stateField.getCachedValue(country);
	if(value == null){
		var dynField = getDynamicFieldListValue({id:stateField.id, collegeid:"", 
			optionalParams:"country=" + escape(country),
			async: true,
			cArgs: stateField,
			callback: function (response, field){
				dynField = JSON.parse(response);
				if(dynField.type == "list"){
					field.list = dynField.list;
					field.setCachedValue(country, dynField.list);
					$("#state_field").html(createDropdownField(field.title, field.id, field.list, field.required, true));
				}else if(dynField.type == "text"){
					field.list = "";
					field.setCachedValue(country, "");
					if($("#state_reg").is("select")){
						$("#state_field").html(createInputField(field.title, field.id, "text", field.required, true));
					}
				}
			}});
	}else{
		if(value != ""){ // A list
			stateField.list = value;
			$("#state_field").html(createDropdownField(stateField.title, stateField.id, stateField.list, stateField.required, true));
		}else{ // Text
			stateField.list = "";
			if($("#state_reg").is("select")){
				$("#state_field").html(createInputField(stateField.title, stateField.id, "text", stateField.required, true));
			}
		}
	}
}

function getRegistrationFieldById(id){
	var i=0;
	for(i;i<registrationFormParams.shortFields.length;i++){
    	var field = registrationFormParams.shortFields[i];
    	if(field.id == id){
    		return field;
    	}
    }
	for(i=0;i<registrationFormParams.longFields.length;i++){
    	var field = registrationFormParams.longFields[i];
    	if(field.id == id){
    		return field;
    	}
    }
}

function getDynamicFieldListValue(options){
	var id = options.id;
	var params = options.optionalParams==undefined?"":options.optionalParams;
	var collegeid = options.collegeid;
	var async = options.async==undefined?false:true;
	
	value = ajaxRequest({
	      url: "/functions.php",
	      params: "method=getRegistrationFieldList&collegeid="+collegeid+"&fieldid="+id+"&"+params,
	      async: async,
	      cArgs: options.cArgs,
	      callback: options.callback
	});

	if(!async) return JSON.parse(value);
}

function validateRegistrationFields(fields){
	var i, errors = 0;;
	for(i=0;i<fields.length;i++){
		var field = fields[i];
		var value = "";
		if(field.type == "radio"){
			value = getRadioRegField(field.id);
		}else{
			value = getRegField(field.id);
		}
		// Reset Errors colors and message on the field
		highlightRegField(field.id, "");
		if($("#" + field.id + "_field").is(":visible")){
			errors += validateField(value, field);
		}
	}

    if (errors === 0 && $("#email_reg").length > 0 &&  $("#confirmemail_reg").length > 0){
    	if($("#email_reg").val() !== $("#confirmemail_reg").val()){
    		highlightRegField("confirmemail", "Emails don't match");
    		errors++;
    	}
    }

    return errors == 0;
}

function buildRegistrationFieldsParams(fields){
	var i, str="", value;
	for(i=0;i<fields.length;i++){
		var field = fields[i];
		if(field.type == "radio"){
			value = getRadioRegField(field.id);
		}else{
			value = getRegField(field.id);
		}
		value = escape(value).replace("+", "%2B");
		str += "&" + field.id + "=" + value;
	}
	return str;
}

/**
 * Regular YouVisit Registration object
 */
var Registration = {
    
    wrapContentWithImages : function(content) {
        var html = '';
        html += '<div id="modal_dialog1_top"></div>';
        html += '<div id="modal_dialog1_shell">' + content + '</div>';
        html += '<div id="modal_dialog1_bottom"></div>';
        return html;
    },
    
    /**
     * Show the default short registration form
     */
    displayShortForm : function(userkey, college, source) {
    	var i, years = new Array();
    	for(i=2011;i<2028;i++)years.push({label:i});

        var content =
            '<img style="float:right;margin-top:45px;" src="' + registrationFormParams.largeImage + '" alt="prize"/>' +
            '<div id=registrationform>' +
                '<h2>' + registrationFormParams.smallTitle + '</h2>'+
                '<h5>' + registrationFormParams.smallSubTitle + '</h5>' +
                '<table>' +
                	createInputFields(registrationFormParams.shortFields, college)+
                    '<tr>' +
                        '<td></td>' +
                        '<td style="padding: 20px 0;text-align:right;">' +
                            '<button type="submit" class="clean_button" onclick="Registration.submitShortForm(\''+userkey+'\',\''+college+'\',\''+source+'\')">Continue</button>' +
                        '</td>' +
                    '</tr>' +
                '</table>' +
            '</div>';
        content = this.wrapContentWithImages(content);
        Dialog.create({
            style_prefix: 'modal_dialog1',
            content: content,
            onclose : function() {
                skipShortRegistration(college, source, 0);
            },
            maskBackground: 'none',
            width: 759
        });
        postRegistrationDialogCreate(college, registrationFormParams.shortFields);

        //////////////////////////////////////
        // Log long form launch in database
        // updateRegistrationCounter(registrationFormParams.userkey, 0, college, source, 0);
        /////////////////////////////////////
        
    },

    /**
     * Show the default long registration form
     */
    displayLongForm : function(userkey, college, firstTime, source) {
        var content =
            '<img style="float:right;margin-top:100px;" src="' + registrationFormParams.largeImage + '" />' +
            '<div>'+
                '<h2>' + registrationFormParams.largeTitle + '</h2>' +
                '<h5>' + registrationFormParams.largeSubTitle + '</h5>'+
                '<form id=registrationform><table>' + 
                	createInputFields(registrationFormParams.longFields, college)+
                    '<tr>' +
                        '<td colspan="3"></td>' +
                        '<td style="padding: 20px 0;text-align:right;">' +
                            '<button type="button" class="clean_button" onclick="Registration.submitLongForm(\''+userkey+'\',\''+college+'\',\''+source+'\')">Submit</button>' +
                        '</td>' +
                    '</tr>' +
                '</table></form>' +
            '</div>';
        content = this.wrapContentWithImages(content);
        Dialog.create({
            style_prefix: 'modal_dialog1',
            content: content,
            onclose : function() {
                skipLongRegistration(college, source, firstTime, 0);
            },
            maskBackground: 'none',
            top: '70',
            top_relative: 'window',
            width: 759
        });
        postRegistrationDialogCreate(college, registrationFormParams.longFields);

        //////////////////////////////////////
        // Log long form launch in database
        // updateRegistrationCounter(registrationFormParams.userkey, 1, college, source, 0);
        /////////////////////////////////////
    },

    /**
     * Tell the user we received their info and they'll get an email shortly
     */
    displayConfirmation : function() {
        var msg = 'Thank you for submitting your information. You will receive an email confirmation shortly.';
        var body =
            '<div>'+
                '<h2>' + msg + '</h2>'+
            '</div>';
        body = this.wrapContentWithImages(body);

        Dialog.create({
            style_prefix: 'modal_dialog1',
            content: body,
            modal: false,
            maskBackground: 'none',
            top: this.centered?"auto":50,
            width: 759
        });

        Cookie.remove('registration_confirmation');
    },
    
    /**
     * Validates the submission of the short form and makes an ajax request to the server with the good data
     * ajax callback is shortFormCallback
     */
    submitShortForm : function(userkey, college, source) {
    	if(validateRegistrationFields(registrationFormParams.shortFields)){
	        var params = "method=validateShortRegistration&userkey="+userkey+ "&college=" + college + "&source=" + source;
	        params += buildRegistrationFieldsParams(registrationFormParams.shortFields);
	
	        // Use async ajax call and callback
	        ajaxRequest({
	            url : getDomain() + "/functions.php",
	            params : params,
	            callback : Registration.shortFormCallback,
	            cArgs : [userkey, college, true, source]
	        });
    	}
    },
    
    submitLongForm : function(userkey, college, source) {
    	if(validateRegistrationFields(registrationFormParams.longFields)){
	        var params = "method=validateLongRegistration&userkey="+userkey+"&source="+source+"&college=" + college;
	        params += buildRegistrationFieldsParams(registrationFormParams.longFields);
	
	        // Use async ajax call and callback
	        ajaxRequest({
	            url : getDomain() + "/functions.php",
	            params : params,
	            callback : Registration.longFormCallback
	        });
    	}
    },
    
    shortFormCallback : function(response, extras) {
        if (response === "success") {
            Dialog.close();
            registrationFormType = LONG_FORM;
            displayLongRegistrationForm(extras[0], extras[1], extras[2], extras[3]);
        } else if (response === "Invalid email address.") {
            highlightRegField("email", "Email not valid");
        }else{
            alert(response);
        }
    },

    longFormCallback : function(response) {
        if (response === "success") {
            Dialog.close();
            hideRegistrationButton();
            Registration.displayConfirmation();
        } else if (response === "Invalid email address.") {
            highlightRegField("email", "Email not valid");
        } else {
            alert(response);
        }
    }, 
    
    /**
     * Indicates whether the dialog will be centered vertically
     */
    centered : true
};

function hideRegistrationButton(){
	var obj = document.getElementById("sidebar_register");
	if(obj){
		obj.style.display = "none";
	}
}

function displayShortRegistrationForm(userkey, college, source, centered) {
	if(!Dialog.isOpen){
    	    Registration.centered = centered;
            Registration.displayShortForm(userkey, college, source);
	}
}

function displayLongRegistrationForm(userkey, college, firstTime, source) {
	if(!Dialog.isOpen){
		Registration.displayLongForm(userkey, college, firstTime, source);
	}
}

function displayRegistrationForm(userkey, college, source, centered){
	if(registrationFormType == SHORT_FORM){
		displayShortRegistrationForm(userkey, college, source, centered);
	}
	if(registrationFormType == LONG_FORM){
		displayLongRegistrationForm(userkey, college, false, source);
	}
}

function displayRegistrationConfirmation() {
    Registration.displayConfirmation();
}