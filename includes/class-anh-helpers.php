<?php
/**
 * Helper utilities.
 */
class ANH_Helpers {
    /** Replace placeholders in a template. */
    public static function parse_placeholders($template, $vars) {
        return strtr($template, $vars);
    }
}
