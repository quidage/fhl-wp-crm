/**
 * File with useful JavaScript extensions
 * 
 * @author Julian Hilbers <hilbers.juian@gmail.com>
 * 
 */

/**
 * Slightly modified version of an script from a guy called KorRedDevil (member of forum.devshed) to
 * extend the functionality of this default JavaScript function 
 * 
 * @param {string} className	Name of your class
 * @return {array} Containing all elements with this class name
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
 * Copyes the content of one object into an other
 * 
 * @param {object} target	 		File to update
 * @param {object} source			New Data
 */
Object.extend = function( target, source ) {
	for( var x in source ) {
		target[x] = source[x];
	}
	
	return target;
}
