<?php

namespace EJC\Helper;

/**
 * Description of StringFactory
 *
 * @author Christian Hansen <christian.hansen@stud.fh-luebeck.de>
 */
class StringHelper {
    
    /**
     * Clean up 
     * 
     * @param string $dirtyString
     * @return string
     */
    public static function cleanUp($dirtyString) {
        return trim(preg_replace('/[^-a-zA-Z0-9_]/', '', $dirtyString));
    }
    
}
?>
