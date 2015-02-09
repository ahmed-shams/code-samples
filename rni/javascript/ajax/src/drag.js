/**
 * Drag Module
 * © 2002-2006 Garrett Smith
 * @version 2.0
 */


/** DragObj
 *
 *  @param el         type: HTMLElement the element to drag
 *  @param constraint type: int 
 *  @see DragObj.constraints
 */

DragObj = function(el, constraint)
{
	this.id = el.id;
	this.el = this.origEl = el;
	this.isRel = getStyle(el, "position").toLowerCase() == "relative";
	this.container = (this.isRel ? el.parentNode : getContainingBlock(el));
	this.dropTargets = [];
	this.handle = this.el;
	this.constraint = constraint||0;
	
	this.el.style.zIndex = getStyle(el, "z-index") || DragObj.highestZIndex++;
	if(ua.ie||ua.safari)
		setIeTopLeft(el);
	Listener.add(el, "onfocus", DragObj.focused, this)
	Listener.add(el, "onblur", DragObj.blurred, this)
};
DragObj.instances = [];
DragObj.getInstance = function(el, constraint) 
{
	if(!el.id)
		el.id = "DragObj" + DragObj.instances.length;

	var instance = DragObj.instances[el.id];
	if(instance == null)
		instance = DragObj.instances[el.id] 
			= DragObj.instances[DragObj.instances.length] = new DragObj(el, constraint);
	return instance;
};
DragObj.focused = function(e) {	DragObj.getInstance(this).focusEventReceived(e); };
DragObj.blurred = function(e) {	DragObj.getInstance(this).blurEventReceived(e); };
DragObj.constraints = 
{
	NONE : 0,
	HORZ : 1,
	LEFT : 3,
	RIGHT: 5,
	VERT : 2,
	UP   : 4,
	DOWN : 6
};
DragObj.prototype = 
{
	x : 0,
	y : 0,
	_origX : 0,
	_origY : 0,
	
	grabX : 0,
	grabY : 0,
	
	/** Where it will move to next. onbeforedrag */
	newX : 0, 
	newY : 0,

	/**
	 * returns position of where element is initially dragged from.
	 */
	origX : function() { return this._origX; },
	origY : function() { return this._origY; },
		
	isDragEnabled : true,
	
	hasFocus : false,
	
	dragCopy : false,
	
	dragMultiple : false,
	
	onfocus : function(){},
	onblur : function() {},
	
	setFocus : function(isFocus) 
	{
		this.hasFocus = isFocus;
		if(isFocus) 
		{
			this.onfocus();
			if(!this.dragMultiple)
				DragHandlers.focusedElement = this;
		}
		else
			this.onblur();
	},
	focusEventReceived : function(e) 
	{
		DragHandlers.removeGroupFocus();
		this.setFocus(true);
	},
	blurEventReceived : function(e) 
	{
		this.setFocus(false);
	},
	dropTargets : [],
	isOnDropTarget : false,
	onbeforedragstart : function(e){ return true; },
	ondragstart : function(e){},
	/** Being dragged */
	ondrag : function(e){},
	/** Will be dragged */
	onbeforedrag : function(e){ return true; },
	/** Dragging stopped before it escaped its container. */
	ondragstop : function(e){},
	/** Dragging completed (as a result of mouseup). */
	ondragend : function(e){},
	/** Hit a droptarget. */
	ondragdrop : function(e){ },
	keepInContainer : false,
	onbeforeexitcontainer : function() { return !this.keepInContainer; },
	setOrigX : function(origX) 
	{
		this._origX = origX;
	},
	setOrigY : function(origY) 
	{
		this._origY = origY;
	},
	getPosLeft : function() 
	{
		return this.el.style.pixelLeft || parseInt(getStyle(this.el, "left"))||0;
	},
	getPosTop : function() 
	{
		return this.el.style.pixelTop || parseInt(getStyle(this.el, "top"))||0;
	},
	constraint : DragObj.constraints.NONE,
	enableDrag : function() 
	{
		this.isDragEnabled = true;
	},
	disableDrag : function() 
	{
		this.isDragEnabled = false;		
	},
	isBeingDragged : false,
	handle : null,
	hasHandleSet : false,
	isDragStopped : false,
	useHandleTree : true,
	setHandle : function(el, setHandleTree)
	{
		this.handle = el;
		this.hasHandleSet = true;
		// Make sure user didn't forget the secondParam and expect true.
		this.useHandleTree = setHandleTree != false;
	},
	isInHandle : function(target) 
	{
 		return !this.hasHandleSet || target == this.handle || (this.useHandleTree && contains( this.handle, target ));
 	},
	getContainerWidth : function() 
	{
		return this.container.clientWidth || parseInt(getStyle(this.container, "width"));
	},
	getContainerHeight : function() 
	{
		return this.container.clientHeight || parseInt(getStyle(this.container, "height"));
	},
	/** @param dropTarget (DropTarget or HTMLElement) HTMLElement only for bkwd compat.
	 * use of HTMLElement as param type is deprecated.
	 */
	addDropTarget : function(dropTarget) 
	{
		var el = document.getElementById(dropTarget.id);
		if(this.el == el) return;
		return this.dropTargets[this.dropTargets.length] = DropTarget.getInstance(el);
	},
	grab : function(e, xOffset, yOffset) 
	{
		if(!e) e = window.event;
		var target = getTarget(e);
		if(e.preventDefault) e.preventDefault();
		e.returnValue = false;
		if(contains(this.el, target)) return;
 		this.grabX = this.getPosLeft();
 		this.grabY = this.getPosTop();
		var offsetY = eventPageY(e) - getOffsetTop(getContainingBlock(this.el));
		var newY = offsetY - (this.el.offsetHeight)/2;
		var moved = false;
		if(this.constraint != DragObj.constraints.VERT) 
		{
			// Center the dragObject around the coords, but keep it inside.

			var offsetX = eventPageX(e) - getOffsetLeft(getContainingBlock(this.el));
			var newX = offsetX - (this.el.offsetWidth)/2;
			newX = Math.max(newX, 0);
			newX = Math.min(newX, this.getContainerWidth() - this.el.offsetWidth);
			this.moveToX(newX- getOffsetLeft(this.handle, this.el) + (xOffset||0));
			moved = true;
		}
		if(this.constraint != DragObj.constraints.HORZ) 
		{
			newY = Math.max(newY, 0);
			newY = Math.min(newY, this.getContainerHeight() - this.el.offsetHeight);
			this.moveToY(newY - getOffsetTop(this.handle, this.el) + (yOffset||0));
			moved = true;
		}
		if(moved)
			this.ondrag(e);
		DragHandlers.dragObjGrabbed(e, this);	
		DragHandlers.dO = this;
	},
	release : function(e) 
	{
		DragHandlers.dragObjReleased(e, this);
	},
	checkDragClones : function() 
	{
		if(this.dragCopy) 
		{
			if(!this.origEl)
				this.origEl = this.el;
			if(!this.copyEl) 
			{
				this.copyEl = this.el.cloneNode(true);
			}
			else 
			{
				this.copyEl.style.display = "";
			}
			this.el.parentNode.insertBefore(this.copyEl, this.el);
			this.copyEl.style.zIndex = this.origEl.style.zIndex + 1;
			this.el = this.copyEl;
		}
		for(var id in DragObj.draggableList) 
		{
			var item = DragObj.draggableList[id];
			if(item.dragCopy) 
			{
				if(!item.origEl)
					item.origEl = item.el;
				if(!item.copyEl) 
				{
					item.copyEl = item.el.cloneNode(true);
				}
				else
					item.copyEl.style.display = "";
				item.el.parentNode.insertBefore(item.copyEl, item.el);	
				item.copyEl.style.zIndex = item.origEl.style.zIndex + 1;
				item.el = item.copyEl;
			}
		}
	},
	moveToX : function(x) 
	{
		this.el.style.left = (this.x = x) + "px";
	},
	moveToY : function(y) 
	{
		this.el.style.top = (this.y = y) + "px";
	},
	carryGroup : function(distX, distY) 
	{
		for(var id in DragObj.draggableList) 
		{
			var o = DragObj.draggableList[id];
			if(distX != null)
				o.moveToX( o.origX() + distX );
			if(distY != null)
				o.moveToY( o.origY() + distY );
		}
	},
	glideStart : function(x, y) 
	{
		if(this.animTimer) return;
		this.startX = x;
		this.startY = y;
		this.GlideDist = Math.ceil(Math.sqrt(Math.pow(this.startX - this.grabX, 2) 
			+ Math.pow(this.startY - this.grabY, 2)));
		
		this.rx = Math.abs(this.startX-this.grabX)/this.GlideDist;
		this.ry = Math.abs(this.startY-this.grabY)/this.GlideDist;
		if(this.x > this.grabX)
			this.rx = -this.rx;
		if(this.y > this.grabY)
			this.ry = -this.ry;
		
		this.startTime = new Date().getTime();
		
		this.animTimer = window.setInterval("DragObj.instances['"+this.id+"'].glide()", 10);
	},
	glide : function() 
	{
		var t = new Date().getTime() - this.startTime;
		// 2px per 10ms slight acceleration 10px/s
		var d = Math.ceil(2 * t + .5 * .01 * t*t);

		if(d >= this.GlideDist) 
		{
			this.animTimer = clearInterval(this.animTimer);
			this.moveToX( this.grabX );
			this.moveToY( this.grabY );
			if(this.copyEl) {
				this.el = this.origEl;
				this.copyEl.style.display = "none";
			}
		}
		else 
		{
 			this.moveToX(this.startX + d * this.rx);
 			this.moveToY(this.startY + d * this.ry);
		}
	},
	animateBack : function(x, y) 
	{
 		this.glideStart(x||this.x, y||this.y);
	},	
	setContainer : function(el) 
	{
		this.container = el;
	},
	removeDropTarget : function(el){
		var newTargets = new Array(this.dropTargets.length-1);
		var removed = null;
		
		for(var i = 0, len = this.dropTargets.length; i < len; i++)
			if(this.dropTargets[i].el == el)
				removed = el;
			else newTargets[i] = this.dropTargets[i];
		return removed;
	},
			
	toString : function() 
	{
		return this.id;
	}
};

