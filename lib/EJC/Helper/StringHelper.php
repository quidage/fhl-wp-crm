<?php

namespace EJC\Helper;

/**
 * Hilfsfunktionen fuer das Handling von Strings
 *
 * @author Christian Hansen <christian.hansen@stud.fh-luebeck.de>
 */
class StringHelper {
    
    /**
     * String von zeichen befreien, welche nicht in einem GET-Parameter
     * vorkommen duerfen
     * 
     * @param string $dirtyString
     * @return string
     */
    public static function cleanUp($dirtyString) {
        return trim(preg_replace('/[^-a-zA-Z0-9_]/', '', $dirtyString));
    }
    
}
?>
