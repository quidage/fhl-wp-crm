/**
 * create own namespace for this project
 *
 */ 
var ejc = {
	
	getById: function(id) {
		return document.getElementById(id);
	},
	
	getByClass: function(className) {
		return document.getElementsByClassName(className);
	},
	
	/**
	 * Make an AJAX-Call
	 * 
	 * @param {object} paramter
	 * @returns {xml}
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
						
			if(request.readyState !== 4 && parameter.loading() !== undefined) {
				parameter.loading();
			}
			
			if(request.readyState === 4 && request.status === 200 && parameter.success(request.response) !== undefined) {
				parameter.success(request.response);
			}
			
		};
		
		request.send(null);
		
		
//		console.log(parameter.url);
//		console.log(parameter.params);
	}
};

 
// exec functions when page is loaded
window.onload = function() {
	
	ejc.ajax({
		url: 'ajax/test.php',
		params: {
			'name': 'test',
			'param2': 'test2'
		},
		loading: function() {
			ejc.getById('ergebnis').innerHTML = 'loading...';
		},
		finished: function() {
	
		},
		success: function(answer) {
			console.log(answer);
		}
	});
	
};



