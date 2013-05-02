// exec functions when page is loaded
window.onload = function() {


var v = valid('logform', {
	'username': { name: 'Benutzername', required: true },
	'userpass': { name: 'Passwort', required: true, minLen: 6, error: 'Bitte geben Sie ein Passwort ein!' }
});
	

$("#loginform").find('button').click(function(e){
	e.preventDefault();
	console.log(v.check());
});	

	
//    $('ergebnis').removeClass('test');

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