/**
 * Selector for DOM elements inspired by jQuery
 * 
 * @author Christian Hansen <christian.hansen@stud.fh-luebeck.de>, Julian Hilbers <hilbers.juian@gmail.com>
 * @version 1.0 
 * 
 * 
 * -------------------------------------------------------------------------------------------|
 * DOM helper to interact with DOM elements
 * 
 * @param {object} window		Central window object
 * @param {*} undefined			For security reason, to get a clean undefined
 */
(function(window, undefined){
	"strict mode"
	
	var matches,
		reSingleTag = /^<(\w+)\s*\/?>$/;
	
	// Call the contructor
	var dHelper = function(selector) {
		return new dHelper.dh.init( selector );
	};
	
	// Append all the nice functionalities to dHelper.fn
	dHelper.dh = dHelper.prototype = {
		len: 0,		// Found results
		
		/**
		 * Contructor
		 * 
		 * @param {string} selector		Element selectable by id or class 
		 */
		init: function(selector) {
			var elem, sType;
	    	
	    	sType = selector.charAt(0);
	    	selector = selector.substr(1,selector.length);
	    	
	    	switch( sType ) {
	    		case '#': elem = document.getElementById(selector);
	    				  this[0] = elem;
	    				  this.len = 1;
	    		break;
	    		case '.': elem = document.getElementsByClassName(selector); 
	    				  this.pushToMatches(elem);
	    				  this[0] = elem[0];
	    		break;
	    		case '<': this.pushToMatches(document.getElementsByTagName(reSingleTag.exec(selector)));
	    		break;
	    		default: return this;
	    	}
	    	
	    	return this;
	 	},
	 	/**
	     * Finds an html tag within an selected element
	     * 
	     * @param {string} selector		Tag to find
	     * @returns {dh}
	     */
	    find: function( selector ) {
	    	// TO DO due refactoring
	    	this.pushToMatches(this[0].getElementsByTagName(selector));
	    	return this;
	    },
	    /**
	     * Works only with selected classes, delivers the element at the passed position
	     * 
	     * @param {int} 	Position of the element
	     * @returns {dh}
	     */
	    eq: function( no ) {
	    	return this.matches[no];
	    },
	    /**
	     * Works only with selected classes and find, runs through every element and
	     * performs the passed event
	     * 
	     * @param {function} callback		Something that should happen with this element
	     */
	    each: function( callback ) {
	    	// TO DO due refactoring
	    	/*
	    	var c = this.workArr.length;
	    	if( c > 0 && typeof(callback) === 'function' ) {
	    		for( var i = 0; i < c; i++ ) {
	    			this.elem = this.workArr[i];
	    			callback(this);
	    		}
	    	}
	    	*/
	    },
	    /**
	     * Appends the an array of results to dHelper
	     * 
	     * @param {array} results		Array with found elements
	     */
	    pushToMatches: function( results ) {
	    	var c = results.length;
	    	this.len = c;
	    	this.matches = [];
	    	
	    	for( var i = 0; i < c; i++ ) {
	    		var nEl = {};
	    		Object.extend( nEl, this );
	    		nEl[0] = results[i];
	    		this.matches.push(nEl);
	    	}
	    },
	    /**
	     * Trims a string
	     * 
	     * @param {string} uStr		Untrimmed string
	     * @return {string}
	     */
	    trim: function( uStr ) {
	        return uStr.replace(/^\s+|\s+$/g, '');
	    },
	    /**
	     * Appends some content to the element
	     * 
	     * @param {string} input		New content
	     */
	    append: function( input ) {
	    	// TO DO
	    },
	 	/**
	     * Adds a class to an element
	     * 
	     * @param {string} className
	     * @return {dh}
	     */
	    addClass: function( className ) {
	        if (this[0].hasAttribute('class')) {	
	            this[0].setAttribute('class', this[0].getAttribute('class') + ' ' + className);
	        } else {
	            this[0].setAttribute('class', className);
	        }
	        return this;
	    },
	    /**
	     * Remove class from an element
	     * 
	     * @param {string} className
	     * @return {dh}
	     */
	    removeClass: function( className ) {
	        if (this[0].hasAttribute('class')) {
	            var classes = this.elem.getAttribute('class').split(' ');
	            var classesString = '';
	            for(i = 0; i < classes.length; i++) {
	                if(this.trim(classes[i]) !== className) {
	                    classesString += this.trim(classes[i]) + ' ';
	                }
	            }
	            this[0].setAttribute('class', this.trim(classesString));
	        }
	        return this;
	    },
	    /**
		 * Reads or sets the attribute of an element
		 * 
		 * @param {string} attr		Attribute to find
		 * @param {string} val		New Value
		 * 
		 * @returns {string}
		 */
		attr: function( attr, val ) {
			val = val || null;
			
			if( val == null ) {
				return this[0].getAttribute(attr);	
			} else {
				this[0].setAttribute(attr, val);
			}
			
			return '';
		},
		/**
	     * Read and write html
	     * 
	     * @param {string} html		new html content
	     * 
	     * @return {string} if no argument is given
	     */
	    html: function( html ) {
	    	if( html === undefined ) return this[0].innerHTML();
	    	this[0].innerHTML = html;
	    },
	    /**
	     * Adds an click event to the element
	     * 
	     * @param {function} callback
	     */
	    click: function( callback ) {
	    	if( typeof(callback) === 'function' ) {
	    		this[0].addEventListener('click', callback, false);	
	    	}
	    },
	    
	    /**
	     * Adds an mouseover event to the element
	     * 
	     * @param {function} callback
	     */
	    mouseover: function( callback ) {
	    	if( typeof(callback) === 'function' ) {
	    		this[0].addEventListener('mouseover', callback, false);	
	    	}
	    },
	    
	    /**
	     * Adds an on focus event to the element
	     * 
	     * @param {function} callback
	     */
	    focus: function( callback ) {
	    	if( typeof(callback) === 'function' ) {
	    		this[0].addEventListener('onfocus', callback, false);	
	    	}
	    },
	     /**
	     * Make an AJAX-Call
	     * 
	     * @param {object} parameter
	     * @returns {string}
	     */
	    ajax: function(parameter) {
	
	        var request = null;
	
	        // Internet Explorer
	        if (window.ActiveXObject) {
	            request = new ActiveXObject("Microsoft.XMLHTTP");
	        } else { // other browsers
	            request = new XMLHttpRequest();
	        }
	
	        var requestUri = parameter.url;
	        
	        for (i = 0; i < parameter.params.length; i++) {
	
	        }
	        request.open("GET", requestUri, true);
	        request.onreadystatechange = function() {
	
	            if (request.readyState !== 4 && parameter.loading() !== undefined) {
	                parameter.loading();
	            }
	
	            if (request.readyState === 4 && request.status === 200 && parameter.success(request.response) !== undefined) {
	                if (parameter.type === 'json') {
	                    parameter.success();
	                } else {
	                    parameter.success(request.responseText);
	                }
	            }
	
	        };
	
	        request.send(null);
	    }
	};
	
	
	// Init obtains through dHelper prototype all it's functions for instantiation  
	dHelper.dh.init.prototype = dHelper.dh;
	
	// Expose for gloabel use 
	window.$ = dHelper;
})(window);