DragObj.highestZIndex = 1000;
DragObj.draggableList = { };

/** DropTarget
 *
 * properties:
 *  el  -  the HtmlElement
 * 
 * methods: 
 * getX()
 * getY()
 * getWidth()
 * getHeight()
 */
DropTarget = function(el){
	this.el = el;
	this.id = el.id;
};

DropTarget.instances = { };

DropTarget.getInstance = function(el) {
	return DropTarget.instances[el.id] || (DropTarget.instances[el.id] = new DropTarget(el));
};

DropTarget.prototype = {
	
	hasDropTargetOver : false,
	
	getX : function(){ return getOffsetLeft(this.el) - 
		(ua.isNotUsingPaddingEdge ? parseInt(getStyle(this.el, "padding-left"))||0 : 0);
	},
	getY : function(){ return getOffsetTop(this.el) - 
		(ua.isNotUsingPaddingEdge ? parseInt(getStyle(this.el, "padding-top"))||0 : 0);
	},
	getWidth : function(){ return this.el.offsetWidth; },
	getHeight : function(){ return this.el.offsetHeight; },

	/** Dragged over a droptarget **/
	ondragover : function(e){ }, 
	ondragout : function(e){ },

	ondrop : function(e){ }
};
DropTarget.prototype.ondragover.isSet = true;

