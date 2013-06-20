<?php

namespace EJC\Helper;

/**
 * Hilfsfunktionen fuer das Handling von Strings
 *
 * @author Christian Hansen <christian.hansen@stud.fh-luebeck.de>
 * @package wp-crm
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

    /**
     * Erstelle ein zufaelliges achtstelliges Passwort
     *
     * @return string
     */
    public static function createPassword() {
        $password = '';
        $chars = 'abcdefghijklmnopqurstuvwxyz0123456789';
        for ($i = 0; $i < 8; $i++) {
            $password .= substr($chars, rand() % strlen($chars), 1);
        }
        return $password;
    }

}
?>
