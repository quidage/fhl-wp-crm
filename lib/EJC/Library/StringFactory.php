<?php

namespace EJC\Library;

/**
 * Description of StringFactory
 *
 * @author Christian Hansen <christian.hansen@bildungsweb.net>
 */
class StringFactory {
    
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