DropTarget.instances = {};

DropTarget.getInstance = function(el) {
	var instance = DropTarget.instances[el.id];
	if(instance == null)
		instance = DropTarget.instances[el.id] = new DropTarget(el);
	return instance;
};

/** DragHandlers
 *
 * properties:
 *   
 * 
 * methods: 
 * mouseDown - initializes dragging
 *
 * mouseMove - tracks the mouse position and updates dO
 *
 * mouseUp   - releases any dO and calls ondragend,
 *             passing the event. The event has a dropTarget 
 *             property, which may be null.
 * 
 */

DragHandlers = {
	
	dO : null,

	instances : [],
	
	inited : false,
	
	init : function(){

		if(this.inited)
			return;

		Listener.add(document.getElementById("stats"), "onmousedown", this.mouseDown);
		Listener.add(document.getElementById("stats"), "onkeypress", this.keyPressed);
		Listener.add(document.getElementById("stats"), "onmousemove", this.mouseMove);
		Listener.add(document.getElementById("stats"), "onmouseup", this.mouseUp);
		
 // prevent text selection while dragging.
		document.onselectstart = document.ondragstart = function() { return DragHandlers.dO == null; };
		
		this.inited = true;
	},

	dragObjGrabbed : function(e, dO) {
	
		DragHandlers.locked = true;
		
		dO.setFocus(true);
		dO.el.style.zIndex = ++DragObj.highestZIndex;

		DragHandlers.mousedownX = (e.pageX ? e.pageX : e.clientX + getScrollLeft());
		DragHandlers.mousedownY = (e.pageY ? e.pageY : e.clientY + getScrollTop());
		
		dO.setOrigX(dO.grabX = dO.getPosLeft());
  		dO.setOrigY(dO.grabY = dO.getPosTop());
				
		// subtract in-flow offsets.
		var inFlowOffsetX = dO.el.offsetLeft - dO.getPosLeft() 
			+ getOffsetLeft(getContainingBlock(dO.el), dO.container); 

		var inFlowOffsetY = dO.el.offsetTop - dO.getPosTop()
			+ getOffsetTop(getContainingBlock(dO.el), dO.container); 
		
		// Impl Note: Don't use margins for absolutely positioned elements for Safari.
		// Safari calculates offsetTop from parentNode border edge (not padding edge).

  		// Safari can't read style values from styleSheets.
  		// Safari also adds parentNode border-width to offsetLeft. 
  		// This poor approach can only work if the parentNode has no border.
		if(ua.safari && !dO.isRel) {
			if(!getStyle(dO.el, "left")) {
				dO.setOrigX(dO.grabX = dO.el.offsetLeft);
				inFlowOffsetX = 0;
			}

			if(!getStyle(dO.el, "top")) {
				dO.setOrigY(dO.grabY = dO.el.offsetTop);
				inFlowOffsetY = 0;
			}
		}
		
		if(ua.macIE || ua.safari) {
			// Safari should need this patch, but this patch fails because safari can't read styles.
			inFlowOffsetX -= parseInt(getStyle(dO.el, "border-left-width"))||0;
			inFlowOffsetY -= parseInt(getStyle(dO.el, "border-top-width"))||0;
		}
		
		if(ua.isNotUsingPaddingEdge)  { // Mac IE and Opera.
			inFlowOffsetX -= parseInt(getStyle(dO.el, "padding-left")) || 0;
			inFlowOffsetY -= parseInt(getStyle(dO.el, "padding-top")) || 0;
		}
		
		dO.minX = 0 - inFlowOffsetX;
		dO.maxX = dO.getContainerWidth() - dO.el.offsetWidth - inFlowOffsetX;
		dO.minY = 0 - inFlowOffsetY;
		dO.maxY = dO.getContainerHeight() - dO.el.offsetHeight - inFlowOffsetY;
		
 		dO.isBeingDragged = false;
	},
	
	mouseDown : function(e) {

		if(!e) 
			e = window.event;
			
		var target = getTarget(e);			

		var dO = null;
		
		for(var testNode = target;dO == null && testNode != null;
									testNode = findAncestorWithAttribute(testNode, "id", "*")) {
			if(testNode != null) {
				dO = DragObj.instances[testNode.id];
			}
		}

	 	if(dO) {
			var handle = dO.handle;
 		
			if( dO.hasHandleSet && !dO.isInHandle( target ) ) {
				if(!DragHandlers.locked) {
					DragHandlers.removeGroupFocus();
					DragHandlers.dO = null;
					DragHandlers.locked = false;
		 		}
				return false;
			}
	 		
	 		else if("preventDefault" in e)
 				e.preventDefault();
 			else e.returnValue = false;
 		}
 		else {
			DragHandlers.removeGroupFocus();
			if(!DragHandlers.locked) {
				DragHandlers.dO = null;
		 		DragHandlers.locked = false;
		 	}
			return;
		}

		var metaKey = e.metaKey || (ua.win && e.ctrlKey);
 
		if(metaKey && dO.hasFocus) {
			dO.setFocus(false);
			delete DragObj.draggableList[dO.id];
			if(DragHandlers.focusedElement == dO) {
				DragHandlers.focusedElement = null;
			}
			return;
		}
	
	// Determine focusedElement or otherwise setFocus( false ) to group.
		if(DragHandlers.focusedElement) {
 			// make sure we're not in the tree (above or below).
			var isInTree = contains(dO.el, DragHandlers.focusedElement.el) || contains(DragHandlers.focusedElement.el, dO.el);
 			
			if(metaKey && !isInTree) {
				if(dO.dragMultiple 
					&& DragHandlers.focusedElement == null 
					|| DragHandlers.focusedElement.dragMultiple
					&& DragHandlers.focusedElement.container == dO.container) {
					DragObj.draggableList[DragHandlers.focusedElement.id] = DragHandlers.focusedElement;
				}
				else 
					DragHandlers.removeGroupFocus();
			}
			else if(dO.id in DragObj.draggableList) {
				delete DragObj.draggableList[dO.id];
				if(DragHandlers.focusedElement && DragHandlers.focusedElement != dO
					&& DragHandlers.focusedElement.container == dO.container) {
					DragObj.draggableList[DragHandlers.focusedElement.id] = DragHandlers.focusedElement;
					DragHandlers.focusedElement = dO;
				}
			}
			else if(DragHandlers.focusedElement != dO)
				DragHandlers.removeGroupFocus();
		}
		
 		DragHandlers.focusedElement = dO;

 		if(false == dO.onbeforedragstart(e)) return true;

		DragHandlers.dragObjGrabbed(e, dO);
		for(var id in DragObj.draggableList) {
			DragHandlers.dragObjGrabbed(e, DragObj.draggableList[id]);
		}
		DragHandlers.dO = dO;
	},

	dragObjReleased : function(e, dO) {
		var group = DragObj.draggableList;
		dO.animateBack();
		for(var id in DragObj.draggableList) {
			var item = DragObj.draggableList[id];
			item.animateBack();
		}
		DragHandlers.dO = null;
	},
	
	removeGroupFocus : function() {
		if(DragHandlers.focusedElement) {
			DragHandlers.focusedElement.setFocus(false);
		}
		for(var id in DragObj.draggableList) {
			DragObj.draggableList[id].setFocus(false);
		}
		DragObj.draggableList = { };
	},

	mouseMove : function(e) {

		var dO = DragHandlers.dO;
		
		if(e == null)
			e = event;
		
		if(dO == null || dO.el.style == null || !dO.isDragEnabled)
			return;
 
		var distX = eventPageX(e) - DragHandlers.mousedownX;
		var distY = eventPageY(e) - DragHandlers.mousedownY;
				
 		dO.newX = dO.origX() + distX;
		dO.newY = dO.origY() + distY;
		
		// drag the bitch.
		
		if(dO.isBeingDragged == false) {
			dO.checkDragClones();
			dO.ondragstart(e);
			for(var id in DragObj.draggableList) 
				DragObj.draggableList[id].ondragstart(e);
		}
		dO.isBeingDragged = true;
		dO.hasBeenDragged = (dO.hasBeenDragged || Boolean(distX || distY));
		
		
		// Drag constraints. 
		//if(dO.container != null)
		//	dO.keepInContainer();
		
		var constraints = DragObj.constraints;
				
		var isLeft = dO.newX < dO.minX;
		var isRight = dO.newX > dO.maxX;
		var isAbove = dO.newY < dO.minY;
		var isBelow = dO.newY > dO.maxY;
 		
		if(dO.onbeforedrag(e) == false) return;
		
		var isOutsideContainer = dO.container != null;
		
		if(dO.constraint == DragObj.constraints.NONE) { // no constraint. Life is hard.
			
			isOutsideContainer &= ( isLeft || isRight || isAbove || isBelow );
			
			var planesStopped = 0;
			if(isOutsideContainer && dO.onbeforeexitcontainer() == false) {
				if(isLeft) {
					if(!dO.isAtLeft) {
						dO.moveToX( dO.minX );
						// dO.minX - dO.origX() = max possible negative distance to travel.
						dO.carryGroup(dO.minX - dO.origX(), null);
						dO.ondrag(e);
						dO.isAtRight = false;
						dO.isAtLeft = true;
						planesStopped += 1;
					}
				}
				else if(isRight) {
					if(!dO.isAtRight) {
						dO.moveToX( dO.maxX );
						// dO.maxX - dO.origX() = max possible positive distance to travel.
						dO.carryGroup(dO.maxX - dO.origX(), null);
						dO.ondrag(e);
						dO.isAtRight = true;
						dO.isAtLeft = false;
						planesStopped += 1;
					}
				}
				else {
					dO.isAtLeft = dO.isAtRight = false;
					dO.moveToX( dO.newX );
					dO.carryGroup(distX, null);
				}
				if(isAbove) {
					if(!dO.isAtTop) {
						var sy = dO.y;
						dO.moveToY( dO.minY );
						// dO.minY - dO.origY() = max possible positive distance to travel.
						dO.carryGroup(null, dO.minY - dO.origY());
						dO.ondrag(e);
						dO.isAtTop = true;
						dO.isAtBottom = false;
						planesStopped += 1;
					}
				}
				else if(isBelow) {
					if(!dO.isAtBottom) {
						var sy = dO.y;
						dO.moveToY( dO.maxY );
						// dO.maxY - dO.origY() = max possible positive distance to travel.
						dO.carryGroup(null, dO.maxY - dO.origY());
						dO.ondrag(e);
						dO.isAtTop = false;
						dO.isAtBottom = true;
						planesStopped += 1;
					}
				}
				else {
					dO.isAtTop = dO.isAtBottom = false;
					dO.moveToY( dO.newY );
					dO.carryGroup(null, distY);
				}
				
				dO.isDragStopped = planesStopped == 2;
				
				if(dO.isDragStopped)
					dO.ondragstop(e);
				else
					dO.ondrag(e);
			}
			else {			// In container.
				dO.isDragStopped = dO.isAtLeft = dO.isAtRight =
					dO.isAtTop = dO.isAtBottom = false;
				dO.moveToX( dO.newX );
				dO.moveToY( dO.newY );
				dO.carryGroup(distX, distY);
				dO.ondrag(e);
			}
		}
		
		else {  // A constraint. 
		
			// A VERT type constraint? 
			if(dO.constraint % 2 == 0) {
			  			  	
				isOutsideContainer &= (isAbove || isBelow);
				if(isOutsideContainer && dO.onbeforeexitcontainer() == false) {
					if(isAbove) {
						if(!dO.isAtTop) {
							dO.moveToY( dO.minY );
							// dO.minY - dO.origY() = max possible positive distance to travel.
							dO.carryGroup(null, dO.minY - dO.origY());
							dO.ondrag(e);
							dO.isAtTop = !(dO.isAtBottom = false);
						}
					}
					else if(isBelow) {
						if(!dO.isAtBottom) {
							dO.moveToY( dO.maxY );
							// dO.maxY - dO.origY() = max possible positive distance to travel.
							dO.carryGroup(null, dO.maxY - dO.origY());
							dO.ondrag(e);
							dO.isAtBottom = !(dO.isAtTop = false);
						}
					}

					if(!dO.isDragStopped) {
						dO.ondragstop(e);
						dO.isDragStopped = true;
					}
				}
				else { // in container.
					dO.isAtTop = dO.isAtBottom = false;
					dO.isDragStopped = false;
					dO.moveToY( dO.newY );
					dO.carryGroup(null, distY);
					dO.ondrag(e);
				}
			}
			
			// A HORZ type constraint? 
			else {
			  
				isOutsideContainer &= (isLeft || isRight);
				
				if(isOutsideContainer && dO.onbeforeexitcontainer() == false) {
	
					if(isLeft) {  
						if(!dO.isAtLeft) {
							dO.moveToX( dO.minX );
							// dO.minX - dO.origX() = max possible negative distance to travel.
							dO.carryGroup(dO.minX - dO.origX(), null);
							dO.isAtLeft = !(dO.isAtRight = false);
						}
					}
					else if(isRight) {
						if(!dO.isAtRight) {
							// dO.maxX - dO.origX() = max possible negative distance to travel.
							dO.carryGroup(dO.maxX - dO.origX(), null);
							dO.moveToX( dO.maxX );
							dO.isAtRight = !(dO.isAtLeft = false);
						}
					}
					
					
					if(!dO.isDragStopped) {
						dO.ondragstop(e);
						dO.isDragStopped = true;
					}
 				}
				else {			// In container.
					dO.isAtLeft = dO.isAtRight = false;
					dO.isDragStopped = false;
					dO.moveToX( dO.newX );
					dO.carryGroup(distX, null);
					dO.ondrag(e);
				}
				
			}
		}
		
		// Handle dropTarget dragOver
		var dropTargets = dO.dropTargets;
		if(dropTargets.length > 0 && dO.isOnDragOverSet != false)  {
			var coords = { x:eventPageX(e), y:eventPageY(e) };
			
			for(var i = 0, j = dropTargets.length; i < j; i++) {
				var dt = dropTargets[i];
				if(!dt.ondragover.isSet) continue;
				var isInTarget = isInside(coords, dt);
				// Did we just move over this dropTarget?
				if(!dt.hasDropTargetOver && isInTarget) {
					dt.hasDropTargetOver = true;
					dt.ondragover(e, dO);
				}
				else { // Were we previously over this dropTarget?
					if(dO.isOnDropTarget && !isInTarget) { 
						dt.ondragout(e, dO);
						dt.hasDropTargetOver = false;
					}
				}
			}
		}
		return false;
	},
	
	mouseUp : function(e) {

		if(DragHandlers.dO == null)
			return true;

		if(e == null)
			e = window.event;
		
		var dO = DragHandlers.dO;
		var group = DragObj.draggableList;
		if(dO.dragCopy && dO.copyEl) {
			dO.el = dO.origEl;
			dO.moveToX(dO.x);
			dO.moveToY(dO.y);
			dO.copyEl.style.display = "none";
		}
		for(var id in DragObj.draggableList) {
			var item = DragObj.draggableList[id];
			if(item.copyEl) {
				item.el = item.origEl;
				item.moveToX(item.x);
				item.moveToY(item.y);
				item.copyEl.style.display = "none";
			}
		}
		if(dO.hasBeenDragged) {
			var el = dO.el;
			var targets = dO.dropTargets;
			if(targets.length > 0) {
			var coords = { x:eventPageX(e), y:eventPageY(e) };

				var dropTarget;
				for(var i = 0, len = targets.length; i < len; i++) {
					var dropTarget = targets[i];
					if(isInside(coords, dropTarget)) {
						dropTarget.ondrop(e, dO);
						for(var id in group) 
							dropTarget.ondrop(e, group[id]);
						break;
					}
				}
			}

			for(var id in group) {
				var o = group[id];
				if(o.x < o.minX)
					o.moveToX(o.minX);
				else if(o.x > o.maxX)
					o.moveToX(o.maxX);
				if(o.y < o.minY)
					o.moveToY(o.minY);
				else if(o.y > o.maxY)
					o.moveToY(o.maxY);
				o.ondragend(e);
			}
		}
		dO.ondragend(e);
		dO.hasBeenDragged = false;
		DragHandlers.dO = null;
	},
	
	keyPressed : function(e) {
		e=e||event;
if(e.keyCode == 27) { // esc key.
			if(DragHandlers.dO) {
				DragHandlers.dragObjReleased(e, DragHandlers.dO);
			}
		}
	}
	
};
function forIn(o, win) {
	var s = "" + o + " : ";
	for(var x in o) {
		s += "\n"+ x + " = " + o[x];
	}
	if(win) {
		var w = window.open();
		w.document.write("<plaintext>"+s+"</plaintext>");
		w.document.close();
	}
	else
		alert(s);
}


