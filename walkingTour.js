FULL_PANEL = true;
var _flexiblePanelCssClass = "";

var descMinimizeExplicitlyClicked = false;
$(document).ready(function(){
    $('#mappanel .resize_bottom').click(resizeBottom);
    $('#mappanel .resize_top').click(resizeTop);
    $('#descriptionPanel .minimize').click(function(e){
    	minimizeDescription(true);
    });
    $('#descriptionPanel .maximize').click(function(e){
    	maximizeDescription(true);
    });
    $('#help_navigating').click(function(e) {
        e.preventDefault();
        launchInstructionsVideo();
    });

    $('#fullscreen').click(function(e) {
        e.preventDefault();
        //toggleFullscreen();
        launchFullScreen();
    });

    if(!collegeParams.fullPanelCompatible){
    	$('#fullscreen').hide();
    }

    $('#languages').click(function(e) {
		e.preventDefault();
		toggleLanguages(e);
    });
    
    $('#tours').click(function(e) {
    	//e.preventDefault();
        toggleTours(e);
    });
    
    $('#other_languages span').click(function(e) {
        var lang = $.trim($(this).text()),
            language = {value : lang},
            oldLang = $.trim($('#selectedLanguage').text());
            
        updateLanguage(language);
        
        $('#selectedLanguage').text(lang);
        $(this).text(oldLang);
        toggleLanguages(e);
    });
    
    $("#connectionsNavPanel").hover(
    		function(e){
    			$(".connectionsBox").fadeIn(200);
    		},
    		function(e){
    			$(".connectionsBox").fadeOut(200);
    		}
    );
    
    if(fullscreen){
    	$('#fullscreen').hide();
    	initFullscreen();
    }else{
    	initFullPanelMode();
    }
    updateToolbarPanels();
    calculateVirtualTourImageDimensions();
});

function calculateVirtualTourImageDimensions(){
	if(!collegeParams.fullPanelCompatible){
		virtualTourImagePrefix = "";
		return;
	}
	var height = $('#tour_content').outerHeight()-38;
	if(height < 450){
		virtualTourImagePrefix = "";
	}else if(height < 530){
		virtualTourImagePrefix = "fb_";
	}else if(height < 700){
		virtualTourImagePrefix = "m_";
	}else{
		virtualTourImagePrefix = "l_";
	}
}

function resizeBottom() {
    if ($('#mappanel').hasClass('large')) {
        $('#mappanel .resize_bottom img').attr('src', '/images/angle_quote_down.png');
    } else {
        $('#mappanel .resize_bottom img').attr('src', '/images/angle_quote_up.png');
        ;
        $('#mappanel .resize_top img').attr('src', '/images/angle_quote_up.png');
    }
    $('#mappanel').toggleClass('large medium');
}

function resizeTop() {
    if ($('#mappanel').hasClass('small')) {
        $('#mappanel .resize_top img').attr('src', '/images/angle_quote_up.png');
    } else {
        $('#mappanel .resize_top img').attr('src', '/images/angle_quote_down.png');
        $('#mappanel .resize_bottom img').attr('src', '/images/angle_quote_down.png');
    }
    $('#mappanel').toggleClass('small medium');
}

var descExplicitlyMinimized = false;
function minimizeDescription(explicitlyClicked) {
	if(explicitlyClicked){
		descExplicitlyMinimized = true;
	}
	if (!$('#descriptionPanel').hasClass('minimized')) {
		$('#descriptionPanel').addClass('minimized');
		$('#descriptionPanel .minimize, #descriptionText, #keywordsText, #descriptionTitle, #descriptionPanel .maximize').toggleClass('hidden');
	}
}

function maximizeDescription(explicitlyClicked) {
	if ($('#descriptionPanel').hasClass('minimized') && (!descExplicitlyMinimized || explicitlyClicked)) {
		$('#descriptionPanel').removeClass('minimized');
		$('#descriptionPanel .minimize, #descriptionText, #keywordsText, #descriptionTitle, #descriptionPanel .maximize').toggleClass('hidden');
		descExplicitlyMinimized = false;
		fleXenv.updateScrollBars();
	}
}

function dummy() {
    Dialog.create({
        content : '<h3 class="text-center green">Dummy</h3>',
        modal : false,
        width: 350
    });
}

var _FULLSCREEN = false,
    tourPhotoWidth,
    $tour = null;
function toggleFullscreen() {
	prepareWalkingTourPanel();
	
	if(isIE()){
		pendingPlayers.players="";
		clearVideoGuideLayer("wthvideo");
	}
	
    if (_FULLSCREEN) {    	
        $tour = $('#tour_container').detach();
        $('div.web').append($tour);

        $('#tour_container, #tour, #wt_toolbar, body, #prevWayPoint, #nextWayPoint, #fullscreen').removeClass('fullscreen');

        initFullPanelMode();
    }
    else {    
        tourPhotoWidth = $('#tour_content').outerWidth();
        $tour = $('#tour_container').detach();
        $('body').append($tour);

        $('#tour_container, #tour, #wt_toolbar, body, #prevWayPoint, #nextWayPoint, #fullscreen').addClass('fullscreen');

        initFullscreen();
    }
    if(isIE()){
    	drawVideoGuideLayer("wthvideo", "objvideo");
	}
    updateToolbarPanels();
    calculateVirtualTourImageDimensions();
    updateVirtualPanel();
}

