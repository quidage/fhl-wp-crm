// exec functions when page is loaded
//window.onload = function() {
//
//var x = $('#wrapper');
//var y = $('.errors');
//
//console.log(x.attr('id'));
//console.log(y.attr('class'));
//
//x.find('div').eq(1).addClass('it_works');



window.onload = function() {
	
	var wnd1;
	
	$('.std-btn').each(
		function(btn){
			btn.click(function(e){
				e.preventDefault();
				wnd1 = crmWindow();
				wnd1.addOverlay();
				wnd1.draw();
				
				// Fenster per Escape Taste schließen
				document.body.addEventListener("keydown", function(e){
					if( e.keyCode === 27 ) wnd1.close();
				}, false);
			});
		}
	);
	
	
	
}



/*

var v = valid('logform', {
	'username': { name: 'Benutzername', type: 'email', required: true, errMsg: 'Bitte verwenden Sie eine E-Mail Adresse', errTo: '.errors' },
	'userpass': { name: 'Passwort', required: true, minLen: 6, errMsg: 'Bitte geben Sie ein Passwort ein!', errTo: '.errors' }
});	

$("#loginform").find('button').click(function(e){
	e.preventDefault();
	console.log(v.check());
});	
*/
	
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

//};