/** isInside checks to see if the coordinates 
 *   x and y are both inside dropTarget
 */
function isInside(curs, dropTarget){
	 // check for x, then y.
	var dt_x = dropTarget.getX(), dt_y = dropTarget.getY();
	
	return (curs.x >= dt_x && curs.x < dt_x + dropTarget.getWidth())
		&& // now check for y.
		(curs.y >= dt_y && curs.y < dt_y + dropTarget.getHeight());
}

function findAncestorWithAttribute(el, attrName, value) {

	for(var parent = el.parentNode;parent != null;){
	
		if(parent[attrName])
			if(parent[attrName] == value || value == "*")
				return parent;
			
		parent = parent.parentNode;
	}
	return null;
}

function getContainingBlock(el) {

	var root = document.documentElement;
	for(var parent = el.parentNode; parent != null && parent != root;) {
	
		if(getStyle(parent, "position") != "static")
			return parent;
		parent = parent.parentNode;
	}
	return root;
}

function getStyle(el, style) {
	if(!el.style) return;
    var value = el.style[toCamelCase(style)];
	    // IE provides "medium" as default inline-style border value for all border props.
	    // This bogus value should be ignored.
    if(!value || ua.ie && style.indexOf("border") == 0) 
		if(typeof document.defaultView == "object")
        	value = document.defaultView.
                 getComputedStyle(el, "").getPropertyValue(style);
       
        else if(el.currentStyle)
            value = el.currentStyle[toCamelCase(style)];
     return value || "";
}

