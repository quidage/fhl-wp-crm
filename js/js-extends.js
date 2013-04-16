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
 * @param {Object} className	Name of your class
 * @returns {Array} Containing all elements with this class name
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