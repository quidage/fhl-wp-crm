// exec functions when page is loaded
window.onload = function() {

	$(".tr-test").each(function(e){
		e.addClass('foo');
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