// faster toCamelCase.
function toCamelCase(s) {
	for(var exp = toCamelCase.exp; exp.test(s); s = s.replace(exp, RegExp.$1.toUpperCase()));
	return s;
}
toCamelCase.exp = /-([a-z])/;

//--------------------------- Element location functions ------------------------

/** Returns true if a contains b.
 */
function contains(a, b) {
	while(a != b && (b = b.parentNode) != null);
	return a == b;
}

var ua = new function() {
	var s = navigator.userAgent, d = document, dt = d.doctype ? d.doctype.name : "";
	this.ie = /MSIE/.test(s);
	this.safari = /Safari/.test(s);
	this.win = /Win/.test(s);
	this.winIE = this.win && this.ie;
	this.macIE = /Mac/.test(s) && this.ie;
	this.moz = /Gecko/.test(s) && !this.safari;
	this.toString=function(){return s;};
	this.isNotUsingPaddingEdge = /Opera/.test(s) || (this.ie && !this.winIE);
};

function getOffsetTop(el, container) {
		if(!container) container = document;
		for(var offsetTop = 0; el && el != container; el = el.offsetParent)
			offsetTop += el.offsetTop;
		return offsetTop;
}

function getOffsetLeft(el, container) {
		if(!container) container = document;
		for(var offsetLeft = 0; el && el != container; el = el.offsetParent) 
			offsetLeft += el.offsetLeft;
		return offsetLeft;
}