/**
 * Initiates the validation of an form
 * 
 * @param {string} selector		Formulars name
 * @param {object} options		json Object with options
 * @returns {boolean} 
 */
function valid(selector, options){
	var vForm = document[selector];
	Validate.init(vForm, options);
	
	return Validate;
}

/**
 * Namespace to validate Formular inputs 
 */
var Validate = {
	// Default values
	defaults : { name: '', required: false, type: 'text', maxLen: 0, minLen: 0, errMsg: 'Ihre Eingabe ist nicht korrekt!' },
	fields: {},		// All field to check
	vForm: null,	// Formular to check
	
	init: function( vf, entrys ) {
		this.combineWithDefaults( entrys );
		this.vForm = vf;
	},
	/**
	 * 
 	 * @param {Object} list		List with entrys
	 */
	combineWithDefaults: function( list ) {
		this.list = [];
		
		for( var x in list ) {
			var obj = {};
			Object.extend( obj, this.defaults );
			Object.extend( obj, list[x] );
			this.list[x] = obj;
		}
	},
	/**
	 * Tests an value of its predefined parameters
	 * 
	 * @param {*} value			Value for testing
	 * @param {object} opt		Conditions for this value
	 * 
	 * @return {string} Error Message
	 */
	investigate: function( value, opt ) {
		var strLen = value.length;
		var regExp;
		var maL = ( opt.maxLen == 0 ? strLen : opt.maxLen );
		var miL = ( opt.minLen == 0 ? strLen : opt.minLen );
		
		// End if it's required but empty
		if( opt.required && strLen < 1 ) {
			return 'Fehlende Eingabe im Feld: '+opt.name+'.';
		}
		
		// End if value have wrong length
		if( strLen > maL ) return 'Ihr Eintrag im Feld '+opt.name+' ist '+( strLen-maL )+' Zeichen zu lang.';
		if( strLen < miL ) return 'Ihr Eintrag im Feld '+opt.name+' ist '+( miL-strLen )+' Zeichen zu kurz.';
		
		
		// Compare to regular expression
		var msg = '';
		switch( opt.type ) {
			case 'email': regExp = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
			break;
			case 'plz': regExp = /^([0-9]{5})$/;
			break;
			default: regExp = /^([A-Za-z0-9]*)$/;
		}
		
		if(!this.checkRegExp( value, regExp )) msg = opt.errMsg;
		return msg;
	},
	/**
	 * Checks a value depending to a regular expression
	 * 
	 * @param {*} value				Value for testing
	 * @param {string} regExp		Regular expression
	 * 
	 * @return {boolean}
	 */
	checkRegExp: function( value, regExp ) {
		return regExp.test(value);
	},
	/**
	 * Appends an informative message to an element 
	 * 
	 * @param {string} pName	Name of this field to identify the error message
	 * @param {object} elem		Element within the error will be displayed
	 * @param {string} msg		Error message
	 */
	addErrorMessage: function( pName, elem, msg ) {
		var tmpID = 'err_'+pName;
		if( $('#'+tmpID).len == 0 ) $(elem).append('<p>'+msg+'</p>', tmpID);
	},
	
	/**
	 * Investigates all within "this.list" stored fields
	 * 
	 * @return {boolean} 
	 */
	check: function() {
		var valid = true;
		var err = '';
		
		// Test every Element
		var del = false;
		for( var x in this.list ) {
			if( !del ) {
				$(this.list[x].errTo).html('');		// Remove existing Messages
				del = true;
			} 
			
			err = this.investigate( this.vForm[x].value, this.list[x] );
			if(err != '') {
				this.addErrorMessage( x, this.list[x].errTo, err );
			}
			
		}
		
		return valid;
	}
};















