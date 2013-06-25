/**
 * Selector fuer DOM Elemente inspiriert durch jQuery
 * 
 * @author Christian Hansen <christian.hansen@stud.fh-luebeck.de>
 * @author Julian Hilbers <hilbers.juian@gmail.com>
 * @version 1.0 
 * 
 * 
 * -------------------------------------------------------------------------------------------|
 * DOM helfer um mit den Elementen des DOM zu interagieren
 * 
 * @param {object} window		window Objekt der Seite
 * @param {*} undefined			Sicherheitsrelevante Variable um einen sauberen undefined Wert zu erhlaten
 */
(function(window, undefined){
	"strict mode"
	
	// *************************************
	// *** Selektor ************************
	// *************************************
	
	var matches,
		reSingleTag = /^<(\w*)\s*\/?>$/;
	
	// Konstruktor
	var dHelper = function(selector) {
		return new dHelper.dh.init( selector );
	};
	
	// Alle Funktionen von dHelper zu dHelper.fn hinzufuegen
	dHelper.dh = dHelper.prototype = {
		len: 0,		// Found results
		
		/**
		 * Contructor
		 * 
		 * @param {string} selector		Selektiertes Element, moeglich sind Klassennamen oder Ids 
		 */
		init: function(selector) {
			var elem, sType, sWork;
	    	
	    	sType = selector.charAt(0);
	    	sWork = selector.substr(1,selector.length);
	    	
	    	switch( sType ) {
	    		case '#': elem = document.getElementById(sWork);
	    				  this[0] = elem;
	    				  this.len = 1;
	    		break;
	    		case '.': elem = document.getElementsByClassName(sWork); 
	    				  this.pushToMatches(elem);
	    				  this[0] = elem[0];
	    		break;
	    		case '<': this.pushToMatches(document.getElementsByTagName(reSingleTag.exec(sWork)));
	    		break;
	    		default: return this;
	    	}
	    	
	    	return this;
	 	},
	 	/**
	     * Findet einen html Tag innerhalb eines Elementes
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
	     * Auswahl eines von mehreren gefundenen Elementen 
	     * 
	     * @param {int} 	Position des Elements
	     * @returns {dh}
	     */
	    eq: function( no ) {
	    	return this.matches[no];
	    },
	    /**
	     * Laeuft durch jedes gefundene Element und fuehrt an ihm eine Aktion durch
	     * 
	     * @param {function} callback		Aktion fuer gefundenen Elemente
	     */
	    each: function( callback ) {
	    	var c = this.len;
	    	if( c > 0 && typeof(callback) === 'function' ) {
	    		for( var i = 0; i < c; i++ ) {
	    			callback(this.matches[i]);
	    		}
	    	}
	    },
	    /**
	     * Fuegt die gefundenen Elemente zu dHelper hinzu
	     * 
	     * @param {array} results		Array mit den gefundenen Elementen
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
	     * Entfernt alle Leerzeichen aus einem String
	     * 
	     * @param {string} uStr		Ausgangswert
	     * @return {string}
	     */
	    trim: function( uStr ) {
	        return uStr.replace(/^\s+|\s+$/g, '');
	    },
	    /**
	     * Fuegt ein neues HTML Element zum DOM hinzu
	     * 
	     * @param {string} input		Neues Element
	     */
	    append: function( input ) {
	    	// TO DO - Klasse bzw. ID erkennen und uebergeben

	    	var tmp = document.createElement(input);
	    	this[0].appendChild(tmp);
	    },
	 	/**
	     * Fuegt eine Klasse zu einem Element hinzu, ist bereits ein Klassenname vorhanden,
	     * wird der angegebene Werz hinzugefuegt
	     * 
	     * @param {string} className	Name der Klasse
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
	     * Entfernt eine Klasse von einem Element
	     * 
	     * @param {string} className	Name der Klasse
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
		 * Ändert das Attribut eines HTML Elementes, wird kein Wert angegeben, liefert die Methode,
		 * den inhalt des Attibuts
		 * 
		 * @param {string} attr		Gesuchtes Attribut
		 * @param {string} val		Neuer Wert
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
	     * Liest bzw. schreibt den Inhalte eines Tags
	     * 
	     * @param {string} html		neuer Inhalt
	     * @return {string}
	     */
	    html: function( html ) {
	    	if( html === undefined ) return this[0].innerHTML();
	    	this[0].innerHTML = html;
	    },
	    /**
	     * Belegt ein HTML Element mit einem Klick Event
	     * 
	     * @param {function} callback
	     */
	    click: function( callback ) {
	    	if( typeof(callback) === 'function' ) {
	    		this[0].addEventListener('click', callback, false);	
	    	}
	    },
	    
	    /**
	     * Belegt ein HTML Element mit einem Mouseover Event
	     * 
	     * @param {function} callback
	     */
	    mouseover: function( callback ) {
	    	if( typeof(callback) === 'function' ) {
	    		this[0].addEventListener('mouseover', callback, false);	
	    	}
	    },
	    
	    /**
	     * Fuegt einem HTML Element ein onFocus Event hinzu
	     * 
	     * @param {function} callback
	     */
	    focus: function( callback ) {
	    	if( typeof(callback) === 'function' ) {
	    		this[0].addEventListener('onfocus', callback, false);	
	    	}
	    },
	};
	
	/**
	 * Fuehrt eine AJAX Abfrage aus
	 * 
	 * @param {object} parameter		Zu sendene Parameter
	 * @param {function} callback		Aktion nach Abschluss der Abfrage
	 * 
	 * @returns {string}
	 */
	dHelper.ajax = function(parameter, callback) {
	
	    var request = null;
		var overlay;
		
	    // Internet Explorer
	    if (window.ActiveXObject) {
	        request = new ActiveXObject("Microsoft.XMLHTTP");
	    } else { // other browsers
	        request = new XMLHttpRequest();
	    }
	
	    var requestUri = parameter.url;
	    
	    if( parameter.params != undefined ) {
	    	// TO DO - Parameter erkennen und in Objekt fuer Versand einbinden
	    	/*
	    	for (i = 0; i < parameter.params.length; i++) {
	    		
	    	}
	    	*/
	    }
	
	    request.open("POST", requestUri, true);
	    request.onloadstart = function() {
	    	// Overlay waehrend des Ladevorganges hinzufuegen
        	var ovl = document.getElementById('std-overlay');
			if( !ovl ) {
				var ovImg = document.createElement('img');
				ovImg.src = 'images/loader.gif';
				
				overlay = document.createElement('div');
				overlay.setAttribute('id', 'std-overlay');
				overlay.appendChild(ovImg);
				document.body.appendChild(overlay);
			}
	    }
	    request.onreadystatechange = function() {
	        if (request.readyState === 4 && request.status === 200 ) {
	        	document.body.removeChild(document.getElementById('std-overlay'));
	        	if( typeof(callback) === 'function' ) callback(request.responseText);
	        }
	    };
	
	    request.send(null);
	}
	
	
	// Der Initialisierung Methode alle Funktionen von dHelper zuweisen  
	dHelper.dh.init.prototype = dHelper.dh;
	
	// dHelper ueber $ erreichbar machen 
	window.$ = dHelper;
	
	
	
	
	// *************************************
	// *** CRM Window **********************
	// *************************************
	
	var wndArray = [];			// Array zur Verwaltung aller offenen Fensters
	
	/**
	 * Objekt zum generieren von Fenstern
	 * 		
	 * @param {object} settings		
	 * 
	 * @retuns {Wnd}
	 */
	var wndHelper = function( settings ) {
		return new wndHelper.wnd.init( settings );
	}
	
	/**
	 * Grundobjekt des Fenster mit allen Funktionen und Eingenschaften
	 */
	wndHelper.wnd = wndHelper.prototype = {
		wId: 0,						// Einmalige ID des Fenster
		activ: false,				// Flag fuer die den Zastand
		wndObj: null,				// Objekt des Fensters selbst
		ovlObj: null,				// Objekt der Shader Flaeche im Hintergrund
		windowId:'',				// Interne Id des Fensters
		fadeStep: 0.05,				// Schritte mit denen das Fenster eingeblenden wird
		fadeSpeed: 10,				// Geschwindigkeit der wiederholungen in milli sekunden
		properties: {},				// Objekt mit den aktuellen Eigenschaften des Fensters
		defaults: {			
			w: 0,						// Breite des Fensters
			h: 0,						// Hoehe des Fensters
			x: 0,						// X-Position des Fensters
			y: 0,						// Y-Position des Fensters
			windowType: 'std-window',	// Art des Fensters
		},
		
		/**
		 * Initiiert das neue Fenster
		 * 
		 * @param {object} settings		// Objekt mit Einstellungen fuer das Fentser
		 * 
		 * @returns {wndHelper}
		 */	
		init: function( settings ) {
			Object.extend( this.properties, this.defaults );	// Properties mit den Werten von Default befuellen
			Object.extend( this.properties, settings );			// Properties mit den Settings des Nutezrs ueberschreiben
			
			this.newWindow();
			return this;
		},
		
		/**
		 * Fuegt ein Fenster zum DOM hinzu
		 */
		draw: function() {
			var bdy = document.body;
			if( this.ovlObj != null ) bdy.appendChild(this.ovlObj);
			if( this.wndObj != null ) {
				bdy.appendChild(this.wndObj);
				this.fadeIn();
			} 
		},
		/**
		 * Schließt ein Fenster und entfernt dessen HTML Code
		 */
		close: function() {
			var _this = this;
			var bdy = document.body;
			this.fadeOut(1, function(){
				//alert('check');
				bdy.removeChild(_this.getWindowElement('std-overlay'));
				bdy.removeChild(_this.getWindowElement('wnd-'+_this.wId));
			});
		},
		/**
		 * Ändert den Inhalt des Fensters
		 * 
		 * @param {String} input		Neuer Inhalt des Fensters
		 */
		update: function( input ) {
			this.wndObj.innerHTML = input;
		},
		
		/**
		 * Versteckt das Fenster
		 */
		hide: function() {
			this.wndObj.style.display = "none";
		},
		
		/**
		 * Zeigt das Fenster wieder an
		 */
		show: function() {
			this.wndObj.style.display = "block";
		},
		
		/**
		 * Generiert eine Einmalige ID fuer das Fenster.
		 */
		newWindowId: function() {
			var rID = (1 + Math.random()).toString(32).substr(2);
			var c = wndArray.length;
			
			for( var i = 0; i < c; i++ ) {
				if( wndArray[i].wId === rID ) this.wndId;
				return;
			}
			
			this.wId = rID;
		},
		
		/**
		 * Fuert alle noetigen Methoden zum erstellen des Fensters aus
		 */
		newWindow: function() {
			var _this = this;
			this.newWindowId();
			
			this.wndObj = document.createElement('div');
			this.wndObj.setAttribute('id', 'wnd-'+this.wId);
			this.wndObj.setAttribute('class', this.properties.windowType);
			
			wndArray.push(this);
		},
		
		/**
		 * Ändert die Art des Fensters
		 * 
		 * @param {string} type		Art des neuen Fensters
		 */
		setWindowType: function( type ) {
			switch(type) {
				case 'information': this.properties.windowType = 'msg-window';
				break;
				default: this.properties.windowType = 'std-window';
			}
			
		},
		
		/**
		 * Legt ein Overlay ueber die Seite
		 */
		addOverlay: function() {
			var ovl = this.getWindowElement('std-overlay');
			
			if( !ovl ) {
				this.ovlObj = document.createElement('div');
				this.ovlObj.setAttribute('id', 'std-overlay');
			}
		},
		
		/**
		 * Liefert das Element anhand Seiner ID
		 * 
		 * @param {string} elemId
		 * @returns {object}
		 */
		getWindowElement: function( elemId ) {
			return document.getElementById(elemId);
		},
		/**
		 * Blendet ein Fenster mit den per Variabel festgelegten Schritten ein
		 * 
		 * @param {number} val		// Naechster Schritt fuer den rekursiven Aufruf
		 */
		fadeIn: function( val, callback ) {
			var _this = this;
			val = val || 0;
			this.wndObj.style.opacity = val;
			
			if( val < 1 ) { 
				setTimeout( function(){
					_this.fadeIn( val+= _this.fadeStep, callback );
				}, this.fadeSpeed );
			} else {
				if( typeof(callback) === 'function' ) callback();
			}
		},
		/**
		 * Blendet ein Fenster mit den per Variabel festgelegten Schritten aus
		 * 
		 * @param {number} val		// Naechster Schritt fuer den rekursiven Aufruf
		 */
		fadeOut: function( val, callback ) {
			var _this = this;
			val = val || 1;
			this.wndObj.style.opacity = val;
			
			if( val > 0 ) { 
				setTimeout( function(){
					_this.fadeOut( val-= _this.fadeStep, callback );
				}, this.fadeSpeed );
			} else {
				if( typeof(callback) === 'function' ) callback();
			}
		}
	};
	
	// Alle Funktionen und Parameter an das Window prototyp Objekt uebergeben
	wndHelper.wnd.init.prototype = wndHelper.wnd;
	
	// Dem System den Namen des Objektes bekannt machen
	window.crmWindow = wndHelper;

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
 * Objekt zur Validierung von Formularen 
 */
var Validate = {
	// Standardwerte
	defaults : { name: '', required: false, type: 'text', maxLen: 0, minLen: 0, errMsg: 'Ihre Eingabe ist nicht korrekt!' },
	fields: {},		// Enthaelt alle zu pruefenden Felder
	vForm: null,	// Objekt des zu pruefenden Formulars
	
	/**
	 * Initiiert den Validator
	 * 
	 * @param {object} vf		Objekt des Formulars
	 * @param {object} entrys	Liste mit den zu pruefenden eintraegen
	 */
	init: function( vf, entrys ) {
		this.combineWithDefaults( entrys );
		this.vForm = vf;
	},
	/**
	 * Fuegt die internen Einstellungen mit den Einstellungen des Nutzers sowie
	 * den Standardwerten zusammen 
	 * 
 	 * @param {Object} list		Liste mit den zu pruefenden eintraegen
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
	 * Prueft einen Wert entsprechend der Einstellungen
	 * 
	 * @param {*} value			Testwert
	 * @param {object} opt		Vorgaben fuer disen Eintrag
	 * 
	 * @return {string} Fehlermeldung
	 */
	investigate: function( value, opt ) {
		var strLen = value.length;
		var regExp;
		var maL = ( opt.maxLen == 0 ? strLen : opt.maxLen );
		var miL = ( opt.minLen == 0 ? strLen : opt.minLen );
		
		// Endpunkt fuer Pflichtfelder, falls diese leer sind
		if( opt.required && strLen < 1 ) {
			return 'Fehlende Eingabe im Feld: '+opt.name+'.';
		}
		
		// Endpunkt, falls ein Wert die falsche Laenge hat
		if( strLen > maL ) return 'Ihr Eintrag im Feld '+opt.name+' ist '+( strLen-maL )+' Zeichen zu lang.';
		if( strLen < miL ) return 'Ihr Eintrag im Feld '+opt.name+' ist '+( miL-strLen )+' Zeichen zu kurz.';
		
		
		// Eintraege mit Regulaeren ausdruecken pruefen 
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
	 * Prueft einen Wert anhand eines regulaeren Ausdrucks
	 * 
	 * @param {*} value				Zu testender Wert
	 * @param {string} regExp		Regulaerer Ausdruck
	 * 
	 * @return {boolean}
	 */
	checkRegExp: function( value, regExp ) {
		return regExp.test(value);
	},
	/**
	 * Fuegt einem Element eine Fehlermeldung hinzu 
	 * 
	 * @param {string} pName	Bezeichner des Feldes, fuer das die Meldung bestimmt ist
	 * @param {object} elem		Element innerhalb dessen die Fehlermeldung ausgegeben werden soll
	 * @param {string} msg		Fehlermeldung
	 */
	addErrorMessage: function( pName, elem, msg ) {
		var tmpID = 'err_'+pName;
		if( $('#'+tmpID).len == 0 ) $(elem).append('<p>'+msg+'</p>', tmpID);
	},
	
	/**
	 * Prueft alle in "this.list" enthaltenen Felder
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
				$(this.list[x].errTo).html('');		// Entfernt ueberfluessige Fehlermeldungen
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

// *****************************************
// *** Aktion zum start der Seite **********
// *****************************************
window.onload = function() {
	
	var stdWnd;
	var nfoWnd;
	
	/**
	 * Schließen Aktion fuer Standard Fenster
	 * 
 	 * @param {object} e	Event Informationen
 	 * @param returns {boolean}
	 */
	var standardCloseAction = function(e) {
		e.preventDefault();
		document.body.removeEventListener("keydown", standardCloseAction, false );
		document.getElementById('std-close-wnd').removeEventListener("click", standardCloseAction, false );
		
		windowCloseAction( stdWnd, e.keyCode );
		
		return false;
	}
	
	/**
	 * Schließen Aktion fuer Informationsfenster
	 * 
 	 * @param {object} e	Event Informationen
 	 * @param returns {boolean}
	 */
	var informationCloseAction = function(e) {
		e.preventDefault();
		document.body.removeEventListener("keydown", informationCloseAction, false );
		document.getElementById('close-wnd').removeEventListener("click", informationCloseAction, false );
		
		windowCloseAction( nfoWnd, e.keyCode );
		
		return false;
	}
	
	/**
	 * Enthaelt die moeglichen Varianten das Fenster zu schließen
	 * 
 	 * @param {object} wnd			Objekt des zu schließenden Fensters
 	 * @param {object} keyCode		Gedrueckter Knopf auf der Tastatur
	 */
	function windowCloseAction( wnd, keyCode ) {
		keyCode = keyCode || 0;
		
		if( keyCode === 27 ) {
			wnd.close();
		} else if( keyCode === 0 ) {
			wnd.close();
		}
	}
	
	// Aktion fuer Standard Fenster
	$('.std-btn').each(
		function(btn){
			btn.click(function(e){
				e.preventDefault();
				wnd = null;
				var obj = { 'url': btn.attr('href') };
				$.ajax(obj, function( resp ){
					stdWnd = crmWindow();
					stdWnd.addOverlay();
					stdWnd.update(resp);
					stdWnd.draw();
					
					document.body.addEventListener("keydown", standardCloseAction, false);
					document.getElementById('std-close-wnd').addEventListener("click", standardCloseAction, false);
				});
			});
		}
	);
	
	// Aktion fuer Informationsfenster
	$('.msg-btn').each(
		function(btn){
			btn.click(function(e){
				e.preventDefault();
				nfoWnd = null;
				var obj = { 'url': btn.attr('href') };
				$.ajax(obj, function( resp ){
					nfoWnd = crmWindow({windowType:'msg-window'});
					nfoWnd.addOverlay();
					nfoWnd.update(resp);
					nfoWnd.draw();
					
					document.body.addEventListener("keydown", informationCloseAction, false);
					document.getElementById('close-wnd').addEventListener("click", informationCloseAction, false);
				});
			});
		}
	);	
}