//--------------------------- Viewport functions ------------------------

function getScrollTop() {
	return window.pageYOffset || document.documentElement.scrollTop || document.body.scrollTop;
}
function getScrollLeft() {
	return window.pageXOffset || document.documentElement.scrollLeft || document.body.scrollLeft;
}

//--------------------------- IE Functions ---------------------------
function setIeTopLeft(el) { 
	// For IE, set top/left values when declared values are auto
	// and right/bottom values are given.
	var cs = el.currentStyle || 
		(document.defaultView.getComputedStyle && document.defaultView.getComputedStyle(el,"")) || el.style;
	var cb = getContainingBlock(el);
	var curL = cs.left||cs.getPropertyValue("left"), 
	curR = cs.right||cs.getPropertyValue("right"), 
	curT = cs.top||cs.getPropertyValue("top"),
	curB = cs.bottom||cs.getPropertyValue("bottom");
	
	// Calculate left when right is given pixel value and left is "auto".
	if((curL == "" || curL == "auto") && curR && curR != "auto")
		el.style.left = cb.clientWidth - el.offsetWidth - parseInt(curR) + "px";

	// Calculate top when bottom is given pixel value and top is "auto".
	if((curT == "" || curT == "auto") && curB && curB != "auto")
		el.style.top = cb.clientHeight - el.offsetHeight - parseInt(curB) + "px";
}
//--------------------------- Event functions ------------------------
function getTarget(e){
	return window.event ? 
		window.event.srcElement : e.target.tagName 
			? e.target : e.target.parentNode;
}

