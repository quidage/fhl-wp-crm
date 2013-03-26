/**
 * create own namespace for this project
 * the $ is inspired by jQuery
 * 
 * @author Christian Hansen <christian.hansen@stud.fh-luebeck.de>
 * 
 */


/**
 * 
 * @param {string} selector
 * @returns {object}
 */
function $(selector) {
	return dh.init(selector);
};

/**
 * namespace for DOMHelper-Functions
 * 
 * @type object
 */
var dh = {

	/**
	 * 
	 * @param {string} selector
	 * @returns {oject}
	 */
	init: function(selector) {
		 this.elem = document.getElementById(selector);
		 return this;
	},

	/**
	 * Adds a class to an element
	 * 
	 * @param {string} className
	 * @returns {oject}
	 */
	addClass: function(className) {
		if (this.elem.hasAttribute('class')) {
			this.elem.setAttribute('class', this.elem.getAttribute('class') + " " + className);
		} else {
			this.elem.setAttribute('class', className);
		}
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
		//console.log(parameter.params.length);
		for (i = 0; i < parameter.params.length; i++) {
			console.log(params.i.valueOf());
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








// exec functions when page is loaded
window.onload = function() {

	$('ergebnis').addClass('test');

//	ejc.ajax({
//		url: 'ajax/test.php',
//		params: {
//			'name': 'test',
//			'param2': 'test2'
//		},
//		type: 'xml',
//		loading: function() {
//			ejc.getById('ergebnis').innerHTML = 'loading...';
//		},
//		finished: function() {
//			ejc.getById('ergebnis').setAttribute('class', 'rest');
//		},
//		success: function(answer) {
//			console.log(answer);
//		}
//	});

};



