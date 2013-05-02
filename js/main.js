/**
 * create own namespace for this project
 * the $ is inspired by jQuery
 * 
 * @author Christian Hansen <christian.hansen@stud.fh-luebeck.de>, Julian Hilbers <hilbers.juian@gmail.com>
 */

/**
 * Get an element by selector-string
 * 
 * @param {string} selector
 * @returns {object}
 */
function $(selector) {
    return dh.init(selector);
};

/**
 * Namespace for DOMHelper-Functions
 * 
 * @type object
 */
var dh = {
	elem: null,		// Contains the selected element
	len: 0,			// Number of found results
	workArr: [],	// Array for selected classes
	
    /**
     * Selects an element by class or id
     * 
     * @param {string} 	selector, start for classes with . and id's with #
     * @returns {dh}
     */
    init: function(selector) {
    	var sType = selector.charAt(0);
    	selector = selector.substr(1,selector.length);
    	
    	if( sType === "#" ) {
    		this.elem = document.getElementById(selector);
    		this.len = ( this.elem != null ? 1 : 0 );
    	} else if( sType === "." ) {
    		this.workArr = document.getElementsByClassName(selector);
    		this.elem = this.workArr[0];
    		this.len = this.workArr.length;
    	}
    	
    	return this;
    },
    
    /**
     * Finds an html tag within an selected element
     * 
     * @param {string} selector		
     */
    find: function( selector ) {
    	this.workArr = this.elem.getElementsByTagName(selector)
    	this.elem = this.workArr[0];
    	return this; 
    },
    
    /**
     * Works only with selected classes and find, delivers the element at the passed position
     * 
     * @param {int} 	Position of the element
     * @returns {dh}
     */
    eq: function( no ) {
    	no *= 1;	// Makes an int of it
    	var c = this.workArr.length;
    	no = ( no < c ? no : c-1 );
    	
		this.elem = this.workArr[no];
		return this;
    },
    
    /**
     * Works only with selected classes and find, runs through every element and
     * performs the passed event
     * 
     * @param {function} callback		Something that should happen with this element
     */
    each: function( callback ) {
    	var c = this.workArr.length;
    	if( c > 0 && typeof(callback) === 'function' ) {
    		for( var i = 0; i < c; i++ ) {
    			this.elem = this.workArr[i];
    			callback(this);
    		}
    	}
    },
              
    /**
     * Trims a string
     * 
     * @param {string} uStr		Untrimmed string
     * 
     * @return {string}
     */
    trim: function( uStr ) {
        return uStr.replace(/^\s+|\s+$/g, '');
    },
    
    /**
     * Read and write html
     * 
     * @param {string} html		new html content
     * 
     * @return {string} if no argument is given
     */
    html: function( html ) {
    	if( html === undefined ) return this.elem.innerHTML();
    	this.elem.innerHTML = html;
    },
    
    /**
     * Appends an simple Element like (<p>xyz</p>) to the DOM
     * 
     * @param {string} input		Data to append
     * @param {string} idStr		Optional id
     * @param {string} clsStr		Optional class 
     */
    append: function( input, idStr, clsStr ) {
    	
    	var wArr = this.seperateHtmlTag(input);
    	
    	var elem = document.createElement(wArr[0]);
    	if( typeof(idStr) === 'string' && idStr != '') elem.setAttribute('id', idStr);
    	if( typeof(clsStr) === 'string' && clsStr != '') elem.setAttribute('class', clsStr);
    	
    	elem.innerHTML = wArr[1];
    	
    	this.elem.appendChild(elem);
    },
    
    /**
     * Finds and seperates an HTML Tag from its content
     * 
     * @param {string} input		String with entrys to seperate
     * 
     * @return {array} With an element and its content
     */
    seperateHtmlTag: function( input ) {
    	var rtArr = [];
    	
    	// Get tag
    	var regExp = /<[^>]*>/;
    	var ea = regExp.exec(input);
    	rtArr[0] = ea[0].substr(1, ea[0].search(/\s{1}|>/)-1);
    	
    	// Get content
    	regExp = new RegExp('<\\/['+rtArr[0]+']{1}\\s*>', 'gi');
    	rtArr[1] = input.substr(ea[0].length);
    	rtArr[1] = rtArr[1].replace(regExp, '');
    	
    	return rtArr; 
    },
    
    /**
     * Adds a class to an element
     * 
     * @param {string} className
     * @returns {dh}
     */
    addClass: function(className) {
        if (this.elem.hasAttribute('class')) {	
            this.elem.setAttribute('class', this.elem.getAttribute('class') + ' ' + className);
        } else {
            this.elem.setAttribute('class', className);
        }
        return this;
    },

    /**
     * Remove class from an element
     * 
     * @param {string} className
     * @returns {dh}
     */
    removeClass: function(className) {
        if (this.elem.hasAttribute('class')) {
            var classes = this.elem.getAttribute('class').split(' ');
            var classesString = '';
            for(i = 0; i < classes.length; i++) {
                if(this.trim(classes[i]) !== className) {
                    classesString += this.trim(classes[i]) + ' ';
                }
            }
            this.elem.setAttribute('class', this.trim(classesString));
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
    		return this.elem.getAttribute(attr);	
    	} else {
    		this.elem.setAttribute(attr, val);
    	}
    	
    	return '';
    },
    
    /**
     * Adds an click event to the element
     * 
     * @param {function} callback
     */
    click: function( callback ) {
    	if( typeof(callback) === 'function' ) {
    		this.elem.addEventListener('click', callback, false);	
    	}
    },
    
    /**
     * Adds an mouseover event to the element
     * 
     * @param {function} callback
     */
    mouseover: function( callback ) {
    	if( typeof(callback) === 'function' ) {
    		this.elem.addEventListener('mouseover', callback, false);	
    	}
    },
    
    /**
     * Adds an on focus event to the element
     * 
     * @param {function} callback
     */
    focus: function( callback ) {
    	if( typeof(callback) === 'function' ) {
    		alert('hho');
    		this.elem.addEventListener('onfocus', callback, false);	
    	}
    },    
    
    /**
     * Show an element
     * 
     * @returns {dh}
     */        
    show: function() {
        this.elem.style.display = "block";
        return this;
    },
            
    /**
     * Hide an element
     * 
     * @returns {dh}
     */        
    hide: function() {
        this.elem.style.display = "none";
        return this;
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
}; // var selection


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