function eventPageX(e) { return e.pageX || e.clientX + getScrollLeft(); }
function eventPageY(e) { return e.pageY || e.clientY + getScrollTop(); }

// Listener
//---------------------------------------------------------------------------------------
Listener = function(src) {
	this.src = src;
	this.callStack = [];
};
Listener.instances = {};
Listener.getInstance = function(src, sEvent, oScope) {

	var bucket = Listener.instances[sEvent] || (Listener.instances[sEvent] = []);
	
	for(var i = bucket.length-1; i >= 0; i--)
		if(bucket[i].src == src)
			return bucket[i];
	
	// not found.
	var listener = new Listener(src, sEvent, oScope);
	if(src[sEvent])
		listener.callStack[listener.callStack.length] = src[sEvent];
	src[sEvent] = Listener.fire(listener, oScope||src);
	return bucket[bucket.length] = listener;
};

Listener.fire = function(listener, src) {
	return function(e) {
		for(var i = listener.callStack.length - 1; i >= 0; i--) {
			src.__scopeFix = listener.callStack[i];
			src.__scopeFix(e);
		}
		src.__scopeFix = null;
	};
};
Listener.add = function(src, sEvent, fp, oScope) {
	var callStack = Listener.getInstance(src, sEvent, oScope).callStack;
	callStack[callStack.length] = fp;
};
Listener.cleanUp = function () {
	for(var type in Listener.instances) {
		var bucket = Listener.instances[type];
		var i = bucket.length-1;
		while(i >= 0)
			bucket[i--][type] = null;
	}
	if(window.CollectGarbage && i > 15)
		window.CollectGarbage();
};

Listener.add(window, "unload", Listener.cleanUp);
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
			//////////////////////  Page Settings of Business and Profile ///////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function save_pagesettings(pageSettings,filename,Name){  
	var Values = Name;
	var success = "";
	var failure = "";
	var url = filename;
    var pars = 'pageSettings=' + pageSettings + '&PageName=' + Name;
    var myAjax = new Ajax.Request(url, {method:'post',postBody:pars, onSuccess:success, onFailure:failure});
}
