/**
 * Datei mit nützlichen JavaScript Erweiterungen
 * 
 * @author Julian Hilbers <hilbers.juian@gmail.com>
 * 
 */

/**
 * Etwas modifizierte Version von einem Benutzer Namens KorRedDevil (Miglied bei forum.devshed),
 * erweitert die Funktion zum ermitteln von Elementen anhand Ihrer Klasse
 * 
 * @param {string} className	Name der Klasse
 * @return {array}
 */
document.getElementsByClassName = function( className ) {
	var hasClass  = new RegExp("(?:^|\\s)"+className+"(?:$|\\s)");
	var allElems = document.getElementsByTagName("*");
	var results  = [];
	var elem;
	
	for( var i = 0; (allElems[i] != null); i++ ) {
		var elemClass = allElems[i].className;
		if( elemClass && elemClass.indexOf(className) != -1 && hasClass.test(elemClass) ) {
			results.push(allElems[i]);
		}
	}
	
	return results;
}

/**
 * Kopiert den Inhalt eines Objektes in ein anderes
 * 
 * @param {object} target	 		Zieldobjekt
 * @param {object} source			Neue Daten
 */
Object.extend = function( target, source ) {
	for( var x in source ) {
		target[x] = source[x];
	}
	
	return target;
}
