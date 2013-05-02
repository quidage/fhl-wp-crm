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
	elem: null,		// contains the selected element
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
    	} else if( sType === "." ) {
    		this.workArr = document.getElementsByClassName(selector);
    		this.elem = this.workArr[0];
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
     * Trim a string
     * 
     * @param {type} untrimmedString
     * @returns {@exp;untrimmedString@call;replace}
     */
    trim: function(untrimmedString) {
        return untrimmedString.replace(/^\s+|\s+$/g, '');
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
     * Fügt dem Element ein Klick Event hinzu
     * 
     * @param {function} callback
     */
    click: function( callback ) {
    	if( typeof(callback) === 'function' ) {
    		this.elem.addEventListener('click', callback, false);	
    	}
    },
    
    /**
     * Fügt dem Element ein Mouseover Event hinzu
     * 
     * @param {function} callback
     */
    mouseover: function( callback ) {
    	if( typeof(callback) === 'function' ) {
    		this.elem.addEventListener('mouseover', callback, false);	
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
	defaults : { name: '', required: false, type: 'text', maxLen: 0, minLen: 0, error: 'Fehlerhafte Eingabe' },
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
	 * @return {boolean}
	 */
	investigateEntry: function( value, opt ) {
		var strLen = value.length;
		var maL = ( opt.maxLen == 0 ? strLen : opt.maxLen );
		var miL = ( opt.minLen == 0 ? strLen : opt.minLen );
		
		// End if it's required but empty
		if( opt.required && strLen < 1 ) {
			console.log('Keine Eingabe im Pflichtfeld!');
			return false;
		}
		
		// End if value have wrong length
		if( strLen > maL || strLen < miL ) {
			if( strLen > maL ) console.log('Ihr Eintrag im Feld '+opt.name+' ist '+( strLen-maL )+' Zeichen zu lang!');
			if( strLen < miL ) console.log('Ihr Eintrag im Feld '+opt.name+' ist '+( miL-strLen )+' Zeichen zu kurz!');
			
			return false;
		}
		
		// Compare to regular expression
		switch( opt.type ) {
			case '':;
			default: return this.checkRegExp( value, \^[^#]$\ );
		}
		
		return true;
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
		// TO DO!!
	},
	/**
	 * Investigates all within "this.list" stored fields
	 * 
	 * @return {boolean} 
	 */
	check: function() {
		valid = true;
		
		for( var x in this.list ) {
			valid = this.investigateEntry( this.vForm[x].value, this.list[x] );
		}
		
		return valid;
	}
};















