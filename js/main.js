/**
 * create own namespace for this project
 * the $ is inspired by jQuery
 * 
 * @author Christian Hansen <christian.hansen@stud.fh-luebeck.de>
 * 
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
 * namespace for DOMHelper-Functions
 * 
 * @type object
 */
var dh = {
    
    /**
     * 
     * @param {string} selector
     * @returns {dh}
     */
    init: function(selector) {
        this.elem = document.getElementById(selector);
        return this;
    },
            
    /**
     * Adds a class to an element
     * 
     * @param {string} className
     * @returns {dh}
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
     * 
     * @param {string} className
     * @returns {dh}
     */
    removeClass: function(className) {
        if (this.elem.hasAttribute('class')) {
            var classes = this.elem.getAttribute('class').split(" ");
            var classesString = "";
            for(i = 0; i < classes.length; i++) {
                if(classes[i] !== className) {
                    classesString += classes[i] + " ";
                }
            }
            this.elem.setAttribute('class', classesString.slice(0, classesString.length - 1));
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

    $('ergebnis').removeClass('test');

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