function updateToolbarPanels(){
	if($("#tour_container").width()<750){
		$('#help_navigating').html("&nbsp;");
    	$('#fullscreen').html("&nbsp;");
    	
    	// remove the Tours text if the languages dropdown is visible
    	if($('#languages').length>0){
    		$('#selected_tour').html("&nbsp;");
    	}
    	$('#waypoints_panel').addClass("compact");
	}else if($("#tour_container").width()<940){
    	$('#help_navigating').text('Help');
   		$('#fullscreen').text(_FULLSCREEN?'Exit':'Fullscreen');
    	$('#waypoints_panel').addClass("compact");
    }else if($("#tour_container").width()<1090){
    	$('#help_navigating').text('Help');
    	$('#fullscreen').text(_FULLSCREEN?'Exit Fullscreen':'Fullscreen');
    	$('#waypoints_panel').addClass("compact");
    }else{    
    	$('#help_navigating').text('How to Navigate');
    	$('#fullscreen').text(_FULLSCREEN?'Exit Fullscreen':'Fullscreen');
    	$('#waypoints_panel').removeClass("compact");
    }
}

function initFullPanelMode(){
	if(window.getFlexibleHeightPanelStyle){
		_flexiblePanelCssClass = getFlexibleHeightPanelStyle();
		$('body').addClass(_flexiblePanelCssClass);		
	}
	
	// Restore arrow size
	if(_regularArrowSize>-1){
		arrowSize = _regularArrowSize;
	}
	
	$('#tour_photo img').removeAttr('style');
	
	if(tourPhotoWidth > 0){
	    $('#tour_content').css({
	        'width' : tourPhotoWidth + 'px',
	        'height' : '610px'
	    });
	}
    
    $('#fullscreen').attr('title', 'View tour in fullscreen mode!').text('Fullscreen');
    $('#help_navigating').text('Help');
    
    _FULLSCREEN = false;
    
    var height = $('#wthvideocontainer').outerHeight();
    $('#wthvideocontainer').css({
 	   'width' : Math.floor(height/384*256) + "px" 
    });
    
    if(!isFF() && !isIE()){
        $('#objvideo').css({
       	   'height' : height + "px" 
          });
    }
}

var _regularArrowSize = -1;
function initFullscreen(){
	if(_flexiblePanelCssClass!=""){
		$('body').removeClass(_flexiblePanelCssClass);		
	}
	
	// Enlarge navigation arrow
	_regularArrowSize = arrowSize;
	arrowSize = 2;
	
    // the -38 is for the toolbar
    $('#tour_photo img').css({
        'max-width': $(window).width() + 'px',
        'max-height': ($(window).height() - 38) + 'px',
        'height' : ($(window).height() - 38) + 'px'
    });
    
    $('#fullscreen').attr('title', 'Exit fullscreen mode');

    $('#tour_content').css({
        'width' : $('#tour_photo img').outerWidth() + 'px',
        'height' : ($(window).height() - 38) + 'px'
    });
    
    var height = $('#wthvideocontainer').outerHeight();
    $('#wthvideocontainer').css({
 	   'width' : Math.floor(height/384*256) + "px" 
    });
    if(!isFF() && !isIE()){
        $('#objvideo').css({
      	   'height' : height + "px" 
        });
    }
    
    _FULLSCREEN = true;
}

function updateMinimizeListener(comp, func){
	if($(comp).hasClass('minimized')){
		removeEvent(document, "click", func, true);
	}else{
		addEvent(document, "click", func, true);
	}
}

function toggleLanguages(e) {
    $('#other_languages').toggleClass('minimized');
    updateMinimizeListener('#other_languages', toggleLanguages);
}

function toggleTours(e) {
    $('#other_tours').toggleClass('minimized');
    updateMinimizeListener('#other_tours', toggleTours);
}

function switchTours(span) {
    var $tours = $('#tours'),
        $span = $(span),
        newTourName = $.trim($span.text()),
        oldTourName = $.trim($('#selected_tour').text()),
        newIndex = $span.attr('data-index'),
        oldIndex = $tours.attr('data-index'),
        newTrailId = $span.attr('data-tour-id'),
        oldTrailId = $tours.attr('data-tour-id');

    $tours.attr({'data-index' : newIndex, 'data-tour-id' : newTrailId});
    $span.attr({'data-index' : oldIndex, 'data-tour-id' : oldTrailId});
    
    $('#selected_tour').text(newTourName);
    $span.text(oldTourName);
    toggleTours();
}

function launchFullScreen(){
	var url = $("#fullscreen").attr("href");
	var params = getSpecialUrlParams();
	var i = 0;
	for(i;i<params.length;i++){
		url += "&" + params[i].join("=");
	}
	
	try{
		if (videoGuideEnabled) {
        	thisMovie('objvideo').stopWTH();
    	}else{
    		avatarEmbed().stopSpeech();
    	}
    } catch(err) {}    
	
	var win = window.open(url, "WalkingTour", "toolbar=no,scrollbars=no,menubar=no,status=no,directories=no,location=no,width=" + screen.width + ",height=" + screen.height);
	win.focus();
	
}

function doesPanelExist(key){
	return $(key).length>0;
}

var resizeTimer = 0;
$(window).resize(function() {
	if(_FULLSCREEN){
		prepareWalkingTourPanel();
		if(resizeTimer){
			clearTimeout(resizeTimer);
		}
		resizeTimer = setTimeout("resizeOperation()", 500);
	}
});

function resizeOperation(){
	initFullscreen();
	updateToolbarPanels();
    calculateVirtualTourImageDimensions();
    updateVirtualPanel